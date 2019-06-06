<?php
namespace App\models;

use App\services\Db;
/**
 * Class Model
 */
abstract class Model implements IModel
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

    /**
     * Получение конкретной записи
     *
     * @param $id
     * @return object
     */
    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->find($sql, $this->getClassName(), [':id' => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array of object
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->findAll($sql, $this->getClassName());
    }

    /**
     * Обновление данных
     *
     * @param $id, $newData
     * @return 
     */
    public function update(int $id, array $newData)
    {
        $sql = "UPDATE {$this->getTableName()} SET ";
        foreach($newData as $key => $value) {
            $sql .= $key . '=:' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id=:id";
        $arr = array_merge($newData, ['id' => $id]);
       
        return $this->db->execute($sql, $arr);
    }  

    /**
     * Удаление записи
     *
     * @param $id
     * @return 
     */
    public function delete(int $id)
    {
        $sql = "DELETE FROM  {$this->getTableName()} WHERE id =:id";
        return $this->db->execute($sql, [':id' => $id]);
    } 

    /**
     * Создание записи
     *
     * @param $newData // кроме id
     * @return 
     */
    public function insert(array $newData)
    {
        $sql = "INSERT INTO {$this->getTableName()} (";
        foreach($newData as $key => $value) {
            $sql .= $key . ', ';
        }
        $sql = substr($sql, 0, -2) . ') VALUES (';
        foreach($newData as $key => $value) {
            $sql .= ':' . $key . ', ';
        }        
        $sql = substr($sql, 0, -2) . ')';
        return $this->db->execute($sql, $newData);
    }  
}