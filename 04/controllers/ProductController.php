<?php
namespace App\controllers;
use App\models\Good;

class ProductController extends Controller
{
    protected $action;
    protected $defaultAction = 'products';

    public function productAction()
    {
        $productId = (int)$_GET['id'];
        $params = [
            'product' => Good::getOne($productId),
        ];
        echo $this->render('product', $params);
    }

    public function productsAction()
    {
        $params = [
            'products' => Good::getAll(),
        ];

        echo $this->render('products', $params);

    }
}