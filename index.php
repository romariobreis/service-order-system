<?php

// Arquivo de entrada do sistema
// Redireciona todas as requisições para o controlador frontal

require_once __DIR__ . '/core/autoload.php';

// Aqui você inicializa sua aplicação MVC
// Por enquanto, apenas redireciona para o public/index.php
require_once __DIR__ . '/app/Views/login.php';
