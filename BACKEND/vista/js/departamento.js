/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarDep", function(){


	var idDep = $(this).attr("idDep");

	console.log("idDep",idDep);

	var datos = new FormData();
	datos.append("idDep", idDep);

	$.ajax({
		url: "ajax/departamento.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
		console.log(respuesta);
     		$("#editarDep").val(respuesta["nomDepartamento"]);
     		$("#idDep").val(respuesta["idDepartamento"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarDep", function(){

	 var idDep = $(this).attr("idDep");

	 swal({
	 	title: '¿Está seguro de borrar?',
	 	text: "¡Elimnar este rol afecta a los usuarios, modifica antes!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar rol !'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=departamentos&idDep="+idDep;

	 	}

	 })

})

