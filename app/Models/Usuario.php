<?php

namespace App\Models;

use App\Models\Model;

class Usuario extends Model
{
	public function getByEmail($email)
	{
		$result = $this->query("SELECT * FROM usuarios WHERE email = '$email'");

		return $result->fetch(\PDO::FETCH_OBJ);
	}

	public function save($usuario)
	{
		$nome = $usuario['nome'];
		$email = $usuario['email'];
		$senha = $usuario['senha'];

		$this->query("INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')");
	}
}