<?php
namespace Controller;

use Src\Request;
use Model\Room;

class SearchController
{
    // Поиск помещений внутри определённого здания
    public function roomsByBuilding(Request $request)
    {
        $query = trim($request->query('query') ?? '');
        $buildingId = (int)($request->query('building_id') ?? 0);

        $rooms = Room::where('building_id', $buildingId)
            ->where('name', 'LIKE', "%{$query}%")
            ->get(['id', 'name', 'type', 'area', 'seats']);

        header('Content-Type: application/json');
        echo json_encode(['rooms' => $rooms]);
    }
}
