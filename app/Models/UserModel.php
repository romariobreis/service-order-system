<?php

namespace App\Models;

class UserModel
{
  public ?int $id_user = null;
  public ?string $name = null;
  public ?string $email = null;
  public ?string $password = null;
  public ?string $created_at = null;
  public ?string $update_at = null;
  public ?bool $active = null;

  public static function getTable(): string
  {
    return 'user';
  }
}
