<?php
// реализует паттерн Active Record для работы с базой данных

namespace src\Models;

use src\Services\Db;
use ReflectionObject;

// abstract - класс нельзя инстанцировать напрямую, только через наследование
abstract class ActiveRecordEntity
{
    protected $id;

    // Возвращает значение ID текущей сущности
    public function getId()
    {
        return $this->id;
    }

    // автоматически преобразует имена полей БД (snake_case) в camelCase свойства (Пример: поле created_at - свойство createdAt)
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    // Пр: author_id - authorId
    private function underscoreToCamelCase(string $name): string
    {
        return lcfirst(str_replace('_', '', ucwords($name, '_')));
    }

    // Пр: authorId - author_id
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $source));
    }

    // преобразует свойства объекта в формат для БД
    private function mapPropertiesToDb(): array
    {
        $reflector = new ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyDbName = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyDbName] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    // Возвращает все записи из таблицы
    public static function findAll(): ?array
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '`';
        return $db->query($sql, [], static::class);
    }

    // Находит одну запись по ID
    public static function getById(int $id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `id` = :id';
        $result = $db->query($sql, [':id' => $id], static::class);
        return $result ? $result[0] : null;
    }

    // Поиск по произвольному полю (например article_id)
    public static function findByColumn(string $columnName, $value): array
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `$tableName` WHERE `$columnName` = :value";
        $params = [':value' => $value];
        return $db->query($sql, $params, static::class) ?? [];
    }

    // Определяет, нужно ли обновлять существующую запись или создавать новую (по ID)
    public function save(): void 
    {
        if ($this->getId()) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    // Формирует динамический UPDATE-запрос
    private function update(): void
    {
        $mappedProperties = $this->mapPropertiesToDb();
        $columnsToUpdate = [];
        $params = [];

        foreach ($mappedProperties as $columnName => $value) {
            if ($columnName === 'id') continue;
            $param = ':' . $columnName;
            $columnsToUpdate[] = "`$columnName` = $param";
            $params[$param] = $value;
        }

        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columnsToUpdate) . ' WHERE `id` = :id';
        $params[':id'] = $this->id;

        $db = Db::getInstance();
        $db->query($sql, $params);
    }

    // Создаёт новую запись в БД (после вставки обновляет ID объекта)
    private function insert(): void
    {
        $mappedProperties = $this->mapPropertiesToDb();
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params = [];

        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = "`$columnName`";
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params[$paramName] = $value;
        }

        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $paramsNames) . ')';
        $db = Db::getInstance();
        $db->query($sql, $params);

        $this->id = $db->getLastInsertId();
    }

    // Удаляет текущую запись из БД по ID
    public function delete(): void
    {
        $db = Db::getInstance();
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE `id` = :id';
        $db->query($sql, [':id' => $this->id]);
    }

    // Абстрактный метод, который должен быть реализован в дочернем классе
    abstract protected static function getTableName(): string;
}
