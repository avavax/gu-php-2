<?php
namespace App\controllers;

use App\main\App;
use App\models\repositories\UserRepository;
use App\services\Request;
use App\models\entities\Good;

class AdminController extends Controller
{
    protected $defaultAction = 'admin';

    // авторизация и аутентификация
    public function adminAction()
    {
        $authData = $this->request->getParams('post');
        $adminPass = App::call()->userRepository->getOne(1)->columns;

        if (!empty($authData) && 
            $authData['login'] == $adminPass['login'] && 
            md5($authData['password']) == $adminPass['password'] ) {
            $this->request->setSession('admin', 'true');
        }

        var_dump($this->request->getSession('admin'));
        if ( $this->request->getSession('admin') == true) {
            $params = [
                'users' => App::call()->userRepository->getAll(),
                'goods' => App::call()->goodRepository->getAll()
            ];
            echo $this->render('admin', $params);
        } else {
            $params = [];
            echo $this->render('auth', $params);            
        }
    }

    // Добавление нового товара
    public function addGoodAction() 
    {
        $goodData = $this->request->getParams('post');
 
        if ($goodData && $goodData['action'] == 'addGood') {
            
            // проверка на пустые поля
            if ($goodData['name'] && $goodData['info'] && $goodData['price']) {
                
                // если пройдена - добавляем товар
                $newGood = new Good;
                $newGood->columns = [
                    'id' => '',
                    'name' => $goodData['name'],
                    'info' => $goodData['info'],
                    'price' => (int) $goodData['price']
                ];

                App::call()->goodRepository->save( $newGood );

                // и возвращаемся в админку
                $params = [
                    'users' => App::call()->userRepository->getAll(),
                    'goods' => App::call()->goodRepository->getAll()
                ];
                echo $this->render('admin', $params);
                return;
            }
        } 

        $params = [
            'good' => $goodData
        ];        
        echo $this->render('addGood', $params);

    }
}
