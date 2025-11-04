<h2>Здания</h2>

<?php if (in_array(app()->auth->user()->role, ['admin', 'staff'])): ?>
    <a href="<?= app()->route->getUrl('/buildings/create') ?>"
       style="display:inline-block;margin-bottom:10px;">➕ Добавить здание</a>
<?php endif; ?>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background:#e9f7ef;">
        <th>ID</th>
        <th>Название</th>
        <th>Адрес</th>
        <th>Действия</th>
    </tr>

    <?php foreach ($buildings as $b): ?>
        <tr>
            <td><?= $b->id ?></td>
            <td><?= htmlspecialchars($b->name) ?></td>
            <td><?= htmlspecialchars($b->address) ?></td>
            <td>
                <a href="<?= app()->route->getUrl('/buildings/' . $b->id . '/rooms') ?>">Просмотр помещений</a>

                <?php if (app()->auth->user()->role === 'admin'): ?>
                    | <a href="<?= app()->route->getUrl('/buildings/delete/' . $b->id) ?>"
                         style="color:red"
                         onclick="return confirm('Удалить здание?')">Удалить</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php if (count($buildings) === 0): ?>
        <tr>
            <td colspan="4" style="text-align:center;color:#888;">Нет зданий</td>
        </tr>
    <?php endif; ?>
</table>
