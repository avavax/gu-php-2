<?php
namespace App\models\repositories;

use App\models\entities\User;

/**
 * Class CartRepository
 * @package App\models\repositories
 *
 */
class CartRepository extends Repository
{
    public function getTableName(): string
    {
        return 'booking';
    }

    protected function getEntityClass()
    {
        return Cart::class;
    }

}