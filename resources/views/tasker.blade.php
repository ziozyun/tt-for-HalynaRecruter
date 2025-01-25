<!DOCTYPE html>
<html lang="uk-ua">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Таскер</title>

  <link rel="stylesheet" href="/assets/css/main.css">

  <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
  <!--
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  -->
</head>

<body>
  <div class="wrapper">
    <header>
      <h1>Таскер</h1>
      <button class="">🔚 Вихід</button>
    </header>
    <main>
      <input type="radio" name="page" id="page-login" checked>
      <div class="page">
        Авторизація
      </div>
      <input type="radio" name="page" id="page-register">
      <div class="page">
        Реєстрація
      </div>
      <input type="radio" name="page" id="page-dashboard">
      <div class="page">
        Список задач
      </div>
      <input type="radio" name="page" id="page-upsert">
      <div class="page">
        Редагування задачі
      </div>
    </main>
  </div>
  <script src="/assets/js/main.js"></script>
</body>

</html>