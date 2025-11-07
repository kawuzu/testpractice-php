<?php
namespace Controller;

use Model\Room;
use Model\Building;
use Src\Request;

class RoomController
{
    // --- Список всех помещений ---
    public function index(): string
    {
        $rooms = Room::join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->select('rooms.*', 'buildings.name as building_name')
            ->get();

        return app()->view->render('site.rooms', ['rooms' => $rooms]);
    }

    // --- Список помещений конкретного здания ---
    public function byBuilding(string $id, Request $request): string
    {
        $building = Building::find($id);
        if (!$building) {
            return 'Здание не найдено';
        }

        $rooms = Room::where('building_id', $id)->get();

        return app()->view->render('site.rooms_building', [
            'building' => $building,
            'rooms' => $rooms
        ]);
    }

    // --- Форма добавления помещения ---
    public function create(): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $buildings = Building::all();
        return app()->view->render('site.room_add', ['buildings' => $buildings]);
    }

    // --- Добавление нового помещения ---
    public function store(Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            Room::create([
                'name'        => $request->body['name'],
                'type'        => $request->body['type'],
                'area'        => $request->body['area'],
                'seats'       => $request->body['seats'],
                'building_id' => $request->body['building_id']
            ]);
        }

        app()->route->redirect('/rooms');
    }

    // --- Редактирование помещения ---
    public function edit(string $id, Request $request): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $room = Room::find($id);
        $buildings = Building::all();

        if (!$room) {
            return 'Помещение не найдено';
        }

        return app()->view->render('site.rooms_edit', [
            'room' => $room,
            'buildings' => $buildings
        ]);
    }

    // --- Сохранение изменений ---
    public function update(string $id, Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $room = Room::find($id);
        if ($room && $request->method === 'POST') {
            $room->update([
                'name'        => $request->body['name'],
                'type'        => $request->body['type'],
                'area'        => $request->body['area'],
                'seats'       => $request->body['seats'],
                'building_id' => $request->body['building_id']
            ]);
        }

        // после редактирования возвращаем на страницу помещений конкретного здания
        app()->route->redirect('/buildings/' . $room->building_id . '/rooms');
    }

    // --- Удаление помещения (только админ) ---
    public function delete(string $id, Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        Room::destroy($id);
        app()->route->redirect('/rooms');
    }
}
