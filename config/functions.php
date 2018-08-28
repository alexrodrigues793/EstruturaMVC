<?php

/**
 * Função que renderiza uma página
 * 
 * @param $page Nome da página para renderizar
 * @param $parameters Array com os parametros para passar para página
 */
function view($page, $parameters = [])
{
	// informa o diretorio das views e cache
    // o caminho desse diretório pode ser alterado
    // no arquivo 'app.php' na pasta 'config'
	$blade = new \Philo\Blade\Blade(VIEWS_PATH, VIEWS_CACHE_PATH);

	// renderiza a página
    echo $blade->view()->make($page, $parameters)->render();
}

/**
 * Função que redireciona para outra pagina
 * 
 * @param $url Url da página para renderizar
 */
function redirectTo($url)
{
	$url = trim($url, '/');
	$url = '/'.$url;

	header("Location: {$url}");
}