<h1 style="color:#2a6f2b;">Список пользователей</h1>

<!-- Кнопка открытия модального окна -->
<div style="margin-bottom: 15px;">
    <button id="openModal"
            style="background:#4CAF50; color:white; padding:8px 14px; border:none; border-radius:5px; cursor:pointer;">
        + Добавить сотрудника
    </button>
</div>

<!-- Таблица пользователей -->
<table  style="border-collapse:collapse; font-family:Arial|sans-serif;">
    <thead style="background:#e8f5e9;">
    <tr>
        <th style="padding:8px; text-align:left;">Имя</th>
        <th style="padding:8px; text-align:left;">ФИО</th>
        <th style="padding:8px; text-align:left;">Логин</th>
        <th style="padding:8px; text-align:left;">Роль</th>
        <th style="padding:8px; text-align:left;">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td style="padding:6px;"><?= htmlspecialchars($u->name) ?></td>
            <td style="padding:6px;"><?= htmlspecialchars($u->full_name) ?></td>
            <td style="padding:6px;"><?= htmlspecialchars($u->login) ?></td>
            <td>
                <form method="post" action="<?= app()->route->getUrl('/admin/users/update') ?>" style="display:inline;">
                    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                    <input type="hidden" name="id" value="<?= $u->id ?>">
                    <select name="role" style="padding:3px 6px;">
                        <option value="admin" <?= $u->role === 'admin' ? 'selected' : '' ?>>Администратор</option>
                        <option value="staff" <?= $u->role === 'staff' ? 'selected' : '' ?>>Сотрудник деканата</option>
                        <option value="staff" <?= $u->role === 'worker' ? 'selected' : '' ?>>Сотрудник </option>
                    </select>
                    <button style="background:#4CAF50; color:white; border:none; padding:4px 8px; margin-left:4px;">Сохранить</button>
                </form>
            </td>
            <td>
                <?php if ($u->id !== app()->auth->user()->id): ?>
                    <a href="<?= app()->route->getUrl('/admin/users/delete') ?>?id=<?= $u->id ?>"
                       onclick="return confirm('Удалить пользователя <?= htmlspecialchars($u->login) ?>?')"
                       style="color:red; text-decoration:none;">
                        Удалить
                    </a>
                <?php else: ?>
                    <span style="color:gray;">(нельзя удалить себя)</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Модальное окно -->
<div id="userModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); align-items:center; justify-content:center;">
    <div style="background:white; padding:20px; border-radius:8px; width:400px; position:relative;">
        <h3>Добавление нового сотрудника</h3>

        <form method="post" action="<?= app()->route->getUrl('/admin/users/store') ?>">
            <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

            <label>Имя:<br>
                <input type="text" name="name" required>
            </label><br>

            <label>ФИО:<br>
                <input type="text" name="full_name" required>
            </label><br>

            <label>Логин:<br>
                <input type="text" name="login" required>
            </label><br>

            <label>Пароль:<br>
                <input type="password" name="password" required>
            </label><br>

            <button style="background:#4CAF50; color:white; border:none; padding:6px 10px; border-radius:4px;">
                Создать
            </button>
            <button type="button" id="closeModal"
                    style="background:#ccc; border:none; padding:6px 10px; margin-left:10px; border-radius:4px;">
                Отмена
            </button>
        </form>
    </div>
</div>

<!-- JS для модального окна -->
<script>
    document.getElementById('openModal').onclick = function() {
        document.getElementById('userModal').style.display = 'flex';
    };
    document.getElementById('closeModal').onclick = function() {
        document.getElementById('userModal').style.display = 'none';
    };
    window.onclick = function(e) {
        if (e.target === document.getElementById('userModal')) {
            document.getElementById('userModal').style.display = 'none';
        }
    };
</script>
