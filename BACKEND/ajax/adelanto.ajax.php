<?php

require_once "../controlador/controlador.adelanto.php";
require_once "../modelo/modelo.adelanto.php";

class AjaxAdelantos{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

		public $idAdelanto;

		public function ajaxEditarAdelanto(){

			$item = "idAdelanto";
			$valor = $this->idAdelanto;

			$respuesta = ControladorAdelantos::ctrMostrarAdelantos($item, $valor);


			echo json_encode($respuesta);

		}

	}



	/*=============================================
	DATOS DE EDITAR USUARIO
	=============================================*/
	if(isset($_POST["idAdelanto"])){

		$editar = new AjaxAdelantos();
		$editar -> idAdelanto = $_POST["idAdelanto"];
		$editar -> ajaxEditarAdelanto();

	}

