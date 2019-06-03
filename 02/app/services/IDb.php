<?php

namespace App\Services;

interface IDb
{
    /**
     * Поиск одной записи
     *
     * @param string $sql
     * @return string
     */
    public function find(string $sql): string ;

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @return array
     */
    public function findAll(string $sql): array ;

}