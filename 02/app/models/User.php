<?php

namespace App\Models;

class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $status;
    public $name;
    public $phone;
    public $email;


    public function getTableName(): string
    {
        return 'users';
    }
}