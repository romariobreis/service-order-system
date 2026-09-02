<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Serviço | Sistema de Controle de Serviços</title>
  <link rel="stylesheet" href="<?php echo BASE_PUBLIC; ?>css/new-service.css">
</head>

<body>
  <div class="service-container">
    <div class="service-box">
      <h1 class="service-title">Editar Serviço #<?php echo $service->id_service ?? '' ?></h1>

      <form class="service-form" id="service-form" method="POST" action="<?php echo BASE_URL ?>service/<?php echo $service->id_service ?? '' ?>/update">
        <div class="form-group">
          <label style="font-size: 14px; font-weight: bold; margin-bottom: 5px; color: var(--color-gray-dark);">Descrição do Serviço</label>
          <input type="text" name="description" class="form-input" value="<?php echo htmlspecialchars($service->description ?? '') ?>" required>
        </div>

        <div class="form-group">
          <label style="font-size: 14px; font-weight: bold; margin-bottom: 5px; color: var(--color-gray-dark);">Valor (R$)</label>
          <input type="number" name="price" class="form-input" step="0.01" value="<?php echo number_format($service->price ?? 0, 2, '.', '') ?>" required>
        </div>

        <div class="service-buttons" style="display: flex; gap: 15px;">
          <button type="submit" class="service-button">Salvar Alterações</button>
          <a href="<?php echo BASE_URL ?>" class="service-button" style="text-decoration: none; text-align: center;">Cancelar</a>
        </div>
      </form>

    </div>
  </div>
</body>

</html>