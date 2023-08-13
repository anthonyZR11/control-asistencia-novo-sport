<?php

require_once "../controlador/controlador.empleado.php";
require_once "../modelo/modelo.empleado.php";

class AjaxEmpleados{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idEmpleado;

	public function ajaxEditarEmpleado(){

		$item = "idEmpleado";
		$valor = $this->idEmpleado;

	

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);



		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarDocEmpleado;

	public function ajaxValidarDocEmpleado(){

		$item = "DocIdentEmpleado";
		$valor = $this->validarDocEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR email
	=============================================*/	

	public $validarEmail;

	public function ajaxValidarEmail(){

		$item = "emailEmpleado";
		$valor = $this->validarEmail;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
DATOS DE EDITAR USUARIO
=============================================*/


if(isset($_POST["idEmpleado"])){

	

	$editar = new AjaxEmpleados();
	$editar -> idEmpleado = $_POST["idEmpleado"];
	$editar -> ajaxEditarEmpleado();

}

/*=============================================
DATOS DE VALIDAR NO REPETIR EMPLEADO
=============================================*/

if(isset( $_POST["validarDocEmpleado"])){

	$valUsuario = new AjaxEmpleados();
	$valUsuario -> validarDocEmpleado = $_POST["validarDocEmpleado"];
	$valUsuario -> ajaxValidarDocEmpleado();

}

/*=============================================
DATOS DE VALIDAR NO REPETIR EMAIL
=============================================*/

if(isset( $_POST["validarEmail"])){

	$valUsuario = new AjaxEmpleados();
	$valUsuario -> validarEmail = $_POST["validarEmail"];
	$valUsuario -> ajaxvalidarEmail();

}