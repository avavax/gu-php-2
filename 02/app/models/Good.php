<?php

namespace App\Models;

class Good extends Model
{
    public $id_product;
    public $product_name;
    public $product_desc;
    public $img;
    public $price;
    public $storage;
    public $color;
    public $size;
    public $raiting;
    public $discount;

    public function getTableName(): string
    {
        return 'goods';
    }

}