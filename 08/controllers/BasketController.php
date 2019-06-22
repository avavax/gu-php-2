<?php
namespace App\controllers;

use App\main\App;
use App\services\Request;
use App\models\repositories\GoodRepository;
use App\models\repositories\OrderRepository;
use App\models\entities\Good;
use App\models\entities\Order;

class BasketController extends Controller
{
    protected $defaultAction = 'add';

    // Добавление заказа
    public function addAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            $this->redirect('/good');
            return;
        }

        $good = App::call()->goodRepository->getOne($id);

        if (empty($id)) {
            $this->redirect('/good');
            return;
        }
        $id = $good->id;

        $product = [
            'name' => $good->name,
            'price' => $good->price,
            'count' => 1,
        ];

        $goods = $this->request->getSession('goods');
        if (is_array($goods) && array_key_exists($id, $goods)) {
            $goods[$id]['count']++;
        } else {
            $goods[$id] = $product;
        }
        $this->request->setSession('goods', $goods);
        $this->redirect();
    }

    // Показать корзину
    public function showAction()
    {
        $goods = $this->request->getSession('goods');
        //$goods = $_SESSION['goods'];
        $totalSum = array_reduce($goods, function($carry, $item) {
            $carry += $item['count'] * $item['price'];
            return $carry;
        });

        $params = [
            'basketGoods' => $goods,
            'sum' => $totalSum,
        ];   
        echo $this->render('basket', $params);
    }

    // Оформление нового заказа
    public function checkoutAction() 
    {
        $goods = $this->request->getSession('goods');
        $orderData = $this->request->getParams('post');
 
        if ($orderData && $orderData['action'] == 'checkout') {
            
            // проверка на пустые поля
            if ($orderData['name'] && $orderData['address']) {

                // если пройдена - добавляем заказ
                $newOrder = new Good;
                $newOrder->columns = [
                    'id' => '',
                    'name' => $orderData['name'],
                    'address' => $orderData['address'],
                    'msg' => $orderData['msg'] ?: 'none',
                    'items' => json_encode($goods, JSON_UNESCAPED_UNICODE),
                    'status' => 0,
                ];

                App::call()->orderRepository->save( $newOrder );

                // и возвращаемся на страницу товаров
                $params = [
                    'goods' => App::call()->goodRepository->getAll(),
                ];

                echo $this->render('goods', $params);
                return;
            }
        } 

        $params = [
            'basketGoods' => $goods,
            'sum' => $totalSum,
        ];   
        echo $this->render('basket', $params);
    }
}