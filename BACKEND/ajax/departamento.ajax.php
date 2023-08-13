<?php

require_once "../controlador/controlador.departamento.php";
require_once "../modelo/modelo.departamento.php";

class AjaxDeps{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idDep;

	public function ajaxEditarDep(){

		$item = "idDepartamento";
		$valor = $this->idDep;

		$respuesta = ControladorDeps::ctrMostrarDeps($item, $valor);


		echo json_encode($respuesta);
		

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idDep"])){

	$rol = new AjaxDeps();
	$rol -> idDep = $_POST["idDep"];
	$rol -> ajaxEditarDep();
}
