<h2>Добавление нового сотрудника</h2>

<form method="post" action="<?= app()->route->getUrl('/admin/users/store') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <label>Имя:
        <input type="text" name="name" required>
    </label>

    <label>ФИО:
        <input type="text" name="full_name" required>
    </label>

    <label>Логин:
        <input type="text" name="login" required>
    </label>

    <label>Пароль:
        <input type="password" name="password" required>
    </label>

    <button>Создать</button>
    <a class="add-btn" href="<?= app()->route->getUrl('/admin/users') ?>">Назад</a>
</form>
