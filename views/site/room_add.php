<h2>Добавление нового помещения</h2>

<form method="post" action="<?= app()->route->getUrl('/rooms') ?>" style="max-width:400px;">
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
        <input type="number" step="0.01" name="area" required>
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
