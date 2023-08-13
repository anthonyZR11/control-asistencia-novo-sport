/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarAdelanto", function(){

	var idAdelanto = $(this).attr("idAdelanto");
	
	console.log("idAdelanto", idAdelanto);
	
	var datos = new FormData();

	datos.append("idAdelanto", idAdelanto);

	$.ajax({

		url:"ajax/adelanto.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log("respuesta", respuesta);
			

			$("#editarAdelanto").val(respuesta["nomEmpleado"]+' '+respuesta["apeEmpleado"]+' - '+respuesta["docIdentEmpleado"]);
			$("#idAdelanto").val(respuesta["idAdelanto"]);
			$("#editarCantAdelanto").val(respuesta["cantAdelanto"]);
			$("#editarDescAdelanto").val(respuesta["descAdelanto"]);

		}

	});

})


/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarAdelanto", function(){

  var idAdelanto = $(this).attr("idAdelanto");
  var idEmpleado = $(this).attr("idEmpleado");

  swal({
    title: '¿Está seguro de borrar el adelanto?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar adelanto!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=adelanto-dinero&idAdelanto="+idAdelanto+"&idEmpleado="+idEmpleado;

    }

  })

})













