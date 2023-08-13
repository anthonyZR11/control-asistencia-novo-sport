
<?php

require_once "../../controlador/controlador.asistencia.php";
require_once "../../modelo/modelo.asistencia.php";

require_once "../../controlador/controlador.usuario.php";
require_once "../../modelo/modelo.usuario.php";

$reporte = new ControladorAsistencias();
$reporte -> ctrDescargarReporte();