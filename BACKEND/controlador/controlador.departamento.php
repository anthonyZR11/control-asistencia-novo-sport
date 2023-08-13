<?php

class ControladorDeps{

	/*=============================================
	CREAR ROLES
	=============================================*/

	static public function ctrCrearDep(){

		if(isset($_POST["nuevoDep"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDep"])){

				$tabla = "departamento";

				$datos = $_POST["nuevoDep"];

				$respuesta = ModeloDeps::mdlIngresarDep($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "departamentos";

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

							window.location = "departamentos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarDeps($item, $valor){

		$tabla = "departamento";

		$respuesta = ModeloDeps::mdlMostrarDeps($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarDep(){

		if(isset($_POST["editarDep"])){

			// var_dump($_POST["editarRol"]);

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDep"])){

				$tabla = "departamento";

				$datos = array("nomDep"=>$_POST["editarDep"],
							   "idDep"=>$_POST["idDep"]);

				$respuesta = ModeloDeps::mdlEditarDep($tabla, $datos);



				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "departamentos";

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

							window.location = "departamentos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarDep(){

		if(isset($_GET["idDep"])){

			$respuesta = ModeloEmpleados::mdlMostrarEmpleados2("empleado", "idDepartamento", $_GET["idDep"]);

				if (!$respuesta) {

				$tabla ="departamento";
				$datos = $_GET["idDep"];

				$respuesta = ModeloDeps::mdlBorrarDep($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Rol ha sido borrada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "departamentos";

										}
									})

						</script>';
				}

			}else{
				echo'<script>

						swal({
							  type: "error",
							  title: "No se puede eliminar el departamento",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "departamentos";

										}
									})

						</script>';
			}

		}
		
	}
}
