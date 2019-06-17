<?php
namespace App\controllers;

use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        echo '{"user": 12, "date": "2018-09-12"}';
    }

    public function usersAction()
    {

        $userRepository = new UserRepository();

        $user = $userRepository->getOne(1);
        $userRepository->save($user);

        $params = [
            'users' => $userRepository->getAll(),
        ];

        echo $this->render('users', $params);
    }
}

//class ErrorEx extends \Exception
//{
//    public function log()
//    {
//        echo 'LogError' . $this->getMessage();
//    }
//}