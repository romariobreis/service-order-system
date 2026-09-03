<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Novo Usuário | Sistema de Controle de Serviços</title>
  <link rel="stylesheet" href="<?php echo BASE_PUBLIC; ?>css/new-user.css">
</head>

<body>
  <div class="register-container">
    <div class="register-box">
      <h1 class="register-title">Cadastrar Novo Usuário</h1>

      <form class="register-form" id="register-form" method="POST" action="<?php echo BASE_URL; ?>register">
        <div class="form-group">
          <input type="text" name="name" class="form-input" placeholder="Nome" required>
        </div>

        <div class="form-group">
          <input type="email" name="email" class="form-input" placeholder="email@email.com" required>
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-input" placeholder="***************" required>
        </div>

        <div class="register-buttons">
          <button type="submit" class="register-button">Cadastrar</button>
          <a href="<?php echo BASE_URL ?>" class="register-button btn-user-cancel">Cancelar</a>
        </div>
      </form>

    </div>
  </div>
</body>

</html>