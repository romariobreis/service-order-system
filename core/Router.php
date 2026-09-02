<?php

namespace Core;

class Router
{
  private $routes = [];

  public function get($path, $controller, $action, array $middlewares = [])
  {
    $this->addRoute('GET', $path, $controller, $action, $middlewares);
  }

  public function post($path, $controller, $action, array $middlewares = [])
  {
    $this->addRoute('POST', $path, $controller, $action, $middlewares);
  }

  public function put($path, $controller, $action, array $middlewares = [])
  {
    $this->addRoute('PUT', $path, $controller, $action, $middlewares);
  }

  public function delete($path, $controller, $action, array $middlewares = [])
  {
    $this->addRoute('DELETE', $path, $controller, $action, $middlewares);
  }

  private function addRoute($method, $path, $controller, $action, array $middlewares = [])
  {
    $this->routes[] = [
      'method'      => $method,
      'path'        => $this->normalizePath($path),
      'controller'  => $controller,
      'action'      => $action,
      'middlewares' => $middlewares,
      'pattern'     => $this->pathToRegex($path)
    ];
  }

  private function normalizePath($path)
  {
    return '/' . trim($path, '/');
  }

  private function pathToRegex($path)
  {
    $path = $this->normalizePath($path);
    $pattern = preg_replace('/{(\w+)}/', '(?P<$1>[^/]+)', $path);
    return '^' . $pattern . '$';
  }

  public function dispatch()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = str_replace(BASE_URL, '/', $url);
    $url = $this->normalizePath($url);

    foreach ($this->routes as $route) {
      if ($route['method'] === $method && preg_match('#' . $route['pattern'] . '#', $url, $matches)) {
        return $this->callController($route, $matches);
      }
    }

    http_response_code(404);
    echo "Página não encontrada: $url";
    exit;
  }

  private function callController($route, $matches)
  {
    if (!empty($route['middlewares'])) {
      foreach ($route['middlewares'] as $middleware) {
        if (!class_exists($middleware)) {
          die("Middleware não encontrado: $middleware");
        }

        $middlewareInstance = new $middleware();

        if (method_exists($middlewareInstance, 'handle')) {
          $passed = $middlewareInstance->handle();
          if ($passed === false) {
            return;
          }
        } else {
          die("O método handle() não foi encontrado no middleware: $middleware");
        }
      }
    }

    $controller = $route['controller'];
    $action = $route['action'];

    if (!class_exists($controller)) {
      die("Controller não encontrado: $controller");
    }

    $controllerInstance = new $controller();

    if (!method_exists($controllerInstance, $action)) {
      die("Action não encontrada: $action no controller $controller");
    }

    $params = [];
    foreach ($matches as $key => $value) {
      if (!is_numeric($key)) {
        $params[$key] = $value;
      }
    }

    return call_user_func_array([$controllerInstance, $action], $params);
  }
}
