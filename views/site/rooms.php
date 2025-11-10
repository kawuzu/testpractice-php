<h2>Помещения</h2>

<input
        type="text"
        id="searchRoom"
        placeholder="🔍 Поиск по помещениям..."
        style="padding:8px;width:300px;margin-bottom:10px;"
>

<a href="<?= app()->route->getUrl('/rooms/create') ?>" style="display:inline-block;margin-bottom:10px;">➕ Добавить помещение</a>

<table border="1" cellpadding="6" cellspacing="0" width="100%" id="rooms-table">
    <tr style="background:#e9f7ef;">
        <th>Название</th>
        <th>Тип</th>
        <th>Площадь</th>
        <th>Места</th>
        <th>Здание</th>
        <th>Действия</th>
    </tr>
    <tbody id="rooms-body">
    <?php foreach ($rooms as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r->name) ?></td>
            <td><?= htmlspecialchars($r->type) ?></td>
            <td><?= $r->area ?></td>
            <td><?= $r->seats ?></td>
            <td><?= htmlspecialchars($r->building_name) ?></td>
            <td>
                <?php if (app()->auth->user()->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/rooms/delete/' . $r->id) ?>" style="color:red" onclick="return confirm('Удалить помещение?')">Удалить</a>
                <?php else: ?>
                   <p style="color:gray"> у вас нет доступных действий </p>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    document.getElementById('searchRoom').addEventListener('input', async function() {
        const q = this.value.trim();
        const tbody = document.getElementById('rooms-body');

        if (q.length < 1) {
            location.reload();
            return;
        }

        const res = await fetch('<?= app()->route->getUrl("/search/rooms") ?>?query=' + encodeURIComponent(q));
        const data = await res.json();

        tbody.innerHTML = '';
        data.forEach(r => {
            tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${r.name}</td>
                <td>${r.type}</td>
                <td>${r.area}</td>
                <td>${r.seats}</td>
                <td>${r.building_name}</td>
                <td>
                   <?php if (app()->auth->user()->role === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/rooms/delete/' . $r->id) ?>" style="color:red" onclick="return confirm('Удалить помещение?')">Удалить</a>
                <?php else: ?>
                   <p style="color:gray"> у вас нет доступных действий </p>
                <?php endif; ?>
                </td>
            </tr>
        `);
        });
    });
</script>
