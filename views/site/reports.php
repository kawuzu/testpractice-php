<h1 style="color:#2a6f2b;">Отчёт по площадям и местам</h1>

<table style="width:60%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead style="background:#e0f7e0;">
    <tr>
        <th style="padding:8px; text-align:left;">Здание</th>
        <th style="padding:8px; text-align:left;">Общая площадь (м²)</th>
        <th style="padding:8px; text-align:left;">Количество мест</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($report as $r): ?>
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:6px;"><?= htmlspecialchars($r['name']) ?></td>
            <td style="padding:6px;"><?= htmlspecialchars($r['area']) ?></td>
            <td style="padding:6px;"><?= htmlspecialchars($r['seats']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
