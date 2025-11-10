<h2>Здания</h2>

<input
        type="text"
        id="searchBuilding"
        placeholder="🔍 Поиск по зданиям..."
        style="padding:8px;width:300px;margin-bottom:10px;"
>

<a href="<?= app()->route->getUrl('/buildings/create') ?>" style="display:inline-block;margin-bottom:10px;">➕ Добавить здание</a>

<table border="1" cellpadding="6" cellspacing="0" width="100%" id="buildings-table">
    <tr style="background:#e9f7ef;">
        <th>Название</th>
        <th>Адрес</th>
        <th>Действия</th>
    </tr>
    <tbody id="buildings-body">
    <?php foreach ($buildings as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b->name) ?></td>
            <td><?= htmlspecialchars($b->address) ?></td>
            <td>
                <a href="<?= app()->route->getUrl('/buildings/' . $b->id . '/rooms') ?>">Посмотреть помещения</a>
                <?php if (app()->auth->user()->role === 'admin'): ?>
                    | <a href="<?= app()->route->getUrl('/buildings/delete/' . $b->id) ?>" style="color:red" onclick="return confirm('Удалить здание?')">Удалить</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.getElementById('searchBuilding').addEventListener('input', async function() {
        const q = this.value.trim();
        const tbody = document.getElementById('buildings-body');

        if (q.length < 1) {
            location.reload();
            return;
        }

        const res = await fetch('<?= app()->route->getUrl("/search/buildings") ?>?query=' + encodeURIComponent(q));
        const data = await res.json();

        tbody.innerHTML = '';
        data.forEach(b => {
            tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${b.id}</td>
                <td>${b.name}</td>
                <td>${b.address || ''}</td>
                <td>
                    <a href="<?= app()->route->getUrl('/buildings/') ?>${b.id}/rooms">Помещения</a>
                </td>
            </tr>
        `);
        });
    });
</script>
