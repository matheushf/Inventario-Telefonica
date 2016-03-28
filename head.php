<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> <?php echo $Titulo ?> </title>

        <link href="/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="/assets/css/animate.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
        <link href="/assets/css/style-adicional.css" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/assets/js/bootstrap/js/bootstrap.min.js"></script>

        <!-- Mainly scripts -->
        <script src="/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="/assets/js/jquery.maskedinput.min.js"></script>
        <script src="/assets/js/global.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="/assets/js/inspinia.js"></script>
        <script src="/assets/js/plugins/pace/pace.min.js"></script>

        <!-- Date picker -->
        <script type="text/javascript" href="/assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" href="/assets/js/plugins/datepicker/bootstrap-datepicker.pt-BR.js"></script>
        <link href="/assets/css/plugins/datepicker/datepicker3.css" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <script src="/assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <?php
        if ($FormGrid == 'form') {
            ?>
            <!-- Estilos e javascript Form -->
            <link href="/assets/css/form.css" rel="stylesheet">
            <script src="/assets/js/form.js"></script>
            <?php
        } elseif ($FormGrid == 'grid') {
            ?>
            <!-- Estilos e javascript Grid -->
            <link href="/assets/css/grid.css" rel="stylesheet">
            <script src="/assets/js/grid.js" rel="stylesheet"></script>
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
                                <p style="margin-top: 10px">
                                    <span class="clear"> <span class="" style="color: white">
                                            <img src="http://placehold.it/150x50">


                                        </span>
                                </p>
                            </div>
                            <div class="logo-element">VI</div>
                        </li>
                        <li>
                            <a href="/modulos/materiais"><i class="fa fa-bars"></i> <span class="nav-label">Materiais </span></a>
                        </li>

                        <li>
                            <a href="/modulos/depositos"><i class="fa fa-archive"></i> <span class="nav-label">Depósitos </span></a>
                        </li>

                        <li>
                            <a href="/modulos/etiquetas"><i class="fa fa-barcode"></i> <span class="nav-label">Etiquetas </span></a>
                        </li>

                        <li>
                            <a href="/modulos/inventario"><i class="fa fa-book"></i> <span class="nav-label">Inventário </span></a>
                        </li>

                        <?php if ($_SESSION['usua_tipo'] == 'Admin') { ?>
                            <li>
                                <a href="/modulos/usuarios"><i class="fa fa-user"></i> <span class="nav-label">Usuário </span></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>
        </div>
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
                           href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    
                    <ul class="nav navbar-top-links navbar-right">
                        
                        <li><span class="m-r-sm text-muted welcome-message">Bem Vindo, <?php echo $_SESSION['usua_nome']; ?></span>
                        </li>

                        <li><a href="/logout.php"> <i class="fa fa-sign-out"></i> Sair
                            </a></li>

                    </ul>
                </nav>
                <center>
                    <h1>Vivo Inventário</h1>
                </center>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div id="teste"></div>
                <div id="mensagens"></div>

                <?php
                if (isset($_SESSION['Mensagem']['tipo']) && $_SESSION['Mensagem']['tipo'] == 'error') {
                    mensagem();
                }