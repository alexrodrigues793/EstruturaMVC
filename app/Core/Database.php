<?php
namespace App\Core;

use \PDO;

class Database
{
	private $dbConfig;
	
	public function __construct(array $dbConfig)
	{
		$this->dbConfig = $dbConfig;
	}
	
	public function getConnection(): PDO
	{
		try {
			$pdo = new PDO('mysql:host=' . $this->dbConfig['host'] . ':' . $this->dbConfig['port'] . ';dbname=' . $this->dbConfig['dbname'], $this->dbConfig['user'], $this->dbConfig['pass']);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo 'Ops! Tivemos um error interno!';
			echo '<br>' . $e->getMessage();
			exit;
		}
	}
}