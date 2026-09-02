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
}
