<?php 
	require_once('../../controller/sessionController.php');
	require_once('../../includes/tcpdf/tcpdf.php'); 
	
	require_once('../../model/ctrabajoModel.php');
	require_once('../../includes/NumLetras.php');	

	$objCTrabajo 	= new CTrabajo();
	
	$NU_IdCTrabajo = $_GET['NU_IdCTrabajo'];
	
	$RS 		= $objCTrabajo->buscar($objConexion,$NU_IdCTrabajo);
	$cantRS 	= $objConexion->cantidadRegistros($RS);

	///// CONVIERTE FECHA 1980-07-04 A 04/07/1980 (FORMATO ESPANOL)
	function setFechaNOSQL($FE_FechaNac)
	{
		$partes = explode("-", $FE_FechaNac);
		$FE_FechaNac = $partes[2].'/'.$partes[1].'/'.$partes[0];
		return $FE_FechaNac;
	}

	///////////////////////// DATOS CONSULTAS ///////////////////////////////////////////
	$AL_Nombre 					= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Nombre")));
	$AL_Apellido 				= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Apellido")));
	$NU_Cedula 					= number_format($objConexion->obtenerElemento($RS,0,"NU_Cedula"),0,'','.');
	$FE_Ingreso 				= setFechaNOSQL($objConexion->obtenerElemento($RS,0,"FE_Ingreso"));
	$AL_NombreSede 				= $objConexion->obtenerElemento($RS,0,"AL_NombreSede");
	$AL_NombreGerencia 			= $objConexion->obtenerElemento($RS,0,"AL_NombreGerencia");		
	$_SESSION['AF_Codigo']		= $objConexion->obtenerElemento($RS,0,"AF_Codigo");	
	$cargo_NU_IdCargo 			= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"cargo_NU_IdCargo")));
	$AL_Adscripcion 			= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Adscripcion")));	
	$BS_SalarioBasico 			= $objConexion->obtenerElemento($RS,0,"BS_SalarioBasico");
	$BS_PrimaAntiguedad 		= $objConexion->obtenerElemento($RS,0,"BS_PrimaAntiguedad");	
	$BS_PrimaResponsabilidad 	= $objConexion->obtenerElemento($RS,0,"BS_PrimaResponsabilidad");
	$BS_PrimaEspecializacion 	= $objConexion->obtenerElemento($RS,0,"BS_PrimaEspecializacion");
	$BS_PrimaTransporte 		= $objConexion->obtenerElemento($RS,0,"BS_PrimaTransporte");
	$BS_PrimaOtra 				= $objConexion->obtenerElemento($RS,0,"BS_PrimaOtra");	
	$FE_Solicitud 				= $objConexion->obtenerElemento($RS,0,"FE_Solicitud");
	$SueldoIntegral				= $BS_SalarioBasico+$BS_PrimaAntiguedad+$BS_PrimaResponsabilidad+$BS_PrimaEspecializacion+$BS_PrimaTransporte+$BS_PrimaOtra;
	$SalarioIntegralLetras		= utf8_decode(strtoupper(convertir_a_letras($SueldoIntegral)));	
	$SueldoIntegral				= number_format($SueldoIntegral,2,',','.');

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
		$this->Cell(0,0,'LIC. YURISMAR MEDINA',0,0,'C');
		$this->Ln(5);
		$this->Cell(0,0,'DIRECTOR (A) GENERAL DE RECURSOS HUMANOS',0,0,'C');
		$this->Ln(10);
		$this->SetFont('helvetica','',8);
		$this->Cell(0,0,utf8_encode('Constancia que tiene validez por un periodo de Noventa (90) días.'),0,0,'C');
		$this->Ln(10);
		$this->Cell(0,0,utf8_encode('Verifique la presente en: www.venalcasa.net.ve/servirrhh e introduzca: ').$_SESSION['AF_Codigo'],0,0,'C');
		$this->Ln(3);
		$this->SetFillColor(232,232,232);	
		$this->Line(25,258,185,258);
		$this->Ln(5);
		$this->Cell(0,0,'VENEZOLANA DE ALIMENTOS LA CASA, S.A.',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,utf8_encode('Av. Sucre, entre la Policía Nacional Bolivariana y Calle Mauri, Centro de Acopio Catia Parroquia Sucre'),0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Municipio Libertador. Caracas - Venezuela',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Telfs.: 0416.607.77.14',0,0,'C');			
    }
}

	//$fontname = $pdf->addTTFfont('../../includes/tcpdf/fonts/Arial.ttf', 'TrueType', '', 32);
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Direccion de RRHH de VENALCASA, S.A. Rif. G-20008504-5');
	$pdf->SetTitle('Constancia de Trabajo');
	$pdf->SetSubject('Generado Automaticamente por el Sistema de Atencion al Empleado');
	$pdf->SetKeywords('Constancia');
	
	////// AGREGAR PAGINA
	$pdf->AddPage();
	$pdf->SetMargins('25', '', '20');
	$pdf->SetFont('helvetica', '', 11);
	
	$pdf->Ln(60);
	$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quien suscribe <b>DIRECTOR (A) GENERAL DE RECURSOS HUMANOS</b> de <b>VENEZOLANA DE ALIMENTOS LA CASA, S.A.</b>, hace constar por medio de la presente, que la (el) ciudadana (o) <b>'.$AL_Apellido.' '.$AL_Nombre.'</b>, Cédula de Identidad N° V- C.I. <b>'.$NU_Cedula.'</b> presta sus servicios en esta Empresa desde el <b>'.$FE_Ingreso.'</b>, desempeñando el cargo de <b>'.$cargo_NU_IdCargo.'</b>, adscrito a <b>'.$AL_Adscripcion.'</b>, con un Sueldo Mensual Integral de <b>'.$SalarioIntegralLetras.' (Bs. '.$SueldoIntegral.')</b> más una asignación por concepto de Bono de Alimentación al 0,50% de la Unidad Tributaria Vigente, Monto Promedio Mensual de <b>MIL NOVECIENTOS CINCO BOLIVARES CON 00/100 CTS (Bs. 1.905,00)</b>.</span>'),0,10,0,true,'J',true);
	
	$pdf->Ln(10);
	$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Constancia que se expide a petición de la parte interesada en Caracas a los '.$dia.' días del mes de '.$mes.' del año '.$ano.'.</span>'),0,10,0,true,'J',true);
	
	$pdf->Ln(10);
	$pdf->Cell(0,7,'Atentamente,',0,0,'C',0);
	
	/////// ENVIAR DOCUMENTO
	$pdf->Output('ConstanciaTrabajo.pdf', 'I');
?>
