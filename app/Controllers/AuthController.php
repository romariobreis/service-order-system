<?php

namespace App\Controllers;


class AuthController extends BaseController
{
  public function index()
  {
    $userLogged = 'John Doe';
    !empty($userLogged) ? $this->view('dashboard', ['userLogged' => $userLogged]) : $this->view('login');
  }
}
