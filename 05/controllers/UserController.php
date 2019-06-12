<?php
namespace App\controllers;

use App\models\User;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $userId = (int)$_GET['id'];
        $params = [
            'user' => User::getOne($userId),
        ];
        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' => User::getAll(),
        ];

        echo $this->render('users', $params);
    }
}