<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Sistema de Controle de Serviços</title>
  <link rel="stylesheet" href="<?php echo BASE_PUBLIC; ?>css/dashboard.css">
</head>

<body>
  <div class="dashboard-container">
    <aside class="sidebar">
      <div class="sidebar-content">
        <div class="user-info">
          <p class="user-label">Logado como:</p>
          <p class="user-name"><?php echo !empty($userLogged) ? $userLogged : ''; ?></p>
          <p class="current-date"><?php echo date('d/m/Y'); ?></p>
        </div>

        <nav class="sidebar-nav">
          <a href="<?php echo BASE_URL; ?>register-new-service" class="sidebar-link">Cadastrar Serviço</a>
          <a href="<?php echo BASE_URL; ?>logout" class="sidebar-link">
            Sair
          </a>
        </nav>
      </div>
    </aside>

    <main class="main-content">
      <div class="dashboard-header">
        <h1 class="dashboard-title">DASHBOARD</h1>
      </div>

      <?php if (!empty($_SESSION['success_message'])) { ?>
        <div class="alert alert-success">
          <span><?php echo $_SESSION['success_message']; ?></span>
          <button type="button" class="alert-close" onclick="this.parentElement.remove();" title="Fechar">
            &times;
          </button>
        </div>
        <?php unset($_SESSION['success_message']);
        ?>
      <?php } ?>

      <?php if (!empty($_SESSION['error_message'])) { ?>
        <div class="alert alert-error">
          <span><?php echo $_SESSION['error_message']; ?></span>
          <button type="button" class="alert-close" onclick="this.parentElement.remove();" title="Fechar">
            &times;
          </button>
        </div>
        <?php unset($_SESSION['error_message']);
        ?>
      <?php } ?>

      <div class="cards-section">
        <div class="card">
          <h2 class="card-title">Serviços Finalizados</h2>
          <div style="font-size: 28px; font-weight: 700; color: var(--color-completed); margin-bottom: 20px;">
            <?php echo $metrics['total'] ?? 'R$ 0,00'; ?>
          </div>

          <ul class="service-list">
            <?php if (!empty($metrics['latestCompleted'])) { ?>
              <?php foreach ($metrics['latestCompleted'] as $item) { ?>
                <li class="service-item">
                  <?php echo $item->id_service; ?> - <?php echo htmlspecialchars($item->description); ?>
                </li>
              <?php } ?>
            <?php } else { ?>
              <li class="service-item" style="color: var(--color-gray-light);">
                Nenhum serviço finalizado ainda.
              </li>
            <?php } ?>
          </ul>
        </div>

        <div class="card">
          <h2 class="card-title">Serviços Pendentes</h2>
          <ul class="service-list">
            <?php if (!empty($metrics['latestPending'])) { ?>
              <?php foreach ($metrics['latestPending'] as $item) { ?>
                <li class="service-item">
                  <?php echo $item->id_service; ?> - <?php echo htmlspecialchars($item->description); ?>
                </li>
              <?php } ?>
            <?php } else { ?>
              <li class="service-item" style="color: var(--color-gray-light);">
                Nenhum serviço pendente no momento.
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>

      <form method="GET" class="filters-section" style="flex-wrap: wrap;">

        <input type="text" name="serviceName" class="filter-input" placeholder="Nome do Serviço" value="<?php echo htmlspecialchars($filters['serviceName'] ?? '') ?>">

        <input type="text" name="userName" class="filter-input" placeholder="Nome do Usuário" value="<?php echo htmlspecialchars($filters['userName'] ?? '') ?>">

        <select name="status" class="filter-input" style="background: white;">
          <option value="">Todos os Status</option>
          <option value="pending" <?php echo !empty($filters['status']) && $filters['status'] === 'pending' ? 'selected' : '' ?>>Pendente</option>
          <option value="finished" <?php echo !empty($filters['status']) && $filters['status'] === 'finished' ? 'selected' : '' ?>>Finalizado</option>
        </select>

        <input type="date" name="startDate" class="filter-input" title="Data Inicial"
          value="<?php echo htmlspecialchars($filters['startDate'] ?? '') ?>">

        <input type="date" name="endDate" class="filter-input" title="Data Final"
          value="<?php echo htmlspecialchars($filters['endDate'] ?? '') ?>">

        <button type="submit" class="filter-button">Filtrar</button>

        <a href="<?php echo BASE_URL ?>" class="filter-button" style="background-color: var(--color-gray-medium); text-decoration: none; text-align: center; display: inline-block;">Limpar</a>
      </form>

      <div class="table-section">
        <table class="services-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>DESCRIÇÃO</th>
              <th>VALOR</th>
              <th>STATUS</th>
              <th>NOME DO USUÁRIO</th>
              <th>AÇÕES</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($services)) { ?>
              <?php foreach ($services as $service) { ?>
                <tr>
                  <td><?php echo $service->id_service; ?></td>
                  <td><?php echo htmlspecialchars($service->description); ?></td>
                  <td><?php echo $service->price_formatted; ?></td>
                  <td>
                    <span class="status <?php echo $service->status_class; ?>">
                      <?php echo $service->status_label; ?>
                    </span>
                  </td>
                  <td><?php echo htmlspecialchars($service->user_name); ?></td>
                  <td>
                    <div class="action-buttons">
                      <button class="action-btn edit" title="Alterar">✏️</button>
                      <?php if (empty($service->finished_at)) { ?>
                        <form action="<?php echo BASE_URL ?>service/finish" method="POST" style="display:inline;">
                          <input type="hidden" name="id_service" value="<?php echo $service->id_service ?>">
                          <button type="submit" class="action-btn complete" title="Finalizar" onclick="return confirm('Deseja realmente finalizar este serviço?')">✓</button>
                        </form>
                      <?php } ?>
                      <button class="action-btn delete" title="Excluir">✕</button>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <!-- colspan="6" para ocupar toda a largura da tabela -->
                <td colspan="6" style="text-align: center; padding: 30px;">
                  Nenhum serviço cadastrado até o momento.
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>