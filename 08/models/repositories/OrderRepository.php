<?php
namespace App\models\repositories;

use App\models\entities\Order;

class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return 'booking';
    }

    protected function getEntityClass()
    {
        return Order::class;
    }
}