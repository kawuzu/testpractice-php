<h1 style="color:#2a6f2b;">Отчёт по площадям и местам</h1>

<form method="get" action="<?= $basePath ?>/reports" style="margin-bottom:15px;">
    <label for="building_id">Выберите здание:</label>
    <select name="building_id" id="building_id" style="padding:5px; border:1px solid #ccc; border-radius:4px;">
        <option value="">Все здания</option>
        <?php foreach ($buildings as $b): ?>
            <option value="<?= $b->id ?>" <?= ($selectedBuildingId == $b->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($b->name) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" style="padding:6px 12px; background:#2a6f2b; color:white; border:none; border-radius:4px; cursor:pointer;">
        Показать
    </button>
</form>

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
