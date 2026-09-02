<?php

namespace App\Controllers;


class UserController extends BaseController
{
  public function registerForm()
  {
    $this->view('register-new-user');
  }
}
