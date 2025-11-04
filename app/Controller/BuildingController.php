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

//    public function create(): string
//    {
//        return app()->view->render('site.building_add');
//    }
//
//    public function store(Request $request)
//    {
//        if ($request->method === 'POST') {
//            $building = Building::create([
//                'name' => $request->name,
//                'address' => $request->address
//            ]);
//        }
//
//        // Редирект на список зданий через getUrl()
//        app()->route->redirect(app()->route->getUrl('/buildings'));
//    }

}
