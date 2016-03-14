<?php
include( $_SERVER['DOCUMENT_ROOT'] . "/global.php");

if(!$util->estaLogado()) {
	header('Location: /index.php');
}

// Obter e salvar alertas
$url_alertas = $url . '/alerta/obter_alertas';
$header_alertas = array($header[0], "X-Apprefeitura-ApiKey: " . $dados->{conteudo}->paci_api_key);
$alerta = $util->conectarCurl($header_alertas, $url_alertas);

$alertasQuantidade = 0;
$totalDeAlertas = 0;
// var_dump($header_alertas);
if ($alerta->{'conteudo'} != null) {
	foreach ($alerta->{'conteudo'} as $alertas) {
		$totalDeAlertas++;
	    if (($alertas->alde_lida) == null) {
	        $alertasQuantidade++;
	    }
	}
}


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
        <link href="/css/style-adicional.css" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        <script src="/js/bootstrap/js/bootstrap.min.js"></script>

        <!-- Mainly scripts -->
        <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
                <script src="/js/jquery.maskedinput.min.js"></script>
        <script src="/js/global.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="/js/inspinia.js"></script>
        <script src="/js/plugins/pace/pace.min.js"></script>

        <!-- Date picker -->
        <script type="text/javascript" src="/js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="/js/plugins/datepicker/bootstrap-datepicker.pt-BR.js"></script>
        <link href="/css/plugins/datepicker/datepicker3.css" rel="stylesheet">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    </head>

    <body>
        <div id="wraper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span> <img alt="image" class="img-circle" src="<?php
                                if(($foto =  $dados->{'conteudo'}->paci_foto) == null) : echo "https://apprefeitura.s3.amazonaws.com/paciente/padrao.jpg";  else : echo $foto; endif ?>" style="width: 48px;">
                                </span>
                                <p style="margin-top: 10px">
                                <span class="clear"> <span class="" style="color: white">
                                <?php
									$PriNome = explode(" ", $dados->{'conteudo'}->paci_nome);
									echo ucfirst(strtolower($PriNome[0]));
								?>

                                        </span>
                                        </p>
                            </div>
                            <div class="logo-element">IN</div>
                        </li>
                        <li><a href="/Inicio.php"><i class="fa fa-home"></i> <span
                                    class="nav-label">Início </span></a></li>
                        <li><a href="/modulos/ConsultasAgendadas.php"><i class="fa fa-medkit"></i> <span
                                    class="nav-label">Consultas Agendadas </span></a></li>
                        <li><a href="/modulos/ConsultasRealizadas.php"><i class="fa fa-user-md"></i> <span
                                    class="nav-label">Consultas Realizadas </span></a></li>
                        <li><a href="/modulos/ConsultasCanceladas.php"><i class="fa fa-list"></i> <span class="nav-label">Consultas
                                    Canceladas </span></a></li>
                        <hr>
                        <li><a href="/modulos/Perfil.php"><i class="fa fa-user"></i> <span class="nav-label">Perfil
                                </span></a></li>
                        <li><a href="/modulos/MinhaCasa.php"><i class="fa fa-map-marker"></i> <span
                                    class="nav-label">Minha Casa</span></a></li>
                        <li><a href="/modulos/Avisos.php"><i class="fa fa-bell-o"></i> <span
                                    class="nav-label">Avisos
                                        <?php if ($alertasQuantidade == 0) {

                                        } else { ?>
                                        <span class="label label-danger" id="alertaEsquerda"> <?php echo $alertasQuantidade;
                                        } ?>
                                    </span>
                                </span></a></li>
                        <hr>
                        <li><a href="/logout.php"><i class="fa fa-sign-out"></i> <span
                                    class="nav-label">Sair </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
		</div>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation"
                         style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
                               href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li><span class="m-r-sm text-muted welcome-message">Bem Vindo, <?php echo ucwords(strtolower($dados->{'conteudo'}->paci_nome)); ?></span>
                            </li>

                            <li class="dropdown" id="menuAlerta">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" >
                                    <i class="fa fa-bell"></i>
							<?php if ($alertasQuantidade == 0) {

							} else { ?>
                                    <span class="label label-danger" id="alertaTopo"> <?php echo $alertasQuantidade;
							} ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts" >

							<?php
							$i = 0;
						if ($alerta->{'conteudo'} != null) {
							foreach (array_reverse($alerta->{'conteudo'}) as $alertas) {
								$i++;
							    if ($totalDeAlertas != 0 && $i <= 4) {
							        ?>
                                            <li>
                                                <a href="#">
                                                    <div>
                                                        <i class="fa fa-envelope fa-fw"></i> <?php echo $alertas->alde_mensagem ?>
                                                        <span class="pull-right text-muted small"></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
						}
                                    if ($totalDeAlertas == 0) {
                                        ?>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <i class="fa fa-envelope fa-fw"></i> Nenhum aviso recente.
                                                    <span class="pull-right text-muted small"></span>
                                                </div>
                                            </a>
                                        </li>


									    <?php
									}
									?>

                                </ul>
                            </li>

                            <li><a href="/logout.php"> <i class="fa fa-sign-out"></i> Sair
                                </a></li>

                        </ul>
                    </nav>
                </div>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="text-center loginscreen animated fadeInDown">
                        <div class="row">
                            <div class="container-fluid">
                                <h2>Secretaria Municipal de Saúde</h2>
                                <h3 class="font-bold"><?= $cidadeInfo->clie_app_nome ?></h3>
                                <br>
                                <center>
                                    <img src="<?php echo $cidadeInfo->clie_logomarca ?>" class="img-responsive img-rounded" alt="Consultas Agendadas" style="width: 110px; height: 110px">
                                </center>
                                <br>
                                <p>
                                    <strong><h3>Agendamento de Consultas nas UBS</h3></strong>
									<p>
				                        <?php if (($ubs = $dados->{'conteudo'}->ubs_nome) == null) : echo "Sem UBS definida. Procure a UBS mais próxima";
				                        else : echo $ubs;
				                        endif ?>
				                     </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div id="teste"></div>