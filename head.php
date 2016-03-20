<?php
//include( $_SERVER['DOCUMENT_ROOT'] . "/global.php");
//require_once 'global.php';
//if(!$util->estaLogado()) {
//	header('Location: /index.php');
//}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> <?php echo $Titulo ?> </title>

        <link href="/vivo-inventario/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vivo-inventario/assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="/vivo-inventario/assets/css/animate.css" rel="stylesheet">
        <link href="/vivo-inventario/assets/css/style.css" rel="stylesheet">
        <link href="/vivo-inventario/assets/css/style-adicional.css" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="/vivo-inventario/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/vivo-inventario/assets/js/bootstrap/js/bootstrap.min.js"></script>

        <!-- Mainly scripts -->
        <script src="/vivo-inventario/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="/vivo-inventario/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="/vivo-inventario/assets/js/jquery.maskedinput.min.js"></script>
        <script src="/vivo-inventario/assets/js/global.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="/vivo-inventario/assets/js/inspinia.js"></script>
        <script src="/vivo-inventario/assets/js/plugins/pace/pace.min.js"></script>

        <!-- Date picker -->
        <script type="text/javascript" href="/vivo-inventario/assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" href="/vivo-inventario/assets/js/plugins/datepicker/bootstrap-datepicker.pt-BR.js"></script>
        <link href="/vivo-inventario/assets/css/plugins/datepicker/datepicker3.css" rel="stylesheet">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <script src="/vivo-inventario/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <?php
        if ($FormGrid == 'form') {
            ?>
            <!-- Estilos e javascript Form -->
            <link href="/vivo-inventario/assets/css/form.css" rel="stylesheet">
            <script src="/vivo-inventario/assets/js/form.js"></script>
            <?php
        } elseif ($FormGrid == 'grid') {
            ?>
            <!-- Estilos e javascript Grid -->
            <link href="/vivo-inventario/assets/css/grid.css" rel="stylesheet">
            <script src="/vivo-inventario/assets/js/grid.js" rel="stylesheet"></script>
            <?php
        }
        ?>

    </head>

    <body>
        <div id="wraper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span> <img alt="image" class="img-circle" src="https://placehold.it/80x80" style="width: 48px;">
                                </span>
                                <p style="margin-top: 10px">
                                    <span class="clear"> <span class="" style="color: white">


                                        </span>
                                </p>
                            </div>
                            <div class="logo-element">VI</div>
                        </li>
                        <li>
                            <a href="/vivo-inventario/modulos/materiais"><i class="fa fa-bars"></i> <span class="nav-label">Materiais </span></a>
                        </li>

                        <li>
                            <a href="/vivo-inventario/modulos/depositos"><i class="fa fa-archive"></i> <span class="nav-label">Depósitos </span></a>
                        </li>

                        <li>
                            <a href="/vivo-inventario/modulos/etiquetas"><i class="fa fa-barcode"></i> <span class="nav-label">Etiquetas </span></a>
                        </li>

                        <li>
                            <a href="/vivo-inventario/modulos/inventario"><i class="fa fa-book"></i> <span class="nav-label">Inventário </span></a>
                        </li>

                        <?php if ($_SESSION['usua_tipo'] == 'Admin') { ?>
                            <li>
                                <a href="/vivo-inventario/modulos/usuarios"><i class="fa fa-user"></i> <span class="nav-label">Usuário </span></a>
                            </li>
                        <?php } ?>

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
                        <li><span class="m-r-sm text-muted welcome-message">Bem Vindo, <?php echo $_SESSION['usua_nome']; ?></span>
                        </li>

                        <li><a href="/vivo-inventario/logout.php"> <i class="fa fa-sign-out"></i> Sair
                            </a></li>

                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="text-center loginscreen animated fadeInDown">
                    <div class="row">
                        <div class="container-fluid">
                            <h1>Vivo Inventário</h1>
                            <br>
                            <img src="http://placehold.it/250x100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div id="teste"></div>
                <div id="mensagens"></div>

                <?php
                if (isset($_SESSION['Mensagem']['tipo']) && $_SESSION['Mensagem']['tipo'] == 'error') {
                    mensagem();
                }