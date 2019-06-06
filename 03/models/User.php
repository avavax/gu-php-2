<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $fio;
    public $date;
    public $count;
    public $is_admin;

    public function getTableName(): string
    {
        return 'users';
    }

    protected function getClassName(): string
    {
        return '\App\models\User';
    }

}