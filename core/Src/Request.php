<?php
namespace Src;

use Error;

class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct()
    {
        // $_REQUEST включает данные из $_GET, $_POST и $_COOKIE
        $this->body = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->headers = getallheaders() ?? [];
    }

    // Получение всех данных запроса вместе с файлами
    public function all(): array
    {
        return $this->body + $this->files();
    }

    // Установить значение поля запроса
    public function set(string $field, $value): void
    {
        $this->body[$field] = $value;
    }

    // Получить значение поля запроса
    public function get(string $field)
    {
        return $this->body[$field] ?? null;
    }

    // ✅ Добавлено: метод input()
    public function input(string $key, $default = null)
    {
        return $this->body[$key] ?? $default;
    }

    // Получение файлов
    public function files(): array
    {
        return $_FILES ?? [];
    }

    // Магический метод для доступа к свойствам класса и полям запроса
    public function __get($key)
    {
        // Если такое свойство есть у объекта — возвращаем его
        if (property_exists($this, $key)) {
            return $this->$key;
        }

        // Если есть в теле запроса — возвращаем его
        if (array_key_exists($key, $this->body)) {
            return $this->body[$key];
        }

        // Иначе выбрасываем понятную ошибку
        throw new Error("Accessing a non-existent property: $key");
    }
}
