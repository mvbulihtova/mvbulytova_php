<?php

namespace src\Models\Comment;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Comment extends ActiveRecordEntity
{
    protected $text;
    protected $authorId;
    protected $articleId;
    protected $createdAt;

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    // Получение автора комментария (объект User)
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }

}

