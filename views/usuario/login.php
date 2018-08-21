<?php
require_once ROOT_PATH . '/views/layout/header.php';

// verifica se já está logado
if (isLoged())
    header('Location: /');
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <?php if ($params['mensagem'] != ""): ?>
            <div class="alert alert-danger">
                <strong>ERRO!</strong> <?=$params['mensagem']?>
            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading">Login</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/login">
                	<div class="form-group">
                		<label for="email" class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required value="<?=$params['usuario.email']?>">
                        </div>
                	</div>

                	<div class="form-group">
                        <label for="senha" class="col-md-4 control-label">Senha</label>
                        <div class="col-md-6">
                            <input id="senha" type="password" class="form-control" name="senha" required value="<?=$params['usuario.senha']?>">
                        </div>
                    </div>

	                <div class="form-group">
	                    <div class="col-md-8 col-md-offset-4">
	                        <input type="submit" name="formulario" class="btn btn-primary" value="Login">
	                    </div>
	                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layout/footer.php' ?>
