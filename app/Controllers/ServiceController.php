<?php

namespace App\Controllers;

class ServiceController extends BaseController
{
  public function registerForm()
  {
    $this->view('register-new-service');
  }
}
