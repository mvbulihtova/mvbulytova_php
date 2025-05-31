<?php
// реализует подключение к базе данных и выполнение запросов с использованием паттерна Singleton

namespace src\Services;

class Db
{
    // хранит подключение к БД (объект PDO)
    private $pdo;
    // статическое поле для хранения единственного экземпляра класса (Singleton)
    private static $instance;

    // Загружает настройки из settings.php; создаёт подключение через PDO; устанавливает кодировку UTF-8
    private function __construct()
    {
        $dbOptions = require('settings.php');
        $this->pdo = new \PDO(
            'mysql:host='.$dbOptions['host'].';dbname='.$dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    // Singleton: если экземпляр не создан (null), создаёт новый; возвращает существующий экземпляр при повторных вызовах
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // $sql - SQL-запрос (с плейсхолдерами типа :id); $params - ассоциативный массив параметров ([':id' => 1]); $className - имя класса, в объекты которого нужно преобразовать результат
    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        // Подготавливает запрос
        $sth = $this->pdo->prepare($sql);
        // Выполняет его с параметрами
        $result = $sth->execute($params);

        if ($result === false) {
            $errorInfo = $sth->errorInfo();
            error_log("SQL Error: " . print_r($errorInfo, true));
            return null;
        }

        // Возвращает массив объектов указанного класса (FETCH_CLASS)
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    // Возвращает ID последней вставленной записи
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}