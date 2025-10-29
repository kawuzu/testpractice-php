<?php

namespace Src;

use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\MarkBased;
use FastRoute\Dispatcher\MarkBased as Dispatcher;
use Src\Traits\SingletonTrait;

class Middleware
{
    use SingletonTrait;

    private RouteCollector $middlewareCollector;

    private function __construct()
    {
        $this->middlewareCollector = new RouteCollector(new Std(), new MarkBased());
    }

    // Добавление маршрута с middleware
    public function add(string $httpMethod, string $route, array $action): void
    {
        $this->middlewareCollector->addRoute($httpMethod, $route, $action);
    }

    // Группировка маршрутов
    public function group(string $prefix, callable $callback): void
    {
        $this->middlewareCollector->addGroup($prefix, $callback);
    }

    // Запуск всех middleware для маршрута и app
    public function go(string $httpMethod, string $uri, Request $request): Request
    {
        $request = $this->runAppMiddlewares($request);
        return $this->runRouteMiddlewares($httpMethod, $uri, $request);
    }

    // Получение middleware для конкретного маршрута
    private function getMiddlewaresForRoute(string $httpMethod, string $uri): array
    {
        $dispatcherMiddleware = new Dispatcher($this->middlewareCollector->getData());
        return $dispatcherMiddleware->dispatch($httpMethod, $uri)[1] ?? [];
    }

    // Запуск middleware для конкретного маршрута
    private function runRouteMiddlewares(string $httpMethod, string $uri, Request $request): Request
    {
        $routeMiddleware = app()->settings->app['routeMiddleware'] ?? [];

        foreach ($this->getMiddlewaresForRoute($httpMethod, $uri) as $middleware) {
            $args = explode(':', $middleware);
            $class = $routeMiddleware[$args[0]] ?? null;
            if ($class) {
                $request = (new $class)->handle($request, $args[1] ?? null) ?? $request;
            }
        }

        return $request;
    }

    // Запуск глобальных middleware приложения
    private function runAppMiddlewares(Request $request): Request
    {
        $appMiddlewares = app()->settings->app['routeAppMiddleware'] ?? [];

        foreach ($appMiddlewares as $name => $class) {
            $args = explode(':', $name);
            $request = (new $class)->handle($request, $args[1] ?? null) ?? $request;
        }

        return $request;
    }
}
