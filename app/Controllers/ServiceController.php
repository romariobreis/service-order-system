<?php

namespace App\Controllers;

use App\Services\ServiceService;

class ServiceController extends BaseController
{
  private $serviceService;

  public function __construct()
  {
    $this->serviceService = new ServiceService();
  }

  public function registerForm()
  {
    $this->view('register-new-service');
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $description = $_POST['description'] ?? '';
      $price = $_POST['price'] ?? '';

      if ($this->serviceService->createService($description, $price)) {
        $_SESSION['success_message'] = "Serviço cadastrado com sucesso.";
      } else {
        $_SESSION['error_message'] = "Falha ao cadastrar. Verifique se preencheu Descrição e Valor corretamente.";
      }

      header('Location: ' . BASE_URL);
      exit;
    }
  }
}
