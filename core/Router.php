<?php

namespace Core;

class Router
{
  private $routes = [];

  public function get($path, $controller, $action)
  {
    $this->addRoute('GET', $path, $controller, $action);
  }

  public function post($path, $controller, $action)
  {
    $this->addRoute('POST', $path, $controller, $action);
  }

  public function put($path, $controller, $action)
  {
    $this->addRoute('PUT', $path, $controller, $action);
  }

  public function delete($path, $controller, $action)
  {
    $this->addRoute('DELETE', $path, $controller, $action);
  }

  private function addRoute($method, $path, $controller, $action)
  {
    $this->routes[] = [
      'method' => $method,
      'path' => $this->normalizePath($path),
      'controller' => $controller,
      'action' => $action,
      'pattern' => $this->pathToRegex($path)
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
