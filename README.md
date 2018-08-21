# EstruturaMVC
Estrutura simples criada por mim com objetivo de estudo, para iniciar um projeto em PHP MVC.

## Adicionar Rotas
Para adicionar rotas abra o arquivo "setup/routes.php" e dicione uma rota da seguinte maneira:

<code>Router::addRoute("caminho/da/{rota}", "SubpastaSeHouver\NomeDoControladorController@nomeDoMétodo")</code>

## Adicionar Controlador
Para adicionar um controlador, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:

<code>php escravo criar:controlador SubpastaSeHouver/NomeDoControlador</code>

O controlador será criado na pasta "app/Controllers/SubpastaSeHouver".

## Adicionar Modelo
Para adicionar um modelo, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:

<code>php escravo criar:modelo SubpastaSeHouver/NomeDoModelo</code>

O modelo será criado na pasta "app/Models/SubpastaSeHouver".

## As views
As views estão localizadas na pasta views e ne suas subpastas.

Para renderizar uma view no controlador utilize o método render:

<code>$this->render("subpastasehouver/nomedaview.php", $arrayComOsParamentrosSeHouver)</code>
