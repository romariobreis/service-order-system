<?php

namespace App\Controllers;

use App\Services\ServiceService;

class ServiceController extends BaseController
{
  private ServiceService $serviceService;

  public function __construct()
  {
    $this->serviceService = new ServiceService();
  }

  public function registerForm(): void
  {
    $this->view('register-new-service');
  }

  public function create(): void
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

  public function edit(int $id): void
  {
    $service = $this->serviceService->getServiceById((int) $id);

    if (!$service) {
      $_SESSION['error_message'] = "Serviço não encontrado.";
      header('Location: ' . BASE_URL);
      exit;
    }

    $this->view('edit-service', ['service' => $service]);
  }

  public function update(int $id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $description = $_POST['description'] ?? '';
      $price = $_POST['price'] ?? '';

      if ($this->serviceService->updateService((int) $id, $description, $price)) {
        $_SESSION['success_message'] = "Serviço atualizado com sucesso!";
      } else {
        $_SESSION['error_message'] = "Falha ao atualizar. Verifique os dados.";
      }

      header('Location: ' . BASE_URL);
      exit;
    }
  }

  public function delete(int $id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      if ($this->serviceService->deleteService((int) $id)) {
        $_SESSION['success_message'] = "Serviço excluído com sucesso!";
      } else {
        $_SESSION['error_message'] = "Erro ao tentar excluir o serviço.";
      }

      header('Location: ' . BASE_URL);
      exit;
    }
  }

  public function finish(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $serviceId = $_POST['id_service'] ?? 0;

      if ($this->serviceService->finishService((int)$serviceId)) {
        $_SESSION['success_message'] = "Serviço finalizado com sucesso! O usuário foi notificado.";
      } else {
        $_SESSION['error_message'] = "Falha ao finalizar o serviço. Ele pode já estar concluído.";
      }
      header('Location: ' . BASE_URL);
      exit;
    }
  }
}
