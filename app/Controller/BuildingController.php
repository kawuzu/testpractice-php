<?php
namespace Controller;

use Model\Building;
use Src\Request;

class BuildingController
{
    public function index(): string
    {
        $buildings = Building::all();
        return app()->view->render('site.buildings', ['buildings' => $buildings]);
    }

    public function create(): string
    {
//        echo 'Создаём здание'; die;
        return app()->view->render('site.building_add');
    }

    public function store(Request $request)
    {
        if ($request->method === 'POST') {
            $building = Building::create([
                'name' => $request->name,
                'address' => $request->address
            ]);
        }

        // Редирект на список зданий через getUrl()
        app()->route->redirect(app()->route->getUrl('/buildings'));
    }

    public function edit(Request $request): string
    {
        $building = Building::find($request->id);
        return app()->view->render('site.buildings_edit', ['building' => $building]);
    }

    public function update(Request $request)
    {
        $building = Building::find($request->id);
        if ($building) {
            $building->update([
                'name' => $request->name,
                'address' => $request->address
            ]);
        }

        app()->route->redirect(app()->route->getUrl('/buildings'));
    }

    public function delete(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role === 'admin') {
            Building::destroy($request->id);
        }

        app()->route->redirect(app()->route->getUrl('/buildings'));
    }
}
