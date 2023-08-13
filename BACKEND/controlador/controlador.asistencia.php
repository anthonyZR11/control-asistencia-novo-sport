<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class ControladorAsistencias{

	/*=============================================
	CREAR ASISTENCIA
	=============================================*/

	static public function ctrCrearAsistencia(){

		if(isset($_POST["idEmpleado"])){
			
			$tabla = 'asistencia';
			$item1 = 'idEmpleado';
			$valor1 = $_POST['idEmpleado'];
			$item2 = 'fecAsistencia';
			$valor2 = $_POST['nuevaFecAsistencia'];

			$time_in = $_POST["nuevaIngAsistencia"];
			$time_in = date('H:i:s', strtotime($time_in));
			$time_out = $_POST["nuevaSalAsistencia"];
			$time_out = date('H:i:s', strtotime($time_out));

			$validar = ModeloAsistencias::mdlCompararAsistencia($tabla, $item1, $valor1, $item2, $valor2);

		if(is_array($validar) && $validar['idEmpleado'] == $_POST['idEmpleado'] && $validar['fecAsistencia'] == $_POST['nuevaFecAsistencia']){

					echo '<script>

					swal({

						type: "error",
						title: "¡El empleado ya ha sido registrado por hoy!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "asistencia-empleados";

						}

					});
				

					</script>';

				}else{

				$tabla2='horario';
					
				$comprobar = ModeloAsistencias::mdlComprobarHora($tabla2, $item1, $valor1);



				$logstatus = ($time_in > $comprobar['horaIngreso']) ? 0 : 1;

				$datos = array("idEmpleado" => $_POST["idEmpleado"],
					           "fecha" => $_POST["nuevaFecAsistencia"],
					           "horaIn" => $time_in,
					           "horaSal" => $time_out,
					           "estado"=> $logstatus);

				$respuesta = ModeloAsistencias::mdlCrearAsistencia($tabla, $datos);
			
				if($comprobar['horaIngreso'] > $time_in){
						$time_in = $comprobar['horaIngreso'];

					}

				if($comprobar['horaSalida'] < $time_out){
						$time_out = $comprobar['horaSalida'];
					}

				$time_in2 = new DateTime($time_in);
				$time_out2 = new DateTime($time_out);
				$interval = $time_in2->diff($time_out2);
				$hrs = $interval->format('%h');
				$mins = $interval->format('%i');
				$mins = $mins/60;
				$mins2 = $mins*60;
				//para que la hora salga exacta multiplicar los decimales x 60
				$int = $hrs.'.'.$mins2;
				if($int > 4){
					$int = $int;
					}

					 $respuesta2 = ModeloAsistencias::mdlMostrarUltimaAsistencia($tabla);
			
					$datos2 = array("idAsistencia" => $respuesta2["idAsistencia"] , 
									"horas" => $int);

					

				$HorasTrabajadas = ModeloAsistencias::mdlActualizarHora($tabla, $datos2);



					if($respuesta == "ok"){

						echo'<script>

					swal({
						  type: "success",
						  title: "El rol ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "asistencia-empleados";

									}
								})

					</script>';
			
					}

				}

			}

		}


	/*=============================================
	MOSTRAR ASISTENCIAS
	=============================================*/

	static public function ctrMostrarAsistencias($item, $valor){

		$tabla = "asistencia";

		$respuesta = ModeloAsistencias::mdlMostrarAsistencias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR ASISTENCIA
	=============================================*/

	static public function ctrEditarAsistencia(){

		if(isset($_POST["idAsistencia"])){

			$tabla = "asistencia";
			$item1 = 'idAsistencia';
			$valor1 = $_POST["idAsistencia"];

			$time_in = $_POST["editarIngAsistencia"];
			$time_in = date('H:i:s', strtotime($time_in));
			$time_out = $_POST["editarSalAsistencia"];
			$time_out = date('H:i:s', strtotime($time_out));

				

				$datos = array("fecha"=>$_POST["editarFecAsistencia"],
								"ingreso"=>$time_in,
							   "salida"=>$time_out,
							   "idAsistencia"=>$_POST["idAsistencia"]);

				$respuesta = ModeloAsistencias::mdlEditarAsistencia($tabla, $datos);

				var_dump($respuesta);

				$extraerUser = ModeloAsistencias::mdlMostrarAsistencias($tabla,$item1,$valor1);

				$item2 = 'idEmpleado';
				$valor2 = $extraerUser['idEmpleado'];

				$tabla2='horario';
					
				$comprobar = ModeloAsistencias::mdlComprobarHora($tabla2, $item2, $valor2);



				$logstatus = ($time_in > $comprobar['horaIngreso']) ? 0 : 1;

				if($comprobar['horaIngreso'] > $time_in){
						$time_in = $comprobar['horaIngreso'];

					}

				if($comprobar['horaSalida'] < $time_out){
						$time_out = $comprobar['horaSalida'];
					}

				$time_in2 = new DateTime($time_in);
				$time_out2 = new DateTime($time_out);
				$interval = $time_in2->diff($time_out2);
				$hrs = $interval->format('%h');
				$mins = $interval->format('%i');
				$mins = $mins/60;
				$mins2 = $mins*60;
				//para que la hora salga exacta multiplicar los decimales x 60
				$int = $hrs.'.'.$mins2;
				if($int > 4){
					$int = $int;
					}
			
					$datos2 = array("idAsistencia" => $valor1,
									"estado" => $logstatus, 
									"horas" => $int);
					
					

				$HorasTrabajadas = ModeloAsistencias::mdlActualizarHoraEstado($tabla, $datos2);

			

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La asitencia se modifico correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "asistencia-empleados";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarAsistencia(){

		if(isset($_GET["idAsistencia"])){

			$tabla ="asistencia";
			$datos = $_GET["idAsistencia"];

			$respuesta = ModeloAsistencias::mdlBorrarAsistencia($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Asistencia borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "asistencia-empleados";

									}
								})

					</script>';
			}
		}
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "asistencia";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloAsistencias::mdlRangoFechasAsistencias($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloAsistencias::mdlMostrarAsistencias($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #000;'>ID Empleado</td> 
					<td style='font-weight:bold; border:1px solid #000;'>NOMBRE</td>
					<td style='font-weight:bold; border:1px solid #000;'>APELLIDOS</td>
					<td style='font-weight:bold; border:1px solid #000;'>HORA INGRESO</td>
					<td style='font-weight:bold; border:1px solid #000;'>ESTADO INGRESO</td>
					<td style='font-weight:bold; border:1px solid #000;'>HORA SALIDA</td>
					
					
					</tr>");

			foreach ($ventas as $row => $value){
				
				$status1 = ($value['estadoAsistencia'])?'background-color:green; color:white;':'background-color:red; color:white;';
				$status = ($value['estadoAsistencia'])?'<span class="badge bg-green pull-right">a tiempo</span>':'<span class="badge bg-red pull-right">tarde</span>';
		 		echo utf8_decode("</td>
					<td style='border:1px solid #000;'>".$value['docIdentEmpleado']."</td>
					<td style='border:1px solid #000;'>".$value['nomEmpleado']."</td>	
					<td style='border:1px solid #000;'>".$value['apeEmpleado']."</td>
					<td style='border:1px solid #000;'>".date('h:i A', strtotime($value["ingAsistencia"]))."</td>
					<td style='border:1px solid #000;".$status1."'>".$status."</td>	
					<td style='border:1px solid #000;'>".date('h:i A', strtotime($value["salAsistencia"]))."</td>	
						
		 			</tr>");


			}


			echo "</table>";

		}

	}


}
