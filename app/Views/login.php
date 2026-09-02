<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Sistema de Controle de Serviços</title>
  <link rel="stylesheet" href="<?php echo BASE_PUBLIC; ?>css/login.css">
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <h1 class="login-title">Sistema de Controle de Serviços</h1>

      <?php if (!empty($error)) { ?>
        <div class="error-message">
          <?php echo $error; ?>
        </div>
      <?php } ?>

      <form class="login-form" id="login-form" method="POST" action="<?php echo BASE_URL; ?>login">
        <div class="form-group">
          <input type="email" name="email" class="form-input" placeholder="email@email.com" required>
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-input" placeholder="***************" required>
        </div>

        <div class="login-buttons">
          <button type="submit" class="login-button">Entrar</button>
          <a href="<?php echo BASE_URL . 'register-new-user'; ?>" class="register-link">Cadastrar usuário</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>