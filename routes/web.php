<?php
use Src\Route;
use Controller\AdminController;
use Controller\BuildingController;
use Controller\RoomController;
use Controller\ReportController;

// --- Пример главной ---
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');

// --- Авторизация ---
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

// --- Здания ---
Route::add('GET', '/buildings', [BuildingController::class, 'index'])->middleware('auth');
//Route::add('GET', '/buildings/create', [BuildingController::class, 'create'])->middleware('auth');

// --- Помещения ---
//Route::add('GET', '/rooms', [RoomController::class, 'index'])->middleware('auth');

// --- Отчёты ---
Route::add('GET', '/reports', [ReportController::class, 'index'])->middleware('auth');

// --- Админ-панель пользователей ---
Route::add('GET', '/admin/users', [AdminController::class, 'index'])->middleware('auth');
Route::add('GET', '/admin/users/create', [AdminController::class, 'create'])->middleware('auth');
Route::add('POST', '/admin/users/store', [AdminController::class, 'store'])->middleware('auth');
Route::add('POST', '/admin/users/update', [AdminController::class, 'update'])->middleware('auth');
Route::add('GET', '/admin/users/delete', [AdminController::class, 'delete'])->middleware('auth');
