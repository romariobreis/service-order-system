<?php

namespace App\Models;

class ServiceModel
{
  private $table = 'service';
  private $id;
  private $description;
  private $price;
  private $status;
  private $commission;
  private $created_at;
  private $updated_at;
  private $finished_at;
  private $user_id;

  public function __construct(
    $id = null,
    $description = null,
    $price = null,
    $status = 'Pending',
    $commission = null,
    $created_at = null,
    $updated_at = null,
    $finished_at = null,
    $user_id = null,
  ) {
    $this->id = $id;
    $this->description = $description;
    $this->price = $price;
    $this->status = $status;
    $this->commission = $commission;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->finished_at = $finished_at;
    $this->user_id = $user_id;
  }

  public function getTable()
  {
    return $this->table;
  }
}
