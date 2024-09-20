<?php
ob_start();
session_start();
require 'conexion.php';
require 'phpqrcode/qrlib.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Asistencia</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit-no" name="viewport">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="css/font-awesome.css">

    <link rel="stylesheet" href="css/AdminLTE.min.css">

    <link rel="stylesheet" href="css/blue.css">


    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
</head>


<style>
    #preview {
        width: 80%;
        margin: auto;
        border: 1px solid #ccc;
    }

    .main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>


<body>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                </div>

            </div>

        </nav>
    </header>


    <div class="container text-center">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <h4>Registro de asistencia</h4>
            </div>
            <div id="camara">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div id="cuadro">
                        <video class="border border-primary" id="preview"></video>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs12">
                <button type="button" id="btnIngreso" onclick="iniciaCamara()" class="btn btn-success">Iniciar camara</button>

                <button type="button" id="btnIngreso" onclick="apagaCamara()" class="btn btn-warning">Apagar camara</button>
            </div>

        </div>
    </div>
    <footer>

    </footer>

    <script src=""></script>

</body>

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="scripts/asistencia.js"?<?php echo time(); ?>></script>
</html>

<?php
ob_end_flush();
?>