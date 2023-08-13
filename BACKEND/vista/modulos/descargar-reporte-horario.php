
<?php
	//include 'includes/session.php';
require_once '../../modelo/conexion.php';
require_once "../../controlador/controlador.horario.php";
require_once "../../modelo/modelo.horario.php";

	function imprimirAsistencia(){
		$contents = '';

		$tabla = "horario";
		$item = null;
		$valor = null;
		
		$horario = ControladorHorarios::ctrMostrarHorarioEmpleados($tabla, $item, $valor);

		foreach ($horario as $key => $value) {
		
			$contents .= "
			<tr>
				<td>".$value['docIdentEmpleado']."</td>
				<td>".$value['nomEmpleado']."</td>
				<td>".$value['apeEmpleado']."</td>
				<td>".$value['nomDepartamento']."</td>
				<td>".date('h:i A', strtotime($value['horaIngreso'])).' - '. date('h:i A', strtotime($value['horaSalida']))."</td>
			</tr>
			<br>
			";
		}

		return $contents;
	}

	require_once('../../extension/tcpdf/tcpdf.php'); 
	require_once('../../extension/tcpdf/tcpdf_autoconfig.php');   
	// create new PDF document
$pdf1 = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
$pdf1->SetCreator(PDF_CREATOR);
$pdf1->SetAuthor('Nicola Asuni');
$pdf1->SetTitle('NOVO SPORT TIENDA DEPORTIVA');
$pdf1->SetSubject('TCPDF Tutorial');
$pdf1->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf1->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf1->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf1->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf1->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf1->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf1->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf1->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf1->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf1->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf1->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf1->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf1->setFontSubsetting(true);


$pdf1->AddPage(); 

    // $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    // $pdf->SetCreator(PDF_CREATOR);  
    // $pdf->SetTitle('NOVO SPORT - Horario Empleados');  
    // $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    // $pdf->SetDefaultMonospacedFont('helvetica');  
    // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    // $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    // $pdf->setPrintHeader(false);  
    // $pdf->setPrintFooter(false);  
    // $pdf->SetAutoPageBreak(TRUE, 10);  
    // $pdf->SetFont('helvetica', '', 11);  
    // $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">TIENDA - NOVO SPORT</h2>
      	<h3 >REPORTE DE HORARIO DE EMPLEADOS</h3>
      	<table border="1" cellspacing="0" cellpadding="2">  
           	<tr>  
           		<th align="left"><b>ID Empleado</b></th>
           		<th align="left"><b>Nombre</b></th>
           		<th align="left"><b>Apellidos</b></th>
               	<th align="left"><b>Departamento</b></th>
				<th align="left"><b>Horario</b></th> 
           	</tr>  
           	<br>
      ';  
    $content .= imprimirAsistencia(); 
    $content .= '</table>';  
    $pdf1->writeHTML($content); 
    ob_end_clean(); 
    $pdf1->Output('horarios.pdf', 'I');

?>