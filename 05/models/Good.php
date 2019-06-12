<?php
namespace App\models;

class Good extends Model
{
    /*public $id;
    public $name;
    public $price;
    public $count;*/

    protected $columns = [
        'id' => '',
        'name' => '',
        'price' => '',
        'count' => '',
        'info' => '',        
    ];

    public static function getTableName(): string
    {
        return 'goods';
    }

}