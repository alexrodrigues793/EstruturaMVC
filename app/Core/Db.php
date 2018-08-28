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

        try
        {
            return new \PDO("mysql:host={$configs['host']};dbname={$configs['dbname']}", $configs['user'], $configs['password']);
        }
        catch (PDOEXception $error)
        {
            echo "Ops! We have an internal error.";
            exit;
        }
    }
}