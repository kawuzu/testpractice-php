<h2>Добавление нового здания</h2>

<form method="post" action="<?= app()->route->getUrl('/buildings') ?>" style="max-width:400px;">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <label>Название:<br>
        <input type="text" name="name" required>
    </label><br>
    <label>Адрес:<br>
        <input type="text" name="address">
    </label><br><br>
    <button style="background:#4caf50;color:white;border:none;padding:6px 10px;">Создать</button>
    <a href="<?= app()->route->getUrl('/buildings') ?>" style="margin-left:10px;">Назад</a>
</form>