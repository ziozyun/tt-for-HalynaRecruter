$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
  },
});

const loadStats = () => {
  $.get('/api/tasks/stats', (data) => {
    $('#page-dashboard-tasks-completed').text(data.completed);
    $('#page-dashboard-tasks-total').text(data.total);
  });
}

const appendCard = (cardData) => {
  const card = document.createElement('div');
  card.classList.add('card');

  const titleId = document.createElement('div');
  titleId.innerHTML = `<b>Id</b>: ${cardData.id}`;
  const titleDiv = document.createElement('div');
  titleDiv.innerHTML = `<b>Заголовок</b>: ${cardData.title}`;
  const statusDiv = document.createElement('div');
  statusDiv.innerHTML = `<b>Статус</b>: ${cardData.status}`;
  const dueDateDiv = document.createElement('div');
  dueDateDiv.innerHTML = `<b>Дата виконання</b>: ${cardData.due_date}`;
  const descriptionDiv = document.createElement('div');
  descriptionDiv.innerHTML = `<b>Опис</b>: ${cardData.description}`;

  const editButton = document.createElement('button');
  editButton.textContent = "Редагувати";
  const deleteButton = document.createElement('button');
  deleteButton.textContent = "Видалити";

  card.appendChild(titleId);
  card.appendChild(titleDiv);
  card.appendChild(statusDiv);
  card.appendChild(dueDateDiv);
  card.appendChild(descriptionDiv);
  card.appendChild(editButton);
  card.appendChild(deleteButton);

  document.getElementById('cards').appendChild(card);

  editButton.addEventListener('click', function() {
    $('#page-upsert').prop('checked', true);
    $('#page-dashboard-caption').text('Редагувати задачу');
    $('#page-dashboard-button').text('Редагувати');
    taskId = cardData.id;
    $('#page-dashboard-title').val(cardData.title);
    $('#page-dashboard-description').val(cardData.description);
    $('#page-dashboard-status').val(cardData.status);
    $('#page-dashboard-duedate').val(cardData.due_date);
  });

  deleteButton.addEventListener('click', function() {
    if (confirm("Ви впевнені, що хочете видалити?")) {
      $.ajax({
        url: `/api/tasks/${cardData.id}`,
        method: 'DELETE',
        success: loadTasks,
        error: function(xhr, status, error) {
          console.error('Помилка при видаленні:', error);
        }
      });
    }
  });
}

let page = 1;
const loadTasks = () => {
  loadStats();
  $.get(`/api/tasks?page=${page}`, (data) => {
    if (data.data.length === 0 && data.current_page > 1) {
      page--;
      return loadTasks();
    }

    page = data.current_page;

    $('#cards').html('');
    for (let cardData of data.data) {
      appendCard(cardData);
    }

    $('#prev').prop('disabled', data.prev_page_url === null);
    $('#next').prop('disabled', data.next_page_url === null);
  });
};

const loadLoginPage = () => {
  page = 1;
  $('#logout-button').hide();
  $('#page-login').prop('checked', true);
};

const loadDashboardPage = () => {
  $('#logout-button').show();
  $('#page-dashboard').prop('checked', true);
  loadTasks();
};

$(document).ajaxError(function(_, jqxhr, settings) {
  if (jqxhr.status === 401) {
    loadLoginPage();
  }
});

$('#prev').click(() => {
  page--;
  loadTasks();
});

$('#next').click(() => {
  page++;
  loadTasks();
});

let taskId = null;

$('#page-dashboard-button-add').click(() => {
  $('#page-upsert').prop('checked', true);
  $('#page-dashboard-caption').text('Додати задачу');
  $('#page-dashboard-button').text('Додати');
  taskId = null;
  $('#page-dashboard-title').val('');
  $('#page-dashboard-description').val('');
  $('#page-dashboard-status').val('0');
  $('#page-dashboard-duedate').val('');
});

$('#upsert-form').submit(event => {
  event.preventDefault();

  const isNew = taskId === null;

  $.ajax({
    url: isNew
      ? '/api/tasks'
      : `/api/tasks/${taskId}`,
    method: isNew
      ? 'POST'
      : 'PUT',
    data: {
      title: $('#page-dashboard-title').val(),
      description: $('#page-dashboard-description').val(),
      status: $('#page-dashboard-status').val(),
      due_date: $('#page-dashboard-duedate').val(),
    },
    success: () => {
      if (isNew) {
        page = 1;
      }

      loadDashboardPage()
    },
    error: () => alert('Перевірте вхідні дані'),
  });
});

$('#logout-button').click(() => $.ajax({
  url: '/api/logout',
  method: 'POST',
  success: loadLoginPage
}));

$('#login-form').submit(event => {
  event.preventDefault();

  const button = $('#page-login-button');

  const username = $('#page-login-username');
  const password = $('#page-login-password');

  button.prop('disabled', true);

  $.ajax({
    url: '/api/login',
    method: 'POST',
    data: {
      username: username.val(),
      password: password.val(),
    },
    success: () => {
      username.val('');
      password.val('');
      loadDashboardPage();
    },
    error: () => alert('Неправильний логін пароль'),
  }).always(() => {
    button.prop('disabled', false);
  });
});

$('#register-form').submit(event => {
  event.preventDefault();

  const button = $('#page-register-button');

  const name = $('#page-register-name');
  const username = $('#page-register-username');
  const email = $('#page-register-email');
  const password = $('#page-register-password');
  const repassword = $('#page-register-repassword');

  if (password.val() !== repassword.val()) {
    return alert('Паролі не співпадають');
  }

  button.prop('disabled', true);

  $.ajax({
    url: '/api/register',
    method: 'POST',
    data: {
      name: name.val(),
      email: email.val(),
      username: username.val(),
      password: password.val(),
    },
    success: () => {
      name.val('');
      username.val('');
      email.val('');
      password.val('');
      repassword.val('');
      alert('Ви успішно зареєструвалися');
      loadLoginPage();
    },
    error: () => alert('Неправильний дані для реєстрації'),
  }).always(() => {
    button.prop('disabled', false);
  });

});

$.get('/api/me', loadDashboardPage).catch(loadLoginPage);
