<h2>Список пользователей</h2>

<!-- Кнопка открытия модального окна -->
<div style="margin-bottom: 15px;">
    <button id="openModal"
            style="background:#4CAF50; color:white; padding:8px 14px; border:none; border-radius:5px; cursor:pointer;">
        + Добавить сотрудника
    </button>
</div>

<!-- Таблица пользователей -->
<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:800px;">
    <thead style="background:#e8f5e9;">
    <tr>
        <th>Имя</th>
        <th>ФИО</th>
        <th>Логин</th>
        <th>Роль</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u->name) ?></td>
            <td><?= htmlspecialchars($u->full_name) ?></td>
            <td><?= htmlspecialchars($u->login) ?></td>
            <td>
                <form method="post" action="<?= app()->route->getUrl('/admin/users/update') ?>" style="display:inline;">
                    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                    <input type="hidden" name="id" value="<?= $u->id ?>">
                    <select name="role" style="padding:3px 6px;">
                        <option value="admin" <?= $u->role === 'admin' ? 'selected' : '' ?>>Администратор</option>
                        <option value="staff" <?= $u->role === 'staff' ? 'selected' : '' ?>>Сотрудник</option>
                        <option value="staff" <?= $u->role === 'worker' ? 'selected' : '' ?>>Сотрудник деканата</option>
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

<!--            <label>Роль:<br>-->
<!--                <select name="role" required>-->
<!--                    <option value="staff">Сотрудник</option>-->
<!--                    <option value="admin">Администратор</option>-->
<!--                    <option value="worker">Сотрудник деканата</option>-->
<!--                </select>-->
<!--            </label><br><br>-->

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
