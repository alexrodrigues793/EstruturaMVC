<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{

	public function login()
	{
		$mensagem = '';
		$usuario = [
			'email' => $this->request()->getString('email'),
			'senha' => $this->request()->getString('senha')
		];

		// se o formulario não foi enviado renderiza a página
		if (!$this->request()->has('formulario')) {
			return $this->render('usuario/login.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}

		// se houver algum campo vazio renderiza a página
		if (empty($usuario['email']) || empty($usuario['senha'])) {

			// envia uma mensagem de erro
			$mensagem = "Preencha todos os campos.";

			return $this->render('usuario/login.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}

		// procura na base de dados se existe algum usuário com o email informado
		$Usuario = new Usuario();
		$result = $Usuario->getByEmail($usuario['email']);

		// se não existir um usuário com o email informado renderiza a página
		if (empty($result)) {

			// envia uma mensagem de erro
			$mensagem = "Este usuário não existe.";
			
			return $this->render('usuario/login.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}

		// se as senhas não forem compatíveis envia uma mensagem de erro
		if (!password_verify($usuario['senha'], $result->senha)) {

			// envia uma mensagem de erro
			$mensagem = "A senha está incorreta.";

			return $this->render('usuario/login.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}

		// cria as sessões de usuário
		session_start();		
		$_SESSION['usuario_email'] = $usuario['email'];
		$_SESSION['usuario_nome'] = $result->nome;
		session_write_close();

		// redireciona para a página inicial
		header('Location: /');
	}

	public function sair()
	{
		// destroi as sessoẽs de usuario
		session_start();
		unset($_SESSION['usuario_email']);
		unset($_SESSION['usuario_nome']);
		session_write_close();

		// redireciona par a página de login
		header('Location: /login');
	}

	public function registrar()
	{
		
		$mensagem = '';
		$usuario = [
			'nome' => $this->request()->getString('nome'),
			'email' => $this->request()->getString('email'),
			'senha' => $this->request()->getString('senha'),
			'reSenha' => $this->request()->getString('reSenha')
		];

		// se o formulário não foi enviado renderiza apágina
		if (!$this->request()->has('formulario')) {
			return $this->render('usuario/registrar.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}
			
		// se houver algum campo vazio renderiza a página
		if (empty($usuario['nome']) || empty($usuario['email']) || empty($usuario['senha']) || empty($usuario['reSenha'])) {
			
			// envia uma mensagem de erro
			$mensagem = 'Preencha todos os campos.';

			return $this->render('usuario/registrar.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}
			
		// se as senhas estiverem diferentes renderiza a página
		if ($usuario['senha'] != $usuario['reSenha']) {

			// envia uma mensagem de erro
			$mensagem = 'As senhas não estão iguais.';

			return $this->render('usuario/registrar.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}
			
		// procura na base de dados algum usuário com o email informado
		$Usuario = new Usuario();
		$result = $Usuario->getByEmail($usuario['email']);

		// se existir um usuário com o mesmo email renderiza a página
		if (!empty($result)) {

			// envia uma mensagem de erro
			$mensagem = 'Já existe um usuário com este email.';

			return $this->render('usuario/registrar.php', ['usuario' => $usuario, 'mensagem' => $mensagem]);
		}
		
		// cria um hash da senha
		$usuario['senha'] = password_hash($usuario['senha'], PASSWORD_DEFAULT);

		// salva o usuario
		$Usuario->save($usuario);

		// redireciona para a página de login
		header('Location: /login');
	}
}
