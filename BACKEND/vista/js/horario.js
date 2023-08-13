/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarHora", function(){


	var idHora = $(this).attr("idHora");

	console.log("idHora",idHora);

	var datos = new FormData();
	datos.append("idHora", idHora);

	$.ajax({
		url: "ajax/horario.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
console.log(respuesta);
     		$("#editarHoraIn").val(respuesta["horaIngreso"]);
     		$("#editarHoraSal").val(respuesta["horaSalida"]);
     		$("#idHorario").val(respuesta["idHorario"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarHora", function(){

	 var idHora = $(this).attr("idHora");

	 swal({
	 	title: '¿Está seguro de borrar?',
	 	text: "¡Elimnar este rol afecta a los usuarios, modifica antes!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Horario !'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=horario&idHora="+idHora;

	 	}

	 })

})

