$('.sidebar-menu').tree()
/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});



if(window.matchMedia("(max-width:767px)").matches){
	
	$("body").removeClass('sidebar-collapse');

}


if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora1").addClass('col-sm-6');

}else{
	$("#tamHora1").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora2").addClass('col-sm-6');

}else{
	$("#tamHora2").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora3").addClass('col-sm-6');

}else{
	$("#tamHora3").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora4").addClass('col-sm-6');

}else{
	$("#tamHora4").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora5").addClass('col-sm-6');

}else{
	$("#tamHora5").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora6").addClass('col-sm-6');

}else{
	$("#tamHora6").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora7").addClass('col-sm-6');

}else{
	$("#tamHora7").removeClass('col-sm-6');
}

if(window.matchMedia("(min-width:767px)").matches){
	
	$("#tamHora8").addClass('col-sm-6');

}else{
	$("#tamHora8").removeClass('col-sm-6');
}


$(function () {

		$('[data-mask]').inputmask()

		$('.select2').select2()
		
    //Timepicker
    $('.timepicker1').timepicker({
      showInputs: false
    })
    $('.timepicker2').timepicker({
      showInputs: false
    })
    $('.timepicker3').timepicker({
      showInputs: false
    })
    $('.timepicker4').timepicker({
      showInputs: false
    })
    $('.timepicker5').timepicker({
      showInputs: false
    })
    $('.timepicker6').timepicker({
      showInputs: false
    })
    $('.timepicker7').timepicker({
      showInputs: false
    })
    $('.timepicker8').timepicker({
      showInputs: false
    })

     //Date picker
     $('#datepicker').datepicker({
     	format: 'yyyy-mm-dd',
      autoclose: true
    })

     $('#datepicker2').datepicker({
     	format: 'yyyy-mm-dd',
      autoclose: true
    })

     $('#datepicker3').datepicker({
     	format: 'yyyy-mm-dd',
      autoclose: true
    })

     $('#datepicker4').datepicker({
     	format: 'yyyy-mm-dd',
      autoclose: true
    })
  })



   