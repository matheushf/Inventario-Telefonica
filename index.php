<?php
session_start();

require_once("global.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Vivo Inventário</title>

        <link href="/vivo-inventario/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/vivo-inventario/assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="/vivo-inventario/assets/css/animate.css" rel="stylesheet">
        <link href="/vivo-inventario/assets/css/style.css" rel="stylesheet">

        <!-- Mainly scripts -->
        <script src="/vivo-inventario/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/vivo-inventario/assets/js/bootstrap/js/bootstrap.min.js"></script>
        <script src="/vivo-inventario/assets/js/jquery.maskedinput.min.js"></script>
        <script src="/vivo-inventario/assets/js/index.js"></script>



    </head>
    <body class="gray-bg">

        <div class="col-sm-4"></div>

        <div class="col-sm-4">
            <div class="animated fadeInDown">
                <center>
                    <h1>Vivo Inventário</h1>
                    <br>
                    <!--<img src="" style="width: 110px; height: 110px">-->

                    <br>
                </center>
            </div>
            <div class="col-lg-12">
                <div class="ibox-contnt">
                    <form class="m-t" role="form" action="acoes.php?acoes=acesso" method="post" id="login">
                        <div style="padding-bottom: 15px;">

                        </div>

                        <div class="form-group">

                        </div>
                        <div class="form-group">

                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b" >Acessar</button>

                    </form>

                </div>
            </div>

        </div>

    </body>
</html>