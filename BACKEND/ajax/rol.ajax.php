<?php

require_once "../controlador/controlador.rol.php";
require_once "../modelo/modelo.rol.php";

class AjaxRoles{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idRol;

	public function ajaxEditarRol(){

		$item = "idRol";
		$valor = $this->idRol;

		$respuesta = ControladorRoles::ctrMostrarRoles($item, $valor);


		echo json_encode($respuesta);
		

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idRol"])){

	$rol = new AjaxRoles();
	$rol -> idRol = $_POST["idRol"];
	$rol -> ajaxEditarRol();
}
