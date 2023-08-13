<?php

class ControladorAdelantos{

	/*=============================================
	CREAR ROLES
	=============================================*/

	static public function ctrCrearAdelanto(){

		if(isset($_POST["nuevoEmpAdelanto"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoEmpAdelanto"]) &&
				preg_match('/^[0-9\. ]+$/', $_POST["nuevaCantAdelanto"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ: ]+$/', $_POST["nuevaDescAdelanto"])){

				$tabla = "adelanto";

				$datos = array("idEmpleado" => $_POST["nuevoEmpAdelanto"],
								"cantidad" => $_POST["nuevaCantAdelanto"],
					           "descripcion" => $_POST["nuevaDescAdelanto"]);

				$respuesta = ModeloAdelantos::mdlIngresarAdelanto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El adelanto ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "adelanto-dinero";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El adelanto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "adelanto-dinero";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarAdelantos($item, $valor){

		$tabla = "adelanto";

		$respuesta = ModeloAdelantos::mdlMostrarAdelantos($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarAdelantos2($item, $valor){

		$tabla = "adelanto";

		$respuesta = ModeloAdelantos::mdlMostrarAdelantos2($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarAdelanto(){

		if(isset($_POST["idAdelanto"])){

			if(preg_match('/^[0-9]+$/', $_POST["idAdelanto"]) &&
				preg_match('/^[0-9\. ]+$/', $_POST["editarCantAdelanto"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ: ]+$/', $_POST["editarDescAdelanto"])){

				$tabla = "adelanto";

				$datos = array("idAdelanto" => $_POST["idAdelanto"],
								"cantidad" => $_POST["editarCantAdelanto"],
					           "descripcion" => $_POST["editarDescAdelanto"]);

				$respuesta = ModeloAdelantos::mdlEditarAdelanto($tabla, $datos);

				var_dump($respuesta);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El adelanto ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "adelanto-dinero";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El adelanto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "adelanto-dinero";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarAdelanto(){

		if(isset($_GET["idAdelanto"])){

			$tabla ="adelanto";
			$datos = $_GET["idAdelanto"];

			$respuesta = ModeloAdelantos::mdlBorrarAdelanto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El adelanto ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "adelanto-dinero";

									}
								})

					</script>';
			}
		}
		
	}
}
