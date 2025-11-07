<?php
namespace Controller;

use Model\Building;
use Src\Request;

class BuildingController
{
    // --- Просмотр списка зданий ---
    public function index(Request $request): string
    {
        $query = $request->body['search'] ?? '';

        if (!empty($query)) {
            $buildings = \Model\Building::where('name', 'like', "%{$query}%")
                ->orWhere('address', 'like', "%{$query}%")
                ->get();
        } else {
            $buildings = \Model\Building::all();
        }

        return app()->view->render('site.buildings', [
            'buildings' => $buildings,
            'search' => $query
        ]);
    }


    // --- Форма добавления (STAFF и ADMIN) ---
    public function create(): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        return app()->view->render('site.building_add');
    }

    // --- Добавление нового здания ---
    public function store(Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            Building::create([
                'name'    => $request->body['name'],
                'address' => $request->body['address']
            ]);
        }

        app()->route->redirect('/buildings');
    }

    // --- Редактирование здания ---
    public function edit(string $id, Request $request): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $building = Building::find($id);
        if (!$building) {
            return 'Здание не найдено';
        }

        return app()->view->render('site.buildings_edit', ['building' => $building]);
    }

    // --- Обновление данных здания ---
    public function update(string $id, Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $building = Building::find($id);
        if ($building && $request->method === 'POST') {
            $building->update([
                'name'    => $request->body['name'],
                'address' => $request->body['address']
            ]);
        }

        app()->route->redirect('/buildings');
    }

    // --- Удаление здания (только ADMIN) ---
    public function delete(string $id, Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        Building::destroy($id);
        app()->route->redirect('/buildings');
    }

    public function searchAll(Request $request)
    {
        $query = trim($request->body['query'] ?? '');

        // Если ничего не введено — возвращаем пусто
        if ($query === '') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([]);
            exit;
        }

        $buildings = \Model\Building::where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->get(['id', 'name', 'address']);

        $rooms = \Model\Room::where('name', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->get(['id', 'name', 'type', 'building_id']);

        // Собираем всё вместе
        $result = [
            'buildings' => $buildings,
            'rooms' => $rooms
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function hello(): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        return app()->view->render('site.hello');
    }

    // 🔍 Поиск зданий по названию или адресу (AJAX)
    public function searchBuildings(Request $request)
    {
        $query = trim($request->body['query'] ?? $_GET['query'] ?? '');

        if ($query === '') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([]);
            exit;
        }

        $buildings = \Model\Building::where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->get(['id', 'name', 'address']);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($buildings, JSON_UNESCAPED_UNICODE);
        exit;
    }

}
