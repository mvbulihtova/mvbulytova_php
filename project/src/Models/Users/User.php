<?php

namespace src\Models\Users;

use src\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $name;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    public function getNickname(): string
    {
        return $this->name;
    }

    protected static function getTableName(): string
    {
        return 'users';
    }
}