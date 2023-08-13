<?php

require_once "../controlador/controlador.asistencia.php";
require_once "../modelo/modelo.asistencia.php";

class AjaxAsistencias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idAsistencia;

	public function ajaxEditarAsistencia(){

		$item = "idAsistencia";
		$valor = $this->idAsistencia;

		$respuesta = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);


		echo json_encode($respuesta);
		

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idAsistencia"])){

	$rol = new ajaxAsistencias();
	$rol -> idAsistencia = $_POST["idAsistencia"];
	$rol -> ajaxEditarAsistencia();
}
