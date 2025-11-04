<h2>Отчёты по зданиям</h2>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background:#e9f7ef;">
        <th>Здание</th>
        <th>Количество помещений</th>
        <th>Суммарная площадь (м²)</th>
        <th>Количество мест</th>
    </tr>
    <?php foreach ($reports as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r->name) ?></td>
            <td><?= $r->room_count ?></td>
            <td><?= number_format($r->total_area, 2, ',', ' ') ?></td>
            <td><?= $r->total_seats ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Итого по всем зданиям:</strong><br>
    Площадь — <?= number_format($total['area'], 2, ',', ' ') ?> м²<br>
    Мест — <?= $total['seats'] ?></p>
