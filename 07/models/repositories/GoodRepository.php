<?php
namespace App\models\repositories;

use App\models\entities\Good;

/**
 * Class GoodRepository
 * @package App\models\repositories
 *
 * @method Good getOne($id)
 */
class GoodRepository extends Repository
{
    public function getTableName(): string
    {
        return 'goods';
    }

    protected function getEntityClass()
    {
        return Good::class;
    }
}