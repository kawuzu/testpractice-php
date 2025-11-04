<?php
namespace Controller;

use Model\Building;

class ReportController
{
    public function index(): string
    {
        $reports = Building::leftJoin('rooms', 'buildings.id', '=', 'rooms.building_id')
            ->selectRaw('buildings.id, buildings.name,
                COUNT(rooms.id) as room_count,
                COALESCE(SUM(rooms.area),0) as total_area,
                COALESCE(SUM(rooms.seats),0) as total_seats')
            ->groupBy('buildings.id')
            ->get();

        $total = [
            'area' => $reports->sum('total_area'),
            'seats' => $reports->sum('total_seats'),
        ];

        return app()->view->render('site.reports', [
            'reports' => $reports,
            'total' => $total
        ]);
    }
}
