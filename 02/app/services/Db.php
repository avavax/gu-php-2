<?php

namespace App\Services;

class Db implements IDb
{
    /**
     * Поиск одной записи
     *
     * @param string $sql
     * @return string
     * @deprecated
     */
    public function find(string $sql):string
    {
        return '';
    }

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @return array
     */
    public function findAll(string $sql):array
    {
        return [];
    }

}