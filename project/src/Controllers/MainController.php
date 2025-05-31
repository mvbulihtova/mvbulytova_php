<?php
// контроллер, который обрабатывает базовые страницы приложения (приветствие, прощание)

namespace src\Controllers;

use src\View\View;
use src\Services\Db;

class MainController
{
    private $view;
    // Хранит подключение к базе данных через Db::getInstance() (реализация паттерна Singleton)
    private $db;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)). '/templates');
        // Получает экземпляр подключения к базе данных (если БД потребуется в будущем)
        $this->db = Db::getInstance(); 
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello', ['name' => $name, 'title' => 'Страница приветствия']);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('main/bye', ['name' => $name, 'title' => 'Страница прощания']);
    }
}