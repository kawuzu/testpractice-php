<h2>Помещения</h2>

<?php if (in_array(app()->auth->user()->role, ['admin', 'staff'])): ?>
    <a href="<?= app()->route->getUrl('/rooms/create') ?>"
       style="display:inline-block;margin-bottom:10px;">➕ Добавить помещение</a>
<?php endif; ?>

<table border="1" cellpadding="6" cellspacing="0" width="100%" style="border-collapse:collapse;">
    <tr style="background:#e9f7ef;">
        <th>ID</th>
        <th>Название</th>
        <th>Тип</th>
        <th>Площадь (м²)</th>
        <th>Места</th>
        <th>Здание</th>
        <th>Действия</th>
    </tr>

    <?php foreach ($rooms as $r): ?>
        <tr>
            <td><?= $r->id ?></td>
            <td><?= htmlspecialchars($r->name) ?></td>
            <td><?= htmlspecialchars($r->type) ?></td>
            <td><?= $r->area ?></td>
            <td><?= $r->seats ?></td>
            <td><?= htmlspecialchars($r->building_name) ?></td>
            <td>
                <a href="<?= app()->route->getUrl('/rooms/edit/' . $r->id) ?>">Редактировать</a>

                <?php if (app()->auth->user()->role === 'admin'): ?>
                    | <a href="<?= app()->route->getUrl('/rooms/delete/' . $r->id) ?>"
                         style="color:red"
                         onclick="return confirm('Удалить помещение?')">Удалить</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php if (count($rooms) === 0): ?>
        <tr>
            <td colspan="7" style="text-align:center;color:#888;">Нет помещений</td>
        </tr>
    <?php endif; ?>
</table>