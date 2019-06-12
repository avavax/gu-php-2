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

    protected $columns = [];

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

        foreach ($this->columns as $key => $value) {
            if (empty($value)) {
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

    protected function update() //должныбыть protected
    {
        //UPDATE users SET login = :login, password = :password WHERE id = :id
        //[':login' => $login, ':password' => $password, ':id' => $id]

        $placeholders = [];
        $params = [];

        foreach ($this->columns as $key => $value) {
            $params[":{$key}"] = $value;
            if ($key == 'id') {
                continue;
            }
            $placeholders[] = "{$key} = :{$key}";
        }

        $placeholders = implode(', ', $placeholders);

        $table = static::getTableName();
        $sql = "UPDATE {$table} SET {$placeholders} WHERE id = :id";
        $this->db->execute($sql, $params);

    }

    public function save() //по id выбираться insert или update
    {
        $id = $this->id;
        if (empty($id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->columns)) {
            return $this->columns[$name];
        }
        return false;
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->columns)) {
            $this->columns[$name] = $value;
        }
    }

}