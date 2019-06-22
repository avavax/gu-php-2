<?php
namespace App\models\entities;

/**
 * Class Good
 * @package App\models
 *
 * @property $id;
 * @property $name;
 * @property $info;
 * @property $price;
 */
class Order extends Entity
{
    public $columns = [
        'id' => '',
        'name' => '',
        'address' => '',
        'msg' => '',
        'items' => '',
        'status' => 0
    ];
}