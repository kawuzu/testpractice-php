<?php
namespace Controller;

use Model\Building;
use Src\Request;

class BuildingController
{
    // Просмотр списка зданий
    public function index(): string
    {
        $buildings = Building::all();
        return app()->view->render('site.buildings', ['buildings' => $buildings]);
    }

    // Форма добавления (STAFF и ADMIN)
    public function create(): string
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        return app()->view->render('site.building_add');
    }

    // Добавление нового здания
    public function store(Request $request)
    {
        $user = app()->auth->user();
        if (!in_array($user->role, ['admin', 'staff'])) {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            Building::create([
                'name' => $request->body['name'],
                'address' => $request->body['address']
            ]);
        }

        app()->route->redirect('/buildings');
    }

    // Удаление (только ADMIN)
    public function delete(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        Building::destroy($request->body['id']);
        app()->route->redirect('/buildings');
    }
}
