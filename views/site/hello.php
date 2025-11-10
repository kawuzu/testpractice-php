<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>УМУ Площадь</title>
    <style>
        /* Основные стили */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #36494E; /* тёмный фон */
            color: #FFFFFF; /* основной текст */
        }

        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1em;
            line-height: 1.5;
            color: #D7D5D5; /* второстепенный текст */
        }

        /* Плашки */
        .card {
            background-color: #36494E;
            border-left: 4px solid #68A691; /* зелёный акцент */
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        /* Навигация */
        nav a {
            display: inline-block;
            text-decoration: none;
            color: #FFFFFF;
            padding: 8px 15px;
            border-radius: 6px;
            background-color: #68A691; /* зелёный акцент */
            margin-right: 10px;
            transition: background-color 0.2s, transform 0.2s;
        }

        nav a:hover {
            background-color: #C03221; /* красный при наведении */
            transform: translateY(-2px);
        }

        /* Скрытый текст для пользователей без прав */
        .no-access {
            color: #D7D5D5;
            font-style: italic;
            margin-top: 20px;
        }

        /* Контейнер */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Добро пожаловать в систему "УМУ Площадь"</h2>
        <p>Здравствуйте, <strong><?= htmlspecialchars($user->full_name ?? $user->name) ?></strong>!</p>

    <?php if (in_array($user->role, ['admin', 'staff'])): ?>
            <nav>
                <a href="<?= app()->route->getUrl('/buildings') ?>">🏢 Здания</a>
                <a href="<?= app()->route->getUrl('/rooms') ?>">🏫 Помещения</a>
                <a href="<?= app()->route->getUrl('/reports') ?>">📑 Отчёты</a>
                <?php if ($user->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/admin/users') ?>">👥 Пользователи</a>
                <?php endif; ?>
            </nav>
        </div>
    <?php else: ?>
        <p class="no-access">У вас нет доступа к управлению зданиями и помещениями.</p>
    <?php endif; ?>
</div>
</body>
</html>
