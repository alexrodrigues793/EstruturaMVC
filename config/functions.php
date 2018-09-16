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
 * Função que retorna um objeto JSON
 *
 * @param $data Array que será convertida para JSON
 * @param $responseCode Codigo de resposta do servidor, padrão igual a 200 que é OK
 */
function returnJSON(array $data, int $responseCode = 200)
{
	http_response_code($responseCode);
	echo json_encode($data);
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
