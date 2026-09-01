<?php

namespace App\Models;

class UserModel
{
  private $table = 'user';
  private $id;
  private $name;
  private $email;
  private $password;
  private $created_at;
  private $updated_at;
  private $active;

  public function __construct(
    $name = null,
    $email = null,
    $password = null,
    $id = null,
    $created_at = null,
    $updated_at = null,
    $active = true
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->active = $active;
  }

  public function getTable()
  {
    return $this->table;
  }
}
