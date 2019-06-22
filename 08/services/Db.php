<?php
namespace App\services;

use App\traits\TSingleton;

/**
 * Class Db
 * @package App\services
 * @method static self getInstance
 */
class Db implements IDb
{
    /**
     * @var \PDO
     */
    protected $connection = null;

    private $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

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
                \PDO::FETCH_ASSOC
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

    public function getObject($sql, $class, $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetch();
    }

    public function getObjects($sql, $class, $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetchAll();
    }

    /**
     * Поиск одной записи
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function find(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function findAll(string $sql, array $params = []):array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * @param string $sql
     * @param array $params
     */
    public function execute(string $sql, array $params = []):void
    {
        $this->query($sql, $params);
    }

    public function getLastId()
    {
        return $this->getConnection()->lastInsertId();
    }

}