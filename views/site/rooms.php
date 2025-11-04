<h2>Помещения</h2>

<a href="<?= app()->route->getUrl('/rooms/create') ?>" style="display:inline-block;margin-bottom:10px;">➕ Добавить помещение</a>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background:#e9f7ef;">
        <th>ID</th>
        <th>Название</th>
        <th>Тип</th>
        <th>Площадь</th>
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
                    | <a href="<?= app()->route->getUrl('/rooms/delete/' . $r->id) ?>" style="color:red" onclick="return confirm('Удалить помещение?')">Удалить</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
