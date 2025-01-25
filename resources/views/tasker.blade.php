<!DOCTYPE html>
<html lang="uk-ua">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <button style="display: none" id="logout-button">Вихід</button>
    </header>
    <main>
      <input type="radio" name="page" id="page-login">
      <div class="page">
        <form id="login-form" class="auth-form">
          <div class="caption">Авторизація</div>
          <fieldset>
            <label for="page-login-username">Логін</label>
            <input id="page-login-username" type="text" placeholder="Логін" required>
          </fieldset>
          <fieldset>
            <label for="page-login-password">Пароль</label>
            <input id="page-login-password" type="password" placeholder="Пароль" required>
          </fieldset>
          <button id="page-login-button">Авторизуватися</button><br>
          <label class="hover-underline" for="page-register">Зареєструватися</label>
        </form>
      </div>
      <input type="radio" name="page" id="page-register">
      <div class="page">
        <form id="register-form">
          <div class="caption">Реєстрація</div>
          <fieldset>
            <label for="page-register-name">Ім'я</label>
            <input id="page-register-name" type="text" placeholder="Ім'я" required>
          </fieldset>
          <fieldset>
            <label for="page-register-username">Логін</label>
            <input id="page-register-username" type="text" placeholder="Логін" required>
          </fieldset>
          <fieldset>
            <label for="page-register-email">Пошта</label>
            <input id="page-register-email" type="email" placeholder="Пошта" required>
          </fieldset>
          <fieldset>
            <label for="page-register-password">Пароль</label>
            <input id="page-register-password" type="password" placeholder="Пароль" required>
          </fieldset>
          <fieldset>
            <label for="page-register-repassword">Повтор паролю</label>
            <input id="page-register-repassword" type="password" placeholder="Повтор паролю" required>
          </fieldset>
          <button id="page-register-button">Зареєструватися</button><br>
          <label class="hover-underline" for="page-login">Авторизація</label>
        </form>
      </div>
      <input type="radio" name="page" id="page-dashboard">
      <div class="page tasks">
        <div class="stats">
          <span>Виконані задачі</span>
          <div>
            <span id="page-dashboard-tasks-completed">0</span> / <span id="page-dashboard-tasks-total">0</span>
          </div>
        </div>
        <button id="page-dashboard-button-add">+ Додати задачу</button>
        <div class="">
          <div id="cards"></div>
          <div class="nav">
            <button id="prev">Назад</button>
            <button id="next">Вперед</button>
          </div>
        </div>
      </div>
      <input type="radio" name="page" id="page-upsert">
      <div class="page">
        <form id="upsert-form">
          <div class="caption" id="page-dashboard-caption"></div>
          <fieldset>
            <label for="page-dashboard-title">Заголовок</label>
            <input id="page-dashboard-title" type="text" placeholder="Заголовок" required>
          </fieldset>
          <fieldset>
            <label for="page-dashboard-description">Опис</label>
            <textarea id="page-dashboard-description" placeholder="Опис" required></textarea>
          </fieldset>
          <fieldset>
            <label for="page-dashboard-status">Статус</label>
            <select id="page-dashboard-status" required>
              <option value="0">Не виконана</option>
              <option value="1">Виконана</option>
            </select>
          </fieldset>
          <fieldset>
            <label for="page-dashboard-duedate">Статус</label>
            <input type="datetime-local" id="page-dashboard-duedate">
          </fieldset>
          <button id="page-dashboard-button"></button><br>
          <label class="hover-underline" for="page-dashboard">Повернутися до списку задач</label>
        </form>
      </div>
    </main>
  </div>
  <script src="/assets/js/main.js"></script>
</body>

</html>