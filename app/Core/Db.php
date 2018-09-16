<?php
namespace App\Core;

/**
 * Classe responsavel por realizar a conexão com o banco de dados
 */
class Db
{
    public static function getConnection()
    {
        $configs = require(ROOT_PATH."config/database.php");
        $conn = null;

        try
        {
            $conn = new \PDO("mysql:host={$configs['host']};dbname={$configs['dbname']}", $configs['user'], $configs['password']);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOEXception $error)
        {
            echo "Ops! We have an internal error.";
            exit;
        }

        return $conn;
    }
}
