<?php
namespace Controller;

use Model\Room;
use Model\Building;
use Src\Request;

class RoomController
{
    public function index(): string
    {
        $rooms = Room::join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->select('rooms.*', 'buildings.name as building_name')
            ->orderBy('buildings.name')
            ->get();

        $buildings = Building::all();

        return app()->view->render('site.rooms', [
            'rooms' => $rooms,
            'buildings' => $buildings
        ]);
    }

    public function create(): string
    {
        $buildings = Building::all();
        return app()->view->render('site.room_add', ['buildings' => $buildings]);
    }

    public function store(Request $request)
    {
        if ($request->method === 'POST') {
            $room = Room::create([
                'name' => $request->name,
                'type' => $request->type,
                'area' => $request->area,
                'seats' => $request->seats,
                'building_id' => $request->building_id
            ]);

            // Редирект на список помещений здания
            app()->route->redirect(app()->route->getUrl('/buildings/' . $room->building_id . '/rooms'));
        }
    }

    public function edit(Request $request): string
    {
        $room = Room::find($request->id);
        $buildings = Building::all();
        return app()->view->render('site.rooms_edit', [
            'room' => $room,
            'buildings' => $buildings
        ]);
    }

    public function update(Request $request)
    {
        $room = Room::find($request->id);
        if ($room) {
            $room->update([
                'name' => $request->name,
                'type' => $request->type,
                'area' => $request->area,
                'seats' => $request->seats,
                'building_id' => $request->building_id
            ]);

            app()->route->redirect(app()->route->getUrl('/buildings/' . $room->building_id . '/rooms'));
        }
    }

    public function delete(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role === 'admin') {
            $room = Room::find($request->id);
            $building_id = $room->building_id;
            Room::destroy($request->id);
            app()->route->redirect(app()->route->getUrl('/buildings/' . $building_id . '/rooms'));
        }
    }

    public function byBuilding(Request $request): string
    {
        $building = Building::find($request->id);
        $rooms = Room::where('building_id', $request->id)->get();

        return app()->view->render('site.rooms_building', [
            'building' => $building,
            'rooms' => $rooms
        ]);
    }
}
