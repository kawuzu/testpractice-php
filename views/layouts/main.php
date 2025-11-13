<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'УМУ Площадь' ?></title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e8ffec;
            color: #FFFFFF;
        }

        h1, h2 {
            color: #FFFFFF;
            margin-bottom: 15px;
        }

        h3 {
            color: #2a6f2b;
            margin-bottom: 15px;
        }

        p, pre {
            color: #68a691;
        }

        a {
            color: #68A691;
            text-decoration: none;
            transition: color 0.2s;
        }

        a:hover {
            color: #C03221;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background-color: #d3ffee;
            border-left: 4px solid #68A691;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        form {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #2a6f2b;
        }

        form input, form select {
            padding: 6px 10px;
            margin-top: 4px;
            margin-bottom: 12px;
            border-radius: 4px;
            border: 1px solid #68A691;
            background-color: #d3ffee;
            color: black;
        }

        form button {
            background-color: #68A691;
            color: #FFFFFF;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }

        form button:hover {
            background-color: #C03221;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #d3ffee;
            color: black;
            border-color: #2f3b40;
        }

        table th, table td {
            padding: 8px 12px;
            border-bottom: 1px solid #68A691;
            text-align: left;
        }

        table th {
            background-color: #85d3b8;
        }

        input[type="text"], input[type="number"], select {
            background-color: #eefff9;
            color: black;
            border: 1px solid #68A691;
        }

        .no-access {
            color: #D7D5D5;
            font-style: italic;
            margin-top: 20px;
        }

        /* Модальные окна */
        .modal {
            display: none;
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #d3ffee;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
        }

        .modal-content h3 {
            margin-top: 0;
        }

        .modal-content button {
            margin-top: 10px;
        }

        button.add-btn {
            background-color: #68A691;
            color: #FFFFFF;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        button.add-btn:hover {
            background-color: #C03221;
        }

        input[type="text"]::placeholder {
            color: #D7D5D5;
        }
    </style>
</head>
<body>
<div class="container">

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
</div>
</body>
</html>
