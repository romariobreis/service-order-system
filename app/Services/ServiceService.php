<?php

namespace App\Services;

use App\Repositories\ServiceRepository;

class ServiceService
{
  private $serviceRepository;

  public function __construct()
  {
    $this->serviceRepository = new ServiceRepository();
  }

  public function createService(string $description, string $price): bool
  {
    if (empty(trim($description)) || empty($price)) {
      return false;
    }

    $priceFloat = (float) $price;

    if ($priceFloat <= 0) {
      return false;
    }

    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
      return false;
    }

    return $this->serviceRepository->create($description, $priceFloat, $userId);
  }

  public function getAllServices(): array
  {
    $services = $this->serviceRepository->findAllWithUser();

    foreach ($services as $service) {
      if (empty($service->finished_at)) {
        $service->status_label = 'PENDENTE';
        $service->status_class = 'pending';
      } else {
        $service->status_label = 'FINALIZADO';
        $service->status_class = 'completed';
      }

      $service->price_formatted = 'R$ ' . number_format($service->price, 2, ',', '.');
    }

    return $services;
  }

  public function getDashboardMetrics(int $userId): array
  {
    $total = $this->serviceRepository->getTotalValueByUserId($userId);
    $latestCompleted = $this->serviceRepository->getLatestCompletedServices(3);

    $totalValueFormatted = 'R$ ' . number_format($total, 2, ',', '.');

    return [
      'total' => $totalValueFormatted,
      'latestCompleted'      => $latestCompleted
    ];
  }
}
