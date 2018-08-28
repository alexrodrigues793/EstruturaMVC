<?php
namespace App\Core;

use Philo\Blade\Blade;

class Controller
{
    /**
     * Método que renderiza uma página
     * 
     * @param $page Nome da página para renderizar
     * @param $parameters Array com os parametros para passar para página
     */
    protected function view($page, $parameters = [''])
    {
        // informa o diretorio das views e cache
        // o caminho desse diretório pode ser alterado
        // no arquivo 'app.php' na pasta 'config'
        $blade = new Blade(VIEWS_PATH, VIEWS_PATH.'cache/');
        
        // renderiza a página
        echo $blade->view()->make($page, $parameters)->render();
    }
}