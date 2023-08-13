<?php

session_start();
require_once 'controlador/controlador.usuario.php';

include 'modulos/timezone.php'
?>

<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php 

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

      echo '<link rel="stylesheet" href="vista/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="vista/dist/css/AdminLTE.css">';
    }else{
      echo '<link rel="stylesheet" href="vista/css/login.css">';
    }

  ?>

  <link rel="icon" href="vista/img/plantilla/icono-negro.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->
    <link rel="stylesheet" href="vista/css/monedas.css">
  <!-- Bootstrap 3.3.7 -->
 <!--  <link rel="stylesheet" href="vista/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->


  <!-- Font Awesome -->
  <link rel="stylesheet" href="vista/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vista/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="vista/dist/css/AdminLTE.css"> -->
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vista/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vista/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vista/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="vista/plugins/timepicker/bootstrap-timepicker.min.css">

<!-- Bootstrap DATE Picker -->
  <link rel="stylesheet" href="vista/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


  <link rel="stylesheet" href="vista/bower_components/select2/dist/css/select2.min.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vista/bower_components/jquery/dist/jquery.min.js"></script>


  <!-- ChartJS -->
<script src="vista/bower_components/chart.js/Chart.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vista/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vista/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vista/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vista/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vista/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vista/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vista/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- SweetAlert 2 -->
  <script src="vista/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->

  <!-- iCheck 1.0.1 -->
  <script src="vista/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vista/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vista/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vista/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vista/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vista/bower_components/moment/min/moment.min.js"></script>
  <script src="vista/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- bootstrap time picker -->
<script src="vista/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- bootstrap datepicker -->
<script src="vista/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vista/bower_components/raphael/raphael.min.js"></script>
  <script src="vista/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vista/bower_components/Chart.js/Chart.js"></script>

  <!-- Select2 -->
<script src="vista/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- InputMask -->
<script src="vista/plugins/input-mask/jquery.inputmask.js"></script>
<script src="vista/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="vista/plugins/input-mask/jquery.inputmask.extensions.js"></script>


<style type="text/css">
  #legend ul li {
    display: inline;
    padding-left: 30px;
    position: relative;
    margin-bottom: 4px;
    border-radius: 5px;
    padding: 2px 8px 2px 28px;
    font-size: 14px;
    cursor: default;
    -webkit-transition: background-color 200ms ease-in-out;
    -moz-transition: background-color 200ms ease-in-out;
    -o-transition: background-color 200ms ease-in-out;
    transition: background-color 200ms ease-in-out;
}
#legend li span {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 100%;
    border-radius: 5px;
}
</style>

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-mini">
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

   echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabecera.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "principal" ||
         $_GET["ruta"] == "usuario" ||
         $_GET["ruta"] == "rol" ||
         $_GET["ruta"] == "departamentos" ||
         $_GET["ruta"] == "horario" ||
         $_GET["ruta"] == "adelanto-dinero" ||
         $_GET["ruta"] == "empleados" ||
         $_GET["ruta"] == "asistencia-empleados" ||
         $_GET["ruta"] == "reporte-horarios" ||
         $_GET["ruta"] == "reporte-asistencias" ||
         $_GET["ruta"] == "ayuda" ||
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        include "modulos/404.php";

      }

    }else{

      include "modulos/principal.php";

    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

  }else{

    include "modulos/login.php";

  }

  ?>


<script src="vista/js/plantilla.js"></script>
<script src="vista/js/usuario.js"></script>
<script src="vista/js/rol.js"></script>
<script src="vista/js/departamento.js"></script>
<script src="vista/js/horario.js"></script>
<script src="vista/js/empleado.js"></script>
<script src="vista/js/adelanto.js"></script>
<script src="vista/js/asistencia.js"></script>
<script src="vista/js/reportes.js"></script>
<!-- 
<script src="vista/js/categorias.js"></script>
<script src="vista/js/productos.js"></script>
<script src="vista/js/clientes.js"></script>
<script src="vista/js/ventas.js"></script>
<script src="vista/js/reportes.js"></script> -->

</body>
</html>
