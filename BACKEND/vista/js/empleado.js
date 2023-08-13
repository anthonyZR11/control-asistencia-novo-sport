/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarEditar").attr("src", rutaImagen);

  		})

  	}
})


/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function(){

	var idEmpleado = $(this).attr("idEmpleado");
	console.log("idEmpleado", idEmpleado);
	
	var datos = new FormData();
	datos.append("idEmpleado", idEmpleado);

	$.ajax({

		url:"ajax/empleado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log("respuesta", respuesta);

			$("#idEmpleado").val(respuesta["idEmpleado"]);
			$("#editarDocIdentEmpleado").val(respuesta["docIdentEmpleado"]);
			$("#editarNomEmpleado").val(respuesta["nomEmpleado"]);
			$("#editarApeEmpleado").val(respuesta["apeEmpleado"]);
			if (respuesta["genEmpleado"] == 1) {
				$("#editarGenEmpleado").html("MASCULINO");
				$("#editarGenEmpleado").val(respuesta["genEmpleado"]);
			}else{
				$("#editarGenEmpleado").html("FEMENINO");
				$("#editarGenEmpleado").val(respuesta["genEmpleado"]);
			}
			$("#datepicker3").val(respuesta["fechaNacEmpleado"]);
			$("#editarEmailEmpleado").val(respuesta["emailEmpleado"]);
			$("#editarCelEmpleado").val(respuesta["celEmpleado"]);
			$("#editarDirEmpleado").val(respuesta["dirEmpleado"]);
			$("#editarIdDepartamento").html(respuesta["nomDepartamento"]);
			$("#editarIdDepartamento").val(respuesta["idDepartamento"]);
			$("#editarIdHorario").html(respuesta["horaIngreso"]+' - '+respuesta["horaSalida"]);
			$("#editarIdHorario").val(respuesta["idHorario"]);
			$("#fotoActual").val(respuesta["fotoEmpleado"]);

			if(respuesta["fotoEmpleado"] != ""){

				$(".previsualizarEditar").attr("src", respuesta["fotoEmpleado"]);

			}else{

				$(".previsualizarEditar").attr("src", "vista/img/usuarios/default/anonymous.png");

			}

		}

	});

})

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoDocIdentEmpleado").change(function(){

	$(".alert").remove();

	var docEmpleado = $(this).val();

	var datos = new FormData();
	datos.append("validarDocEmpleado", docEmpleado);

	 $.ajax({
	    url:"ajax/empleado.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoDocIdentEmpleado").parent().after('<div class="alert alert-warning">El dni ya existe en la base de datos</div>');

	    		$("#nuevoDocIdentEmpleado").val("");

	    	}

	    }

	})
})

/*=============================================
REVISAR SI EL EMAIL YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoEmailEmpleado").change(function(){

	$(".alert").remove();

	var email = $(this).val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	 $.ajax({
	    url:"ajax/empleado.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoEmailEmpleado").parent().after('<div class="alert alert-warning">El email ya existe en la base de datos</div>');

	    		$("#nuevoEmailEmpleado").val("");

	    	}

	    }

	})
})


/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarEmpleado", function(){

  var idEmpleado = $(this).attr("idEmpleado");
  var fotoEmpleado = $(this).attr("fotoEmpleado");
  var docEmpleado = $(this).attr("docEmpleado");

  swal({
    title: '¿Está seguro de borrar el empleado?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar empleado!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=empleados&idEmpleado="+idEmpleado+"&docEmpleado="+docEmpleado+"&fotoEmpleado="+fotoEmpleado;

    }

  })

})