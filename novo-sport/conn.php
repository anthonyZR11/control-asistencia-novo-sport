<?php
	$conn = new mysqli('localhost', 'root', '', 'control-asistencia-novo');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>