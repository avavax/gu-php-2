<?php
namespace App\services;
interface IDb
{
    /**
     * Поиск одной записи
     *
     * @param string $sql
     * @param string $className     
     * @param array $params
     * @return array
     */
    public function find(string $sql, string $className, array $params = []);

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @param string $className     
     * @param array $params
     * @return array
     */
    public function findAll(string $sql, string $className, array $params = []): array ;

    public function execute(string $sql, array $params = []);

}