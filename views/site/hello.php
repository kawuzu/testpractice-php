<h2>Добро пожаловать в систему "УМУ Площадь"</h2>

<p>Здравствуйте, <strong><?= htmlspecialchars($user->full_name ?? $user->name) ?></strong>!</p>

<?php if (in_array($user->role, ['admin', 'staff'])): ?>
    <!-- Верхняя навигация -->
    <div style="margin-top: 20px;">
        <nav>
            <a href="<?= app()->route->getUrl('/buildings') ?>" style="margin-right:15px;">🏢 Здания</a>
            <a href="<?= app()->route->getUrl('/rooms') ?>" style="margin-right:15px;">🏫 Помещения</a>
            <a href="<?= app()->route->getUrl('/reports') ?>" style="margin-right:15px;">📑 Отчёты</a>
            <?php if ($user->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/admin/users') ?>">👥 Пользователи</a>
            <?php endif; ?>
        </nav>
    </div>

<?php else: ?>
    <p style="color:gray;margin-top:20px;">У вас нет доступа к управлению зданиями и помещениями.</p>
<?php endif; ?>


