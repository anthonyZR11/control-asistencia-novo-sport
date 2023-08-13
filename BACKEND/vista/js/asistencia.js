/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarAsistencia", function(){


	var idAsistencia = $(this).attr("idAsistencia");

	console.log("idAsistencia",idAsistencia);

	var datos = new FormData();
	datos.append("idAsistencia", idAsistencia);

	$.ajax({
		url: "ajax/asistencia.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
		

		console.log(respuesta);
			$("#nomEmpleado").val(respuesta["nomEmpleado"]+' '+respuesta["apeEmpleado"]+' ' +' / DNI: ' +respuesta["docIdentEmpleado"]);
			$("#datepicker4").val(respuesta["fecAsistencia"]);
     		$("#editarIngAsistencia").val(respuesta["ingAsistencia"]);
     		$("#editarSalAsistencia").val(respuesta["salAsistencia"]);
     		$("#idAsistencia").val(respuesta["idAsistencia"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarAsistencia", function(){

	 var idAsistencia = $(this).attr("idAsistencia");

	 swal({
	 	title: '¿Está seguro de borrar?',
	 	text: "¡Eliminaras la asistencia permanentemente!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar asistencia !'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=asistencia-empleados&idAsistencia="+idAsistencia;

	 	}

	 })

})

