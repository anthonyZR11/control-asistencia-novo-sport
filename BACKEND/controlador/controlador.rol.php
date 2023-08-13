<?php

class ControladorRoles{

	/*=============================================
	CREAR ROLES
	=============================================*/

	static public function ctrCrearRol(){

		if(isset($_POST["nuevoRol"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoRol"])){

				$tabla = "rol";

				$datos = array("nomRol" => strtoupper($_POST["nuevoRol"]),
					           "desRol" => strtoupper($_POST["nuevaDesRol"]));

				$respuesta = ModeloRoles::mdlIngresarRol($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rol";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El rol no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "rol";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarRoles($item, $valor){

		$tabla = "rol";

		$respuesta = ModeloRoles::mdlMostrarRoles($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarRol(){

		if(isset($_POST["editarRol"])){

			// var_dump($_POST["editarRol"]);

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRol"])){

				$tabla = "rol";

				$datos = array("nomRol"=>strtoupper($_POST["editarRol"]),
								"desRol"=>strtoupper($_POST["editarDesRol"]),
							   "idRol"=>$_POST["idRol"]);

				$respuesta = ModeloRoles::mdlEditarRol($tabla, $datos);



				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rol";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El rol no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "rol";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarRol(){

		if(isset($_GET["idRol"])){

			$respuesta = ModeloUsuarios::MdlMostrarUsuarios2("usuario", "idRol", $_GET["idRol"]);

				if (!$respuesta) {

				$tabla ="rol";
				$datos = $_GET["idRol"];

				$respuesta = ModeloRoles::mdlBorrarRol($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Rol ha sido borrada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "rol";

										}
									})

						</script>';
				}
			}else{
				echo'<script>

						swal({
							  type: "error",
							  title: "No se puede eliminar el Rol",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "rol";

										}
									})

						</script>';
			}
		}
		
	}
}
