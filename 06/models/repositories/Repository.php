<?php
namespace App\models\repositories;

use App\models\entities\Entity;
use App\services\Db;


abstract class Repository implements IRepository
{
    /**
     * @var Db
     */
    private $db;

    /**
     * Good constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    abstract protected function getEntityClass();

    /**
     * Получение конкретной записи
     *
     * @param $id
     * @return
     */
    public function getOne($id)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return Db::getInstance()->getObject($sql, $this->getEntityClass(), [':id' => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array
     */
    public function getAll()
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        return Db::getInstance()->getObjects($sql, $this->getEntityClass());
    }

    public function delete(Entity $entity)
    {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $entity->id]);
    }

    protected function insert(Entity $entity) //должныбыть protected
    {
        //INSERT INTO users(login, password) VALUES (:login, :password)
        //[':login' => $login, ':password' => $password]

        $columns = [];
        $params = [];

        foreach ($entity->columns as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));

        $table = $this->getTableName();
        $sql = "INSERT INTO {$table}
                ({$columns}) 
                VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $entity->id = (integer)$this->db->getLastId();
    }

    protected function update(Entity $entity) //должныбыть protected
    {
        //UPDATE users SET login = :login, password = :password WHERE id = :id
        //[':login' => $login, ':password' => $password, ':id' => $id]

        $placeholders = [];
        $params = [];

        foreach ($entity->columns as $key => $value) {
            $params[":{$key}"] = $value;
            if ($key == 'id') {
                continue;
            }
            $placeholders[] = "{$key} = :{$key}";
        }

        $placeholders = implode(', ', $placeholders);

        $table = $this->getTableName();
        $sql = "UPDATE {$table} SET {$placeholders} WHERE id = :id";
        $this->db->execute($sql, $params);

    }

    public function save(Entity $entity) //по id выбираться insert или update
    {
        $id = $entity->id;
        if (empty($id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

}