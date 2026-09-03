<?php

namespace App\Models;

class ServiceModel
{
  public ?int $id_service = null;
  public ?string $description = null;
  public ?float $price = null;
  public ?string $created_at = null;
  public ?string $update_at = null;
  public ?string $finished_at = null;
  public ?float $commission_user = null;
  public ?int $user_id_user = null;
  public ?string $user_name = null;
  public ?string $status_label = null;
  public ?string $status_class = null;
  public ?string $price_formatted = null;

  public static function getTable(): string
  {
    return 'service';
  }
}
