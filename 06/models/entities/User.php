<?php
namespace App\models\entities;


/**
 * Class User
 * @package App\models
 *
 * @property $id;
 * @property $login;
 * @property $password;
 */
class User extends Entity
{
    public $columns = [
        'id' => '',
        'login' => '',
//        'name' => '',
//        'fam' => '',
        'password' => '',
    ];

    public function getFullName()
    {
        return $this->name . ' ' . $this->fam;
    }
}