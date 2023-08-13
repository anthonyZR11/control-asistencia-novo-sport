<?php

require_once "../controlador/controlador.horario.php";
require_once "../modelo/modelo.horario.php";

class AjaxHorarios{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idHora;

	public function ajaxEditarHora(){

		$item = "idHorario";
		$valor = $this->idHora;

		$respuesta = ControladorHorarios::ctrMostrarHorarios($item, $valor);


		echo json_encode($respuesta);
		

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idHora"])){

	$rol = new AjaxHorarios();
	$rol -> idHora = $_POST["idHora"];
	$rol -> ajaxEditarHora();
}
