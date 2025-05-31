<?php
// модель для работы со статьями, которая наследует базовый функционал от ActiveRecordEntity

namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

// Наследует методы для работы с БД (save(), delete(), findAll() и др.)
class Article extends ActiveRecordEntity
{
    // protected - свойства доступны из текущего класса, а также из классов-наследников
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    // методы для чтения данных:

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    // методы для изменения данных:

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    // Возвращает имя таблицы в БД, с которой работает модель (родительский класс ActiveRecordEntity использует это имя для SQL-запросов)
    protected static function getTableName(): string
    {
        return 'articles';
    }
}