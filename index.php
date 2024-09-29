<?php
ob_start();
session_start();
require 'conexion.php';
require 'phpqrcode/qrlib.php';

if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header('Location: login.php'); // Cambia 'login.html' por el nombre de tu página de inicio de sesión
    exit(); // Asegúrate de salir del script después de redirigir
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


    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>


<style>
    #canvas {
        width: 300px;
        /* Ajusta el ancho según lo que necesites */
        /* Ajusta la altura según lo que necesites */
        height: 300px;
        margin: auto;
        border: 2px solid #007bff;
        /* Borde para destacar el área */
        border-radius: 8px;
    }

    .main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    html,
    body {
        height: 100%;
        /* Asegura que el html y el body ocupen toda la altura */
        margin: 0;
        /* Elimina el margen por defecto */
    }

    body {
        display: flex;
        flex-direction: column;
        /* Coloca los elementos en columna */
    }


    main {
        flex: 1;
        /* Permite que el main ocupe todo el espacio disponible */
    }


    .bg-header {
        background-color: #007bff;
        /* Color azul para el header */
    }

    .bg-footer {
        background-color: #0056b3;
        /* Color azul para el footer */
        color: white;
        /* Color del texto en el footer */
    }

    footer {
        position: relative;
        bottom: 0;
        width: 100%;
        padding: 1rem;

    }
</style>

<main>

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
            <h2 class="mt-4">Registro de asistencia</h2>
            <div class="card mt-4">
                <div class="card-body">


                    <div id="camara">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div id="cuadro">
                                <canvas id="canvas" class="border border-primary"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
            <div class="container text-center">
            <button type="button" id="btnIngreso" onclick="iniciaCamara()" class="btn btn-success">Iniciar camara</button>

            <button type="button" id="btnIngreso" onclick="apagaCamara()" class="btn btn-warning">Apagar camara</button>
            </div>
        </div>
        </div>



      


</main>
<footer class="bg-footer py-4 mt-auto">
    <div class="container text-center"> <!-- Añadido text-center para centrar el contenido -->
        <h5>Contáctanos</h5>
        <ul class="list-unstyled">
            <li class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                </svg> Avda. España 676 casi Boquerón
            </li>
            <li class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                </svg> Tel: (595-21) 229-450
            </li>
            <li class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                </svg> Tel: +595 983-225-523
            </li>
            <li class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                </svg> E-mail: info@uninorte.edu.py
            </li>
        </ul>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

<script src=""></script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootbox.min.js"></script>
<script type="text/javascript" src="scripts/asistencia.js" ?<?php echo time(); ?>></script>

</body>


</html>

<?php
ob_end_flush();
?>