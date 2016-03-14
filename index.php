<?php
session_start();
unset($_SESSION['api_key'], $_SESSION['InfoPaciente']);

require_once 'config.php';
require_once( $_SERVER['DOCUMENT_ROOT'] . "/global.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $cidadeInfo->clie_nome . " | " . $cidadeInfo->clie_app_nome ?></title>

        <link href="/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="/css/animate.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap/js/bootstrap.min.js"></script>
        <script src="/js/jquery.maskedinput.min.js"></script>
        <script src="js/index.js"></script>
        <script type="text/javascript">
        jQuery(function($){
			$("#celular").mask("(99) 9999-9999");
        });
        </script>
        <style type="text/css">
        body {
        	color: white;
        }

        a {
        	color: white;
        	text-decoration: underline;
        }

        a:hover {
        	color: #f5f5f0;
        }

        .form-control {
        	color: black;
        }
        </style>

    </head>
    <body class="gray-bg" style="background-color: #3bb95c">

    <div class="col-sm-4"></div>

    <div class="col-sm-4">
    <div class="animated fadeInDown">
    	<center>
    		<h1>Secretaria Municipal de Saúde</h1>
    		<h2 class="font-bold"><?= $cidadeInfo->clie_app_nome ?></h2>
    		<br>
    		<img src="<?php echo $cidadeInfo->clie_logomarca ?>" class="img-responsive img-rounded" alt="Consultas Agendadas" style="width: 110px; height: 110px">
    		<br>
            <p>
            	<h3>Agendamento de Consultas nas UBS</h3>
            </p>
            <br>
    	</center>
    </div>
                <div class="col-lg-12">
                    <div class="ibox-contnt">
                        <form class="m-t" role="form" action="acoes.php?acoes=acesso" method="post" id="login">
                            <div style="padding-bottom: 15px;">
                                <img class="img-responsive"
                                     src="/img/sus.png"
                                     alt="" />
                            </div>

		                    <div class="alert alert-danger" id="erroCns">
		                        O CNS digitado é inválido.
		                    </div>

                            <div class="form-group">
                                <input type="number" maxlength="15" class="form-control"
                                       placeholder="Cartão SUS" required="true" name="cns" id="cns" autofocus="true"
                                       required onkeypress="return Onlynumbers(event)" value="<?php if (isset($_COOKIE['cns'])) { echo $_COOKIE['cns']; }?>">
                            </div>
                            <div class="form-group">
                                <label>Celular</label>
                                <input type="text" id="celular"
                                class="form-control" placeholder="(62) 0000-0000" required="yes" name="celular" required value="
                                <?php if (isset($_COOKIE['celular'])) { echo $_COOKIE['celular']; }?>">
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b" style="background-color: #ff9800">Acessar</button>

                            <a href="/modulos/ObterCartaoSUS.php"> <small class="text-center">Como obter o Cartão do
                                    SUS? <b>Saiba mais.</b>
                                </small>
                            </a>
                        </form>
                        <p class="m-t text-center">
                            <small>Dúvidas? Entre em <a href="mailto:ajuda@apprefeitura.com">contato conosco</a></small>
                        </p>
                    </div>
                </div>
            <div class="col-md-6 text-left">
				<small>powered by ASIX6</small>
			</div>
			<div class="col-md-6 text-right">
				<small>© 2014-2016</small>
			</div>
            </div>

    </body>
</html>