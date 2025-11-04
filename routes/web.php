<?php
use Src\Route;
use Controller\AdminController;
use Controller\BuildingController;
use Controller\ReportController;
use Controller\RoomController;

// --- Пример главной ---
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');

// --- Авторизация ---
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

// --- Здания ---
Route::add('GET', '/buildings', [BuildingController::class, 'index'])->middleware('auth');
Route::add('GET', '/buildings/create', [BuildingController::class, 'create'])->middleware('auth');
Route::add('POST', '/buildings', [BuildingController::class, 'store'])->middleware('auth');
Route::add('GET', '/buildings/delete/{id}', [BuildingController::class, 'delete'])->middleware('auth');

// --- Помещения ---
Route::add('GET', '/rooms', [RoomController::class, 'index'])->middleware('auth');
Route::add('GET', '/rooms/create', [RoomController::class, 'create'])->middleware('auth');
Route::add('POST', '/rooms', [RoomController::class, 'store'])->middleware('auth');
Route::add('GET', '/rooms/delete/{id}', [RoomController::class, 'delete'])->middleware('auth');

// --- Помещения конкретного здания ---
Route::add('GET', '/buildings/{id}/rooms', [RoomController::class, 'byBuilding'])->middleware('auth');

// --- Отчёты ---
Route::add('GET', '/reports', [ReportController::class, 'index'])->middleware('auth');

// --- Админ-панель пользователей ---
Route::add('GET', '/admin/users', [AdminController::class, 'index'])->middleware('auth');
Route::add('GET', '/admin/users/create', [AdminController::class, 'create'])->middleware('auth');
Route::add('POST', '/admin/users/store', [AdminController::class, 'store'])->middleware('auth');
Route::add('POST', '/admin/users/update', [AdminController::class, 'update'])->middleware('auth');
Route::add('GET', '/admin/users/delete', [AdminController::class, 'delete'])->middleware('auth');
