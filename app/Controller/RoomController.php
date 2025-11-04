<?php
namespace Controller;

use Model\Room;
use Model\Building;
use Src\Request;

class RoomController
{
    // Список всех помещений
    public function index(): string
    {
        $rooms = Room::join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->select('rooms.*', 'buildings.name as building_name')
            ->orderBy('buildings.name')
            ->get();

        return app()->view->render('site.rooms', ['rooms' => $rooms]);
    }

    // Список помещений конкретного здания
    public function byBuilding(string $id, Request $request): string
    {
        $building = Building::find($id);
        $rooms = Room::where('building_id', $id)->get();

        return app()->view->render('site.rooms_building', [
            'building' => $building,
            'rooms' => $rooms
        ]);
    }


    // Форма добавления
    public function create(): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        $buildings = Building::all();
        return app()->view->render('site.room_add', ['buildings' => $buildings]);
    }

    // Добавление нового помещения
    public function store(Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            Room::create([
                'name' => $request->body['name'],
                'type' => $request->body['type'],
                'area' => $request->body['area'],
                'seats' => $request->body['seats'],
                'building_id' => $request->body['building_id']
            ]);
        }

        app()->route->redirect('/rooms');
    }

    // Удаление помещения (только админ)
    public function delete(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        Room::destroy($request->body['id']);
        app()->route->redirect('/rooms');
    }
}
