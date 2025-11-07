<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>УМУ Площадь</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; color: #222; }
        header { background: #e8f5e9; padding: 10px 20px; border-radius: 10px; margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #2e7d32; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <?php if (!app()->auth::check()): ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
            <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
        <?php else: ?>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth->user()->name ?>)</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>
</body>
</html>
