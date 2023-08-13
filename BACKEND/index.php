<?php 
require_once "controlador/controlador.plantilla.php";
require_once "controlador/controlador.usuario.php";
require_once "controlador/controlador.rol.php";
require_once "controlador/controlador.departamento.php";
require_once "controlador/controlador.horario.php";
require_once "controlador/controlador.adelanto.php";
require_once "controlador/controlador.empleado.php";
require_once "controlador/controlador.asistencia.php";

require_once "modelo/modelo.usuario.php";
require_once "modelo/modelo.rol.php";
require_once "modelo/modelo.departamento.php";
require_once "modelo/modelo.horario.php";
require_once "modelo/modelo.adelanto.php";
require_once "modelo/modelo.empleado.php";
require_once "modelo/modelo.asistencia.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

