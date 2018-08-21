<?php
namespace App\Models;

use App\Core\Database;

abstract class Model
{
	protected $db;
	
	public function __construct()
	{
		// get database instance
		$dbConfig = require ROOT_PATH . '/setup/database.php';
		$db = new Database($dbConfig);
		$this->db = $db->getConnection();
	}
	
	protected function query(string $sql)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $stmt;
	}
}