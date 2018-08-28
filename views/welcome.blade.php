<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estrutura MVC</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        section {
            margin: 50px 0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <section id="header">
            <h1>Estrutura MVC</h1>
            <p>Estrutura simples criada por mim com objetivo de estudo, para iniciar um projeto em PHP MVC.</p>
        </section>

        <section id="rotas">
            <h2># Rotas</h2>
            <p>
                Para adicionar rotas abra o arquivo "config/routes.php" e dicione uma rota da seguinte maneira: <br>
                <code>Router::addGet("caminho/da/{rota}", "SubpastaSeHouver\NomeDoControladorController@nomeDoMétodo");</code> <br><br>

                Você também pode passar uma função ao invés de um controlador, como:<br>
                <code>Router::addGet("book/{id}", function($request){<br>&emsp; view('welcome');<br> });</code><br><br>

                Você também pode adicionar um grupo de rotas baseado em um prefixo, exemplo:<br>
                <code>
                    Router::group("dashboard", function() {<br>
                        &emsp;Router::addGet("/", "DashboardController@getIndex");<br>
                        <br>
                        &emsp;Router::group("post", function() {<br>
                            &emsp;&emsp;Router::addGet("/", "PostController@getIndex");<br>
                            <br>                            
                            &emsp;&emsp;Router::addGet("/post/{id}", "PostController@getPost");<br>
                        &emsp;});<br>
                    });
                </code><br><br>
                
                Use os métodos addGet(), addPost(), addPut(), addPath() e addDelete(), para adicionar a rota de acordo com o tipo de requisição.
            </p>
        </section>

        <section id="controladores">
            <h2># Controladores</h2>
            <p>
                Para adicionar um controlador, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:<br>
                <code>php escravo criar:controlador SubpastaSeHouver/NomeDoControlador</code><br><br>
                O controlador será criado na pasta "app/Controllers/SubpastaSeHouver".
            </p>

            <h4>Como usar</h4>
            <p>
                Após criar o controlador, adicione um método publico para ser chamado através da rota cadastrada, como:<br>
                <code>public function getIndex($request){}</code><br><br>

                Os métodos que serão chamados através da rota que você cadastrou, recebem um objeto Request. Neste objeto
                estão contidos todos os parametros GET e POST, os arquivos FILE e COOKIES, além dos parametros passados pela url cadastrados
                na rota com os símbolos '{}' exemplo: <code>book/{id}</code>.<br> <br>

                Para acessar os parametros <b>GET, POST e URL</b> passados para o método utilize a variavel $request e chame o método getParameter(), como:<br>
                <code>$request->getParameter("id");</code><br><br>

                Para acessar um <b>FILE</b> e salvalo utilize a variavel $request e chame o método getFile(), como:<br>
                <code>
                    $file = $request->getFile("nome");<br><br>

                    if ($file != null){<br>
                        &emsp;$file->save(caminho/para/salvar/);<br>
                    }
                </code>
            </p>
        </section>

        <section id="modelos">
            <h2># Modelos</h2>
            <p>
                Para adicionar um modelo, vá na pasta raiz do projeto onde contém o arquivo "escravo" e digite no terminal:<br>
                <code>php escravo criar:modelo SubpastaSeHouver/NomeDoModelo</code><br><br>
                O modelo será criado na pasta "app/Models/SubpastaSeHouver".<br><br>
                Após criar o modelo, altere a variavel statica <code>$table</code> com o nome da tabela que o modelo representará.<br><br>
                Quando for implementar os métodos estáticos do modelo, use a variavel <code>$table</code> exemplo:<br>
                <code>
                    public static function getByName($name) { <br>
                        &emsp;$stmt = Db::getConnection()->prepare("SELECT * FROM ".self::$table." WHERE name = :name");<br>
                        &emsp;$stmt->bindValue(':name', $name, PDO::PARAM_STR);<br>
                        &emsp;$stmt->execute();<br><br>

                        &emsp;return $stmt->fetchAll(PDO::FETCH_CLASS);<br>
                    }
                </code>
            </p>

            <h4>Como usar</h4>
            <p>
                Para usar um modelo, adicione: <code>use App\Models\NomeDoModelo;</code> em cima do seu controlador, depois use os métodos
                staticos da classe modelo, exemplo: <code>$usuarios = NomeDoModelo::getAll();</code>.
            </p>
        </section>

        <section id="views">
            <h2># Views</h2>
            <p>
                As views estão localizadas na pasta views e nas suas subpastas.
                Para renderizar uma view no controlador utilize o método de renderização:<br>
                <code>view("subpastasehouver.nomedaview", ['parametro' => 'valor do parametro']);</code><br><br>

                Para criar uma view, adicione um arquivo <code>nomedaview.blade.php</code> na pasta 'views'<br><br>
            </p>

            <h4>Como usar</h4>
            <p>
                Esta estrutura MVC utiliza a template engine Blade do laravel para renderizar as páginas, a documentação do Blade
                pode ser assessada aqui: <a href="https://laravel.com/docs/5.1/blade" target="_blank">https://laravel.com/docs/5.1/blade</a>
            </p>
        </section>
    </div>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>