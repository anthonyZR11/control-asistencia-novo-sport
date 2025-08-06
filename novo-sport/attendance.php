<?php
	if(isset($_POST['empleado'])){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$dniEmpleado = $_POST['empleado'];
		$status = $_POST['status'];

		$sql = "SELECT * FROM empleado WHERE docIdentEmpleado  =  '$dniEmpleado'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['idEmpleado'];

			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM asistencia WHERE idEmpleado = '$id' AND fecAsistencia = '$date_now' AND ingAsistencia IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'Has registrado tu entrada por hoy';
				}
				else{
					//updates
					$sched = $row['idHorario'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM horario WHERE idHorario = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['horaIngreso']) ? 0 : 1;
					//
					$sql = "INSERT INTO asistencia (idEmpleado, fecAsistencia, ingAsistencia, estadoAsistencia) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Llegada: '.$row['nomEmpleado'].' '.$row['apeEmpleado'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, asistencia.idAsistencia AS uid FROM asistencia LEFT JOIN empleado ON empleado.idEmpleado=asistencia.idEmpleado WHERE asistencia.idEmpleado = '$id' AND fecAsistencia = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}
				else{
					$row = $query->fetch_assoc();

// echo "valor: " . $row['salAsistencia'];
					if($row['salAsistencia'] != '00:00:00' && !empty($row['salAsistencia'])){
						$output['error'] = true;
						$output['message'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}
					else{
						
						$sql = "UPDATE asistencia SET salAsistencia = NOW() WHERE idAsistencia = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Salida: '.$row['nomEmpleado'].' '.$row['apeEmpleado'];



							$sql = "SELECT * FROM asistencia WHERE idAsistencia = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['ingAsistencia'];
							$time_out = $urow['salAsistencia'];

							$sql = "SELECT * FROM empleado LEFT JOIN horario ON horario.idHorario=empleado.idHorario WHERE empleado.idEmpleado = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['horaIngreso'] > $time_in){
								$time_in = $srow['horaIngreso'];
							}

							if($srow['horaSalida'] < $time_out){
								$time_out = $srow['horaSalida'];
							}

							$time_in2 = new DateTime($time_in);
							$time_out2 = new DateTime($time_out);
							$interval = $time_in2->diff($time_out2);
						
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$mins2 = $mins*60;
							$int = $hrs.'.'.$mins2;
							if($int > 4){
								$int = $int;
							}

							$sql = "UPDATE asistencia SET cantHoraAsistencia = '$int' WHERE idAsistencia = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'ID de empleado no encontrado';
		}
		
	}
	
	echo json_encode($output);

?>
