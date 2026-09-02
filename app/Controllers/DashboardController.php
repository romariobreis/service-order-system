<?php

namespace App\Controllers;

use App\Services\ServiceService;

class DashboardController extends BaseController
{
  private $serviceService;

  public function __construct()
  {
    $this->serviceService = new ServiceService();
  }

  public function index()
  {
    $userLogged = $_SESSION['user_name'];
    $userId = $_SESSION['user_id'];

    $metrics = $this->serviceService->getDashboardMetrics($userId);
    $services = $this->serviceService->getAllServices();

    $this->view('dashboard', [
      'userLogged' => $userLogged,
      'metrics'    => $metrics,
      'services'   => $services
    ]);
  }
}
