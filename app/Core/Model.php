<?php
namespace App\Core;

use PDO;
use App\Core\Db;

abstract class Model
{
    /**
     * Métodos staticos abstratos que deverão ser implementados
     * em todas as classes que estenderem Model
     */
    abstract public static function save($data);

    abstract public static function update($data);

    abstract public static function delete($id);

    /**
     * Método que retorna todos os registros da tabela
     */
    public static function getAll()
    {
        $stmt = Db::getConnection()->prepare("SELECT * FROM ".static::$table);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Método que retorna um registro baseado no id informado
     */
    public static function getById($id)
    {
        $stmt = Db::getConnection()->prepare("SELECT * FROM ".static::$table." WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject();
    }
}