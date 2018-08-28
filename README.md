Estrutura MVC
=============

Estrutura simples criada por mim com objetivo de estudo, para iniciar um projeto em PHP MVC.

\# Rotas
--------

Para adicionar rotas abra o arquivo "config/routes.php" e dicione uma rota da seguinte maneira:  
`Router::addGet("caminho/da/{rota}", "SubpastaSeHouver\NomeDoControladorController@nomeDoMétodo");`  
  
Você também pode passar uma função ao invés de um controlador, como:  
`Router::addGet("book/{id}", function($request){  
  view('welcome');  
});`  
  
Use os métodos addGet(), addPost(), addPut(), addPath() e addDelete(), para adicionar a rota de acordo com o tipo de requisição.

\# Controladores
----------------

Para adicionar um controlador, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:  
`php escravo criar:controlador SubpastaSeHouver/NomeDoControlador`  
  
O controlador será criado na pasta "app/Controllers/SubpastaSeHouver".

#### Como usar

Após criar o controlador, adicione um método publico para ser chamado através da rota cadastrada, como:  
`public function getIndex($request){}`  
  
Os métodos que serão chamados através da rota que você cadastrou, recebem um objeto Request. Neste objeto estão contidos todos os parametros GET e POST, os arquivos FILE e COOKIES, além dos parametros passados pela url cadastrados na rota com os símbolos '{}' exemplo: `book/{id}`.  
  
Para acessar os parametros **GET, POST e URL** passados para o método utilize a variavel $request e chame o método getParameter(), como:  
`$request->getParameter("id");`  
  
Para acessar um **FILE** e salvalo utilize a variavel $request e chame o método getFile(), como:  
`$file = $request->getFile("nome");  
  
if ($file != null){  
 $file->save(caminho/para/salvar/);  
}`

\# Modelos
----------

Para adicionar um modelo, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:  
`php escravo criar:modelo SubpastaSeHouver/NomeDoModelo`  
  
O modelo será criado na pasta "app/Models/SubpastaSeHouver".  
  
Após criar o modelo, altere a variavel statica `$table` com o nome da tabela que o modelo representará.  
  
Quando for implementar os métodos estáticos do modelo, use a variavel `$table` exemplo:  
`public static function getByName($name) {  
 $stmt = Db::getConnection()->prepare("SELECT * FROM ".self::$table." WHERE name = :name");  
 $stmt->bindValue(':name', $name, PDO::PARAM_STR);  
 $stmt->execute();  
  
 return $stmt->fetchAll(PDO::FETCH_CLASS);  
}`

#### Como usar

Para usar um modelo, adicione: `use App\Models\NomeDoModelo;` em cima do seu controlador, depois use os métodos staticos da classe modelo, exemplo: `$usuarios = NomeDoModelo::getAll();`.

\# Views
--------

As views estão localizadas na pasta views e nas suas subpastas. Para renderizar uma view no controlador utilize o método de renderização:  
`view("subpastasehouver.nomedaview", ['parametro' => 'valor do parametro']);`  
  
Para criar uma view, adicione um arquivo `nomedaview.blade.php` na pasta 'views'  
  

#### Como usar

Esta estrutura MVC utiliza a template engine Blade do laravel para renderizar as páginas, a documentação do Blade pode ser assessada aqui: [https://laravel.com/docs/5.1/blade](https://laravel.com/docs/5.1/blade)