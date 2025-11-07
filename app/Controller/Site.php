<?php
namespace Controller;

use Model\Building;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;
class Site
{
    public function index(Request $request): string
    {
        // Если есть ?id=123 — возвращаем коллекцию с одним элементом
        $id = $request->get('id');

        if ($id) {
            // get() вернёт коллекцию (Illuminate\Collection)
            $buildings = Building::where('id', $id)->get();
        } else {
            // все записи
            $buildings = Building::all();
        }

        // обязательно передаём $buildings в ключе 'buildings'
        return (new View())->render('site.building', ['buildings' => $buildings]);
    }

    public function hello(): string
    {
        $user = app()->auth->user();

        // Если пользователь не авторизован
        if (!$user) {
            return (new View('site.login', ['message' => 'Сначала выполните вход']))->render();
        }

        return (new View('site.hello', ['user' => $user]))->render();
    }
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(),
                        JSON_UNESCAPED_UNICODE)]);
            }
            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.login', ['message' => 'Неправильный логин или пароль']);
    }
    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}


