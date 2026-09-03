<?php

namespace App\Controllers;

use App\Services\ServiceService;

class DashboardController extends BaseController
{
  private ServiceService $serviceService;

  public function __construct()
  {
    $this->serviceService = new ServiceService();
  }

  public function index(): void
  {
    $userLogged = $_SESSION['user_name'];
    $userId = $_SESSION['user_id'];

    $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    parse_str((string) $queryString, $queryParams);

    $filters = [
      'serviceName' => $queryParams['serviceName'] ?? '',
      'userName' => $queryParams['userName'] ?? '',
      'status'       => $queryParams['status'] ?? '',
      'startDate' => $queryParams['startDate'] ?? '',
      'endDate'   => $queryParams['endDate'] ?? ''
    ];

    $metrics = $this->serviceService->getDashboardMetrics($userId);
    $services = $this->serviceService->getAllServices($filters);

    $this->view('dashboard', [
      'userLogged' => $userLogged,
      'metrics'    => $metrics,
      'services'   => $services,
      'filters'    => $filters
    ]);
  }
}
