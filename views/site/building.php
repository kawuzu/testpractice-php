<h1>Перечень зданий</h1>

<ol>
    <?php if (!empty($buildings)): ?>
        <?php foreach ($buildings as $building): ?>
            <li><?= htmlspecialchars($building->name ?? 'Без названия', ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Перечень пуст</li>
    <?php endif; ?>
</ol>

