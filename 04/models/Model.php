<?php
namespace App\models;

use App\services\Db;
/**
 * Class Model
 * @property integer $id Поле из наследников
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
     * @return User
     */
    public static function getOne($id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return Db::getInstance()->getObject($sql, get_called_class(), [':id' => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array
     */
    public static function getAll()
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        return Db::getInstance()->getObjects($sql, get_called_class());
    }

    public function delete()
    {
        $table = static::getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    protected function insert() //должныбыть protected
    {
        //INSERT INTO users(login, password) VALUES (:login, :password)
        //[':login' => $login, ':password' => $password]

        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'db') {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $columns = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));

        $table = static::getTableName();
        $sql = "INSERT INTO {$table}
                ({$columns}) 
                VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = (integer)$this->db->getLastId();
    }

    protected function update() //должны быть protected
    {

        $columns = [];
        $params = [];
        $table = static::getTableName();

        $sql = "UPDATE {$table} SET ";

        foreach ($this as $key => $value) {
            if ($key == 'db' || $key == 'id' || !$value) {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
            $sql .= $key . '=:' . $key . ', ';
        }

        $sql = substr($sql, 0, -2) . " WHERE id=:id";
        $params[":id"] = $this->id;
        $this->db->execute($sql, $params);

        var_dump($sql);
    }

    public function save() //по id выбираться insert или update
    {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

}


