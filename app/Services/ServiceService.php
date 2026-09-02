<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;

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

  public function getAllServices(array $filters = []): array
  {
    $services = $this->serviceRepository->findFiltered($filters);

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

  public function getServiceById(int $id)
  {
    return $this->serviceRepository->findById($id);
  }

  public function updateService(int $id, string $description, string $price): bool
  {
    if (empty(trim($description)) || empty($price)) {
      return false;
    }

    $priceFloat = (float) $price;

    if ($priceFloat <= 0) {
      return false;
    }

    return $this->serviceRepository->update($id, $description, $priceFloat);
  }

  public function getDashboardMetrics(int $userId): array
  {
    $total = $this->serviceRepository->getTotalValueByUserId($userId);
    $latestCompleted = $this->serviceRepository->getLatestCompletedServices($userId, 3);
    $latestPending = $this->serviceRepository->getLatestPendingServices($userId, 3);

    $totalValueFormatted = 'R$ ' . number_format($total, 2, ',', '.');

    return [
      'total' => $totalValueFormatted,
      'latestCompleted'      => $latestCompleted,
      'latestPending'        => $latestPending
    ];
  }

  public function finishService(int $serviceId): bool
  {
    $service = $this->serviceRepository->findById($serviceId);

    if (empty($service) || $service->finished_at !== null) {
      return false;
    }

    $price = (float) $service->price;
    $commission = 0.0;

    if ($price <= 1000.00) {
      $commission = $price * 0.05;
    } elseif ($price <= 10000.00) {
      $commission = $price * 0.10;
    } else {
      $commission = $price * 0.20;
    }

    if ($this->serviceRepository->finishService($serviceId, $commission)) {
      $userRepository = new UserRepository();
      $user = $userRepository->findById((int)$service->user_id_user);

      if ($user && !empty($user->email)) {
        $emailService = new EmailService();
        $emailService->sendServiceFinishedEmail($user->email, $user->name, $service->description);
      }
      return true;
    }

    return false;
  }
}
