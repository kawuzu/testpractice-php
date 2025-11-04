<?php
namespace Controller;

use Model\User;
use Src\Request;
use Src\View;

class AdminController
{
    // Список всех пользователей
    public function index(): string
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        $users = User::all();
        return (new View('site.admin_users', ['users' => $users]))->render();
    }

    // Форма добавления нового пользователя
    public function create(): string
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        return (new View('site.admin_user_add'))->render();
    }

    // Сохранение нового пользователя в БД
    public function store(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        if ($request->method === 'POST') {
            // получаем все данные формы
            $data = $request->body;

            // Проверка уникальности логина
            if (User::where('login', $data['login'])->exists()) {
                return 'Ошибка: пользователь с таким логином уже существует';
            }

            // Создание нового пользователя
            User::create([
                'name'       => $data['name'],
                'full_name'  => $data['full_name'],
                'login'      => $data['login'],
                'password'   => md5($data['password']),
                'role'       => $data['role'],
            ]);
        }

        app()->route->redirect('/admin/users');
    }

    // Изменение роли существующего пользователя
    public function update(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        // Используем глобальные массивы вместо $request->body
        $id = $_POST['id'] ?? null;
        $role = $_POST['role'] ?? null;

        if ($id && $role) {
            $target = User::find($id);
            if ($target) {
                $target->role = $role;
                $target->save();
            }
        }

        app()->route->redirect('/admin/users');
    }

    // Удаление пользователя
    public function delete(Request $request)
    {
        $user = app()->auth->user();
        if ($user->role !== 'admin') {
            return 'Доступ запрещён';
        }

        $id = $_GET['id'] ?? null;

        if ($id && $id != $user->id) {
            $target = User::find($id);
            if ($target) {
                $target->delete();
            }
        }

        app()->route->redirect('/admin/users');
    }
}
