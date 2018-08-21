<?php
function isLoged()
{
	$isLoged = (isset($_SESSION['usuario_nome']) && isset($_SESSION['usuario_email']))? true : false;
	return $isLoged;
}

function session($key)
{
	return $_SESSION[$key] ?? "";
}