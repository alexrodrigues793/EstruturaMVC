<?php
namespace App\Models;

use PDO;
use App\Core\Db;

/**
 * Classe modelo de Exemplo para uma tabela de contatos
 */
class Contacts extends \App\Core\Model
{
	// nome da tabela no banco de dados
	protected static $table = "contacts";
	
	/**
	 * Método que salva um contato
	 * 
	 * @param $data Array com os dados a ser salvo
	 */
	public static function save($data)
    {
    	$stmt = Db::getConnection()->prepare("INSERT INTO ".self::$table." (name, email) VALUES (:name, :email)");
    	$stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
    	$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
    	$stmt->execute();
	}
	
	/**
	 * Método que atualiza um contato
	 * 
	 * @param $data Array com os dados a ser salvo
	 */
	public static function update($data)
	{
		$stmt = Db::getConnection()->prepare("UPDATE ".self::$table." SET name = :name, email = :email WHERE id = :id");
		$stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindValue(":id", $data["id"], PDO::PARAM_INT);
		$stmt->execute();
	}

	/**
	 * Método que deleta um contato
	 * 
	 * @param $data id a ser apagado
	 */
	public static function delete($id)
	{
		$stmt = Db::getConnection()->prepare("DELETE FROM ".self::$table." WHERE id = :id");
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
	}

    public static function getByName($name)
    {
    	$stmt = Db::getConnection()->prepare("SELECT * FROM ".self::$table." WHERE name = :name");
    	$stmt->bindValue(":name", $name, PDO::PARAM_STR);
    	$stmt->execute();

    	return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public static function getByEmail($email)
    {
    	$stmt = Db::getConnection()->prepare("SELECT * FROM ".self::$table." WHERE email = :email");
    	$stmt->bindValue(":email", $email, PDO::PARAM_STR);
    	$stmt->execute();

    	return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}