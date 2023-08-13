/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarRol", function(){


	var idRol = $(this).attr("idRol");

	console.log("idRol",idRol);

	var datos = new FormData();
	datos.append("idRol", idRol);

	$.ajax({
		url: "ajax/rol.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
console.log(respuesta);
     		$("#editarRol").val(respuesta["nomRol"]);
     		$("#editarDesRol").val(respuesta["desRol"]);
     		$("#idRol").val(respuesta["idRol"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarRol", function(){

	 var idRol = $(this).attr("idRol");

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

	 		window.location = "index.php?ruta=rol&idRol="+idRol;

	 	}

	 })

})

