<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Serviço | Sistema de Controle de Serviços</title>
  <link rel="stylesheet" href="<?php echo BASE_PUBLIC; ?>css/new-service.css">
</head>

<body>
  <div class="service-container">
    <div class="service-box">
      <h1 class="service-title">Cadastrar Novo Serviço</h1>

      <form class="service-form" id="service-form" method="POST" action="<?php echo BASE_URL; ?>service/create">
        <div class="form-group">
          <input type="text" name="description" class="form-input" placeholder="descrição" required>
        </div>

        <div class="form-group">
          <input type="number" name="price" class="form-input" placeholder="preço" step="0.01" required>
        </div>

        <div class="service-buttons">
          <button type="submit" class="service-button">Cadastrar</button>
          <a href="<?php echo BASE_URL ?>" class="service-button btn-service-cancel">Cancelar</a>

        </div>
      </form>

    </div>
  </div>
</body>

</html>