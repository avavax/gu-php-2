<?php
namespace App\models\entities;


/**
 * Class Cart
 * @package App\models
 *
 */
class Cart extends Entity
{
    public $columns = [
        'id' => '',
        'name' => '',
        'addres' => '',
        'msg' => '',
        'items' => ''
    ];

    public function getFullName()
    {
        //return $this->name . ' ' . $this->fam;
    }
}