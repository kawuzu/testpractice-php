<?php
namespace Controller;

use Model\Building;
use Src\Request;

class ReportController
{
    public function index(Request $request): string
    {
        // --- Определяем префикс (если проект не в корне localhost)
        // Пример: если сайт открыт по http://localhost/testpractice/
        // то $basePath будет '/testpractice'
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

        // --- Получаем ID здания из параметра GET
        $selectedBuildingId = $_GET['building_id'] ?? '';

        // --- Загружаем все здания
        $buildings = Building::all();

        // --- Подсчёт по выбранному зданию
        if ($selectedBuildingId) {
            $building = Building::find($selectedBuildingId);

            if ($building) {
                $totalArea = $building->rooms()->sum('area');
                $totalSeats = $building->rooms()->sum('seats');

                $report = [[
                    'name' => $building->name,
                    'area' => $totalArea,
                    'seats' => $totalSeats
                ]];
            } else {
                $report = [];
            }

        } else {
            // --- Общая статистика по всем зданиям
            $report = [];
            $grandArea = 0;
            $grandSeats = 0;

            foreach ($buildings as $b) {
                $area = $b->rooms()->sum('area');
                $seats = $b->rooms()->sum('seats');

                $report[] = [
                    'name' => $b->name,
                    'area' => $area,
                    'seats' => $seats
                ];

                $grandArea += $area;
                $grandSeats += $seats;
            }

            // --- Итог по учебному заведению
            $report[] = [
                'name' => 'Всего по учебному заведению',
                'area' => $grandArea,
                'seats' => $grandSeats
            ];
        }

        // --- Передаём данные в шаблон
        return app()->view->render('site.reports', [
            'buildings' => $buildings,
            'selectedBuildingId' => $selectedBuildingId,
            'report' => $report,
            'basePath' => $basePath
        ]);
    }
}
