<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $name;
    public $price;
    public $count;

    public static function getTableName(): string
    {
        return 'goods';
    }

}