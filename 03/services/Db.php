<?php
namespace App\services;

use App\traits\TSingleton;

class Db implements IDb
{
    use TSingleton;

    /**
     * @var \PDO
     */
    protected $connection = null;

    private $config = [
        'driver' => 'mysql',
        'db' => 'gu_php_2',
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ];



    private function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \PDO(
                $this->getDsn(),
                $this->config['user'],
                $this->config['password']
            );
            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_CLASS
            );
        }
        return $this->connection;
    }

    private function getDsn()
    {
        //mysql:host=localhost;dbname=DB;charset=UTF8
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset']
        );
    }

    /**
     * Выполнение запроса к базе данных
     *
     * @param string $sql Пример SELECT * FROM users WHERE id = :id
     * @param array $params Пример [':id' => 2]
     * @return bool|\PDOStatement
     */
    private function query(string $sql, array $params = [])
    {

        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);

        return $PDOStatement;
    }

    /**
     * Поиск одной записи
     *
     * @param string $sql
     * @param string $className
     * @param array $params     
     * @return array
     */
    public function find(string $sql, string $className, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $className)[0];
    }

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @param string $className     
     * @param array $params
     * @return array
     */
    public function findAll(string $sql, string $className, array $params = []):array
    {
        return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * @param string $sql
     * @param array $params
     */
    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }

}