
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class ControladorEmpleados
{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearEmpleado()
	{

		if (isset($_POST["nuevoDocIdentEmpleado"])) {



			if (
				preg_match('/^[0-9]+$/', $_POST["nuevoDocIdentEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNomEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApeEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \,°#._-]+$/', $_POST["nuevaDirEmpleado"]) &&
				preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $_POST["nuevoEmailEmpleado"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				// AQUI SE VALIDA $_FILES["nuevaFotoUsuario"]["tmp_name"] SI ES VACION LA IMAGEN SE SALTA TODO LA VALIDADCION

				if ($_FILES["nuevaFotoEmpleado"]["tmp_name"] == "") {
				} else {

					if (isset($_FILES["nuevaFotoEmpleado"]["tmp_name"])) {

						list($ancho, $alto) = getimagesize($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

						$directorio = "vista/img/empleados/" . $_POST["nuevoDocIdentEmpleado"];

						mkdir($directorio, 0755);

						/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

						if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/jpeg") {

							/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

							$aleatorio = mt_rand(100, 999);

							$ruta = "vista/img/empleados/" . $_POST["nuevoDocIdentEmpleado"] . "/" . $aleatorio . ".jpg";

							$origen = imagecreatefromjpeg($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);
						}

						if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/png") {

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100, 999);

							$ruta = "vista/img/empleados/" . $_POST["nuevoDocIdentEmpleado"] . "/" . $aleatorio . ".png";

							$origen = imagecreatefrompng($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);
						}
					}
				}

				$tabla = "empleado";

				$datos = array(
					"dni" => $_POST["nuevoDocIdentEmpleado"],
					"nombre" => $_POST["nuevoNomEmpleado"],
					"apellido" => $_POST["nuevoApeEmpleado"],
					"sexo" => $_POST["nuevoGenEmpleado"],
					"cumple" => $_POST["nuevaFecNacEmpleado"],
					"email" => $_POST["nuevoEmailEmpleado"],
					"cel" => $_POST["nuevoCelEmpleado"],
					"dir" => $_POST["nuevaDirEmpleado"],
					"idDep" => $_POST["nuevoIdDepartamento"],
					"idHora" => $_POST["nuevoIdHorario"],
					"fotoEmpleado" => $ruta
				);

				$respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "empleados";

						}

					});
				

					</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "empleados";

						}

					});
				

				</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarEmpleados($item, $valor)
	{

		$tabla = "empleado";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);

		return $respuesta;
	}



	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarEmpleado()
	{



		if (isset($_POST["editarDocIdentEmpleado"])) {

			if (
				preg_match('/^[0-9]+$/', $_POST["editarDocIdentEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNomEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApeEmpleado"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \,°#._-]+$/', $_POST["editarDirEmpleado"]) &&
				preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $_POST["editarEmailEmpleado"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];



				if (isset($_FILES["editarFotoEmpleado"]["tmp_name"]) && !empty($_FILES["editarFotoEmpleado"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFotoEmpleado"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vista/img/empleados/" . $_POST["editarDocIdentEmpleado"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFotoEmpleado"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vista/img/empleados/" . $_POST["editarDocIdentEmpleado"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFotoEmpleado"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vista/img/empleados/" . $_POST["editarDocIdentEmpleado"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "empleado";

				$datos = array(
					"id" => $_POST["idEmpleado"],
					"dni" => $_POST["editarDocIdentEmpleado"],
					"nombre" => $_POST["editarNomEmpleado"],
					"apellido" => $_POST["editarApeEmpleado"],
					"sexo" => $_POST["editarGenEmpleado"],
					"cumple" => $_POST["editarFecNacEmpleado"],
					"email" => $_POST["editarEmailEmpleado"],
					"cel" => $_POST["editarCelEmpleado"],
					"dir" => $_POST["editarDirEmpleado"],
					"idDep" => $_POST["editarIdDepartamento"],
					"idHora" => $_POST["editarIdHorario"],
					"fotoEmpleado" => $ruta
				);


				$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);


				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarEmpleado()
	{

		if (isset($_GET["idEmpleado"])) {

			$respuesta = ModeloAsistencias::mdlMostrarAsistencias2("asistencia", "idEmpleado", $_GET["idEmpleado"]);
			$respuesta1 = ModeloAdelantos::mdlMostrarAdelantos3("adelanto", "idEmpleado", $_GET["idEmpleado"]);


			if (!$respuesta && !$respuesta1) {

				$tabla = "empleado";
				$datos = array(
					'idEmpleado' => $_GET["idEmpleado"],
					'docEmpleado' => $_GET["docEmpleado"]
				);

				if ($_GET["fotoEmpleado"] != "") {

					unlink($_GET["fotoEmpleado"]);
					rmdir('vista/img/empleados/' . $_GET["docEmpleado"]);
				}

				$respuesta = ModeloEmpleados::mdlBorrarEmpleado($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El empleado ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then(function(result) {
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';
				}
			} else {
				echo '<script>

						swal({
							  type: "error",
							  title: "No se puede eliminar el empleado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "empleados";

										}
									})

						</script>';
			}
		}
	}
}
