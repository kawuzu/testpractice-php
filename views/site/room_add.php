<h1 style="color:#2a6f2b;">Добавление нового помещения</h1>

<form method="post" action="<?= app()->route->getUrl('/rooms') ?>";">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <label>Название:<br>
        <input type="text" name="name" required>
    </label><br>

    <label>Тип:<br>
        <select name="type">
            <option>аудитория</option>
            <option>кабинет</option>
            <option>лаборатория</option>
            <option>прочее</option>
        </select>
    </label><br>

    <label>Площадь (м²):<br>
        <input type="number" min="0" step="1" name="area" required>
    </label><br>

    <label>Количество мест:<br>
        <input type="number" name="seats">
    </label><br>

    <label>Здание:<br>
        <select name="building_id" required>
            <?php foreach ($buildings as $b): ?>
                <option value="<?= $b->id ?>"><?= htmlspecialchars($b->name) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <button style="background:#4caf50;color:white;border:none;padding:6px 10px;">Создать</button>
    <a href="<?= app()->route->getUrl('/rooms') ?>" style="margin-left:10px;">Назад</a>
</form>