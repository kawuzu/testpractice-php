<h2>Добавление нового сотрудника</h2>

<form method="post" action="<?= app()->route->getUrl('/admin/users/store') ?>" style="max-width:400px;">
    <!-- CSRF-токен для безопасности -->
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <label>Имя:<br>
        <input type="text" name="name" required>
    </label><br>

    <label>ФИО:<br>
        <input type="text" name="full_name" required>
    </label><br>

    <label>Логин:<br>
        <input type="text" name="login" required>
    </label><br>

    <label>Пароль:<br>
        <input type="password" name="password" required>
    </label><br>

    <button style="background:#4CAF50; color:white; border:none; padding:6px 10px; border-radius:4px;">
        Создать
    </button>
    <a href="<?= app()->route->getUrl('/admin/users') ?>" style="margin-left:10px; text-decoration:none; color:#333;">
        Назад
    </a>
</form>
