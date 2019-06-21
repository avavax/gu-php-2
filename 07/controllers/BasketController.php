<?php
namespace App\controllers;

use App\main\App;

class BasketController extends Controller
{
    protected $defaultAction = 'add';

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

    public function showAction()
    {
        var_dump($_SESSION);
    }
}