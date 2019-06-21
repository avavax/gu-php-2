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
class Good extends Entity
{
    public $columns = [
        'id' => '',
        'name' => '',
        'info' => '',
        'price' => '',
    ];
}