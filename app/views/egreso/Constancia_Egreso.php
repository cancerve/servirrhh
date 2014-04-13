<?php 
	require_once('../../controller/sessionController.php');
	require_once('../../model/usuarioModel.php');
	require_once('../../includes/tcpdf/tcpdf.php'); 
	require_once('../../includes/NumLetras.php');	
	
	$objUsuario		= new Usuario();
	
	$RS 		= $objUsuario->buscarUsuario2($objConexion,$_SESSION['NU_IdUsuario']);
	$cantRS 	= $objConexion->cantidadRegistros($RS);

	///// CONVIERTE FECHA 1980-07-04 A 04/07/1980 (FORMATO ESPANOL)
	function setFechaNOSQL($FE_FechaNac)
	{
		$partes = explode("-", $FE_FechaNac);
		$FE_FechaNac = $partes[2].'/'.$partes[1].'/'.$partes[0];
		return $FE_FechaNac;
	}

	$FE_Egreso 					= $_POST['FE_Egreso'];
	$NU_IdTipo 					= $_POST['NU_IdTipo'];
	
	///////////////////////// DATOS CONSULTAS ///////////////////////////////////////////
	$AL_Nombre 					= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Nombre")));
	$AL_Apellido 				= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Apellido")));
	$NU_Cedula 					= number_format($objConexion->obtenerElemento($RS,0,"NU_Cedula"),0,'','.');
	$FE_Ingreso 				= setFechaNOSQL($objConexion->obtenerElemento($RS,0,"FE_Ingreso"));
	$cargo_NU_IdCargo 			= trim(utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"cargo_NU_IdCargo"))));
	$AL_Adscripcion 			= trim(utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Adscripcion"))));	
	$BS_SalarioBasico 			= $objConexion->obtenerElemento($RS,0,"BS_SalarioBasico");
	$BS_PrimaAntiguedad 		= $objConexion->obtenerElemento($RS,0,"BS_PrimaAntiguedad");	
	$BS_PrimaResponsabilidad 	= $objConexion->obtenerElemento($RS,0,"BS_PrimaResponsabilidad");
	$BS_PrimaEspecializacion 	= $objConexion->obtenerElemento($RS,0,"BS_PrimaEspecializacion");
	$BS_PrimaTransporte 		= $objConexion->obtenerElemento($RS,0,"BS_PrimaTransporte");
	$BS_PrimaOtra 				= $objConexion->obtenerElemento($RS,0,"BS_PrimaOtra");	
	/////////// DATOS PARA LA INTEGRAL ///////////////////////////////////////
	$SueldoIntegral				= $BS_SalarioBasico+$BS_PrimaAntiguedad+$BS_PrimaResponsabilidad+$BS_PrimaEspecializacion+$BS_PrimaTransporte+$BS_PrimaOtra;
	$SalarioIntegralLetras		= utf8_decode(strtoupper(convertir_a_letras($SueldoIntegral)));	
	$SueldoIntegral				= number_format($SueldoIntegral,2,',','.');
	/////////// DATOS PARA LA DESGLOSADA ///////////////////////////////////
	$BS_SalarioBasicoLetras			= utf8_decode(strtoupper(convertir_a_letras($BS_SalarioBasico)));
	$prima1 = '';
	$prima2 = '';	
	$prima3 = '';	

	
	if ($BS_PrimaResponsabilidad!='0.00'){
		$UTResponsabilidad				= $BS_PrimaResponsabilidad/127;
		$UTResponsabilidadLetras		= strtoupper(convertir_a_letras($UTResponsabilidad));
		$UTResponsabilidadLetras		= str_replace('BOLIVARES','',$UTResponsabilidadLetras);
		$BS_PrimaResponsabilidadLetras 	= strtoupper(convertir_a_letras($BS_PrimaResponsabilidad));
		$prima1 = ', más una Prima de Responsabilidad de <b>'.$UTResponsabilidadLetras.' UNIDADES TRIBUTARIAS ('.$UTResponsabilidad.' U.T.)</b> equivalentes a <b>'.$BS_PrimaResponsabilidadLetras.' (Bs. '.number_format($BS_PrimaResponsabilidad,2,',','.').')</b>';
	}
	if ($BS_PrimaAntiguedad!='0.00'){
		$BS_PrimaAntiguedadLetras	 	= utf8_decode(strtoupper(convertir_a_letras($BS_PrimaAntiguedad)));
		$prima2 = ', más una Prima de Antiguedad de <b>'.$BS_PrimaAntiguedadLetras.' (Bs. '.number_format($BS_PrimaAntiguedad,2,',','.').')</b>';
	}
	if ($BS_PrimaEspecializacion!='0.00'){
		$BS_PrimaEspecializacionLetras 	= utf8_decode(strtoupper(convertir_a_letras($BS_PrimaEspecializacion)));
		$prima3 = ', más una Prima de Especialización de <b>'.$BS_PrimaEspecializacionLetras.' ('.number_format($BS_PrimaEspecializacion,2,',','.').')</b>';	
	}
	
	$BS_SalarioBasico					= number_format($BS_SalarioBasico,2,',','.');	
	////////////// FECHA DE LA CONSTANCIA //////////////////////////////////////	
	$FE_Solicitud = date("Y-m-d");
	$FE_Solicitud = explode("-",$FE_Solicitud);
	$mes = $FE_Solicitud[1];
	
	$meses = array('01' => 'Enero','02' => 'Febrero','03' => 'Marzo','04' => 'Abril','05' => 'Mayo','06' => 'Junio','07' => 'Julio','08' => 'Agosto','09' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre');

	$dia = $FE_Solicitud[2];
	$mes = $meses[$mes];
	$ano = $FE_Solicitud[0];
?>
<?php

class MYPDF extends TCPDF {

    public function Header() {
		$this->SetMargins('25', '', '20');
		$this->Image('../../images/head.jpg', 25, 20, 160, 0, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetFillColor(232,232,232);
		$this->Line(25,28,185,28);
		$this->SetFont('helvetica','B',10);
		$this->Ln(10);
		$this->Cell(0,0,'Rif. G-20008504-5',0,0,'L');
		$this->Ln(15);
		$this->SetFont('helvetica','BI',14);
		$this->Cell(0,0,'C O N S T A N C I A',0,0,'C');
		$this->Ln(15);		
    }

    public function Footer() {
		$this->SetMargins('25', '', '20');
		$this->SetY(-65);
		$this->SetFont('helvetica','BI',12);
		$this->Ln(5);
		$this->Cell(0,0,'LCDA. YURISMAR MEDINA',0,0,'C');
		$this->Ln(5);
		$this->Cell(0,0,'DIRECTOR (A) GENERAL DE RECURSOS HUMANOS',0,0,'C');
		$this->Ln(20);
		$this->SetFont('helvetica','',8);
		$this->Cell(0,0,utf8_encode('Valido por 90 días a partir de la presente fecha.'),0,0,'C');
//		$this->Cell(0,0,utf8_encode('Verifique la presente en: www.venalcasa.net.ve/servirrhh e introduzca: ').$_SESSION['AF_Codigo'],0,0,'C');
		$this->Ln(3);
		$this->SetFillColor(232,232,232);	
		$this->Line(25,268,185,268);
		$this->Ln(5);
		$this->Cell(0,0,'VENEZOLANA DE ALIMENTOS LA CASA, S.A.',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,utf8_encode('Av. Sucre, entre la Policía Nacional Bolivariana y Calle Mauri, Centro de Acopio Catia Parroquia Sucre'),0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Municipio Libertador. Caracas - Venezuela',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Telfs.: 0416.607.77.14',0,0,'C');	
		$this->Image('../../images/sello.png', 78, 205, 50, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
}

	//$fontname = $pdf->addTTFfont('../../includes/tcpdf/fonts/Arial.ttf', 'TrueType', '', 32);
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Direccion de RRHH de VENALCASA, S.A. Rif. G-20008504-5');
	$pdf->SetTitle('Constancia de Egreso');
	$pdf->SetSubject('Generado Automaticamente por el Sistema de Atencion al Empleado');
	$pdf->SetKeywords('Constancia');
	
	////// AGREGAR PAGINA
	$pdf->AddPage();
	$pdf->SetMargins('25', '', '20');
	$pdf->SetFont('helvetica', '', 11);
	
	$pdf->Ln(60);
	
	if ($NU_IdTipo==1){
		
		$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quien suscribe <b>DIRECTOR (A) GENERAL DE RECURSOS HUMANOS</b> de <b>VENEZOLANA DE ALIMENTOS LA CASA, S.A.</b>, hace constar por medio de la presente, que la (el) ciudadana (o) <b>'.$AL_Apellido.' '.$AL_Nombre.'</b>, Cédula de Identidad N° V- C.I. <b>'.$NU_Cedula.'</b> prestó sus servicios en esta Empresa desde el <b>'.$FE_Ingreso.'</b> hasta el <b>'.$FE_Egreso.'</b>, desempeñando el cargo de <b>'.$cargo_NU_IdCargo.'</b>, adscrito a <b>'.$AL_Adscripcion.'</b>, con un Sueldo Mensual Integral de <b>'.$SalarioIntegralLetras.' (Bs. '.$SueldoIntegral.')</b> más una asignación por concepto de Bono de Alimentación al <b>0,50%</b> de la Unidad Tributaria Vigente, Monto Promedio Mensual de <b>MIL NOVECIENTOS CINCO BOLIVARES CON 00/100 CTS (Bs. 1.905,00)</b>.</span>'),0,10,0,true,'J',true);
	
	}else{
		
		$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quien suscribe <b>DIRECTOR (A) GENERAL DE RECURSOS HUMANOS</b> de <b>VENEZOLANA DE ALIMENTOS LA CASA, S.A.</b>, hace constar por medio de la presente, que la (el) ciudadana (o) <b>'.$AL_Apellido.' '.$AL_Nombre.'</b>, Cédula de Identidad N° V- C.I. <b>'.$NU_Cedula.'</b> prestó sus servicios en esta Empresa desde el <b>'.$FE_Ingreso.'</b> hasta el <b>'.$FE_Egreso.'</b>, desempeñando el cargo de <b>'.$cargo_NU_IdCargo.'</b>, adscrito a <b>'.$AL_Adscripcion.'</b>, con un Sueldo Mensual de <b>'.$BS_SalarioBasicoLetras.' (Bs. '.$BS_SalarioBasico.')</b>'.$prima1.$prima2.$prima3.', y una asignación por concepto de Bono de Alimentación al <b>0,50%</b> de la Unidad Tributaria Vigente, Monto Promedio Mensual de <b>MIL NOVECIENTOS CINCO BOLIVARES CON 00/100 CTS (Bs. 1.905,00)</b>.</span>'),0,10,0,true,'J',true);		
	
	}
	
	$pdf->Ln(10);
	$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Constancia que se expide a petición de la parte interesada en Caracas a los '.$dia.' días del mes de '.$mes.' del año '.$ano.'.</span>'),0,10,0,true,'J',true);
	
	$pdf->Ln(10);
	$pdf->Cell(0,7,'Atentamente,',0,0,'C',0);
	
	/////// ENVIAR DOCUMENTO
	$pdf->Output('ConstanciaTrabajo.pdf', 'I');
?>
