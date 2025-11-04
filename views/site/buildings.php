<h2>Здания</h2>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background:#e9f7ef;">
        <th>ID</th>
        <th>Название</th>
        <th>Адрес</th>
    </tr>
    <?php foreach ($buildings as $b): ?>
        <tr>
            <td><?= $b->id ?></td>
            <td><?= htmlspecialchars($b->name) ?></td>
            <td><?= htmlspecialchars($b->address) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
