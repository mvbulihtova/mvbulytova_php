<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Мой блог') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>">Блог</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/hello/Mariya">Hello</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/bye/Mariya">Bye</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= dirname($_SERVER['SCRIPT_NAME']); ?>/article/create">Создать статью</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main>
  <div class="container mt-4">
