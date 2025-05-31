<?php

// автоматически подключает PHP-классы при их первом использовании (избавляет от ручного подключения каждого класса через require)
spl_autoload_register(function(string $className) {
    // удаляем префикс 'src\' если он есть
    $className = ltrim($className, 'src\\');
    // формируем правильный путь (dirname(__DIR__).'/src/' — указывает базовый путь к папке src/; str_replace('\\', '/', $className) — заменяет обратные слэши на прямые)
    $filePath = dirname(__DIR__).'/src/'.str_replace('\\', '/', $className).'.php';
    // если файл есть, то он подключается
    if (file_exists($filePath)) {
        require_once $filePath;
        return;
    }
    // выброс в исключение
    throw new Exception("Class file not found: ".$filePath);
});

// получение текущего маршрута (?? (null coalescing) для подстановки пустой строки)
$route = $_GET['route'] ?? '';
// загрузка маршрутов (Подключает файл route.php, который возвращает массив маршрутов)
$patterns = require 'route.php';

// Поиск совпадения маршрута
$findRoute = false;
foreach ($patterns as $pattern => $controllerAndAction) {
    // проверяет совпадение URL с регулярным выражением из route.php
    if (preg_match($pattern, $route, $matches)) {
        $findRoute = true;
        // удаляет полное совпадение (оставляет только параметры)
        unset($matches[0]);
        // извлечение имени контроллера
        $nameController = $controllerAndAction[0];
        // извлечение метода
        $actionName = $controllerAndAction[1];
        // создание экземпляра контроллера
        $controller = new $nameController();
        // вызывает метод контроллера с параметрами
        $controller->$actionName(...$matches);
        break;
    }
}
// Если ни один маршрут не подошёл, показывает главную страницу (вызов ArticleController::index()
if (!$findRoute) {
    $controller = new src\Controllers\ArticleController();
    $controller->index();
}