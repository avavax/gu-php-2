<?php
namespace App\controllers;

use App\main\App;
use App\models\repositories\UserRepository;
use App\models\repositories\GoodRepository;
use App\models\repositories\OrderRepository;
use App\services\Request;
use App\models\entities\Good;
use App\models\entities\Order;

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

        //var_dump($this->request->getSession('admin'));
        if ( $this->request->getSession('admin') == true) {
            $this->returnAdminPanel();
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
            }
        } 

        // и возвращаемся в админку
        $this->returnAdminPanel();
    }

    // Изменение данных о товаре
    public function changeGoodAction() 
    {
        $goodId = $this->request->getParams('get')['id'];

        $goodData = $this->request->getParams('post');
 
        if ($goodData && $goodData['action'] == 'changeGood') {
            
            // проверка на пустые поля
            if ($goodData['name'] && $goodData['info'] && $goodData['price']) {
                
                // если пройдена - добавляем товар
                $newGood = new Good;
                $newGood->columns = [
                    'id' => $goodData['id'],
                    'name' => $goodData['name'],
                    'info' => $goodData['info'],
                    'price' => (int) $goodData['price']
                ];

                App::call()->goodRepository->save( $newGood );
            }
        } 

        // и возвращаемся в админку
        $this->returnAdminPanel();
    }

    // Удаление товара
    public function remGoodAction() 
    {
        $goodId = $this->request->getParams('get')['id'];

        $newGood = new Good;
        $newGood->columns = [
            'id' => $goodId,
        ];

        App::call()->goodRepository->delete( $newGood );

        // и возвращаемся в админку
        $this->returnAdminPanel();
    }

    protected function returnAdminPanel() {

        $orders = App::call()->orderRepository->getAll();

        $params = [
            'users' => App::call()->userRepository->getAll(),
            'goods' => App::call()->goodRepository->getAll(),
            'orders' => $orders
        ];
        echo $this->render('admin', $params);        
    }

    // Изменение статуса заказа
    public function changeOrderAction() {
        
        $orderId= $this->request->getParams('get')['id'];
        $orderData = $this->request->getParams('post');
        
        if ($orderData && $orderData['action'] == 'changeOrder') {
            
            // если пройдена - добавляем товар
            $newOrder = new Order;
            $newOrder->columns = [
                'id' => $orderId,
                'status' => $orderData['status'],
            ];

            App::call()->orderRepository->save( $newOrder );
            
        } 
            // и возвращаемся в админку
            $this->returnAdminPanel();
    }    
}
