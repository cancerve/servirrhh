<?php 
	require_once('../../controller/sessionController.php');
	require_once('../../model/usuarioModel.php');
	require_once('../../includes/tcpdf/tcpdf.php'); 
	
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
	///////////////////////// DATOS CONSULTAS ///////////////////////////////////////////
	$AL_Nombre 					= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Nombre")));
	$AL_Apellido 				= utf8_decode(strtoupper($objConexion->obtenerElemento($RS,0,"AL_Apellido")));
	$NU_Cedula 					= number_format($objConexion->obtenerElemento($RS,0,"NU_Cedula"),0,'','.');
	$FE_Ingreso 				= setFechaNOSQL($objConexion->obtenerElemento($RS,0,"FE_Ingreso"));

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
		$this->SetY(-85);
		$this->SetFont('helvetica','BI',12);
		$this->Ln(5);
		$this->Cell(0,0,'LCDA. YURISMAR MEDINA',0,0,'C');
		$this->Ln(5);
		$this->Cell(0,0,'DIRECTOR (A) GENERAL DE RECURSOS HUMANOS',0,0,'C');
		$this->Ln(40);
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
		$this->Image('../../images/sello.png', 78, 185, 50, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
}

	//$fontname = $pdf->addTTFfont('../../includes/tcpdf/fonts/Arial.ttf', 'TrueType', '', 32);
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Direccion de RRHH de VENALCASA, S.A. Rif. G-20008504-5');
	$pdf->SetTitle('Constancia de BANAVIH');
	$pdf->SetSubject('Generado Automaticamente por el Sistema de Atencion al Empleado');
	$pdf->SetKeywords('Constancia');
	
	////// AGREGAR PAGINA
	$pdf->AddPage();
	$pdf->SetMargins('25', '', '20');
	$pdf->SetFont('helvetica', '', 11);
	
	$pdf->Ln(60);
	
	$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quien suscribe <b>DIRECTOR (A) GENERAL DE RECURSOS HUMANOS</b> de <b>VENEZOLANA DE ALIMENTOS LA CASA, S.A.</b>, hace constar por medio de la presente, que la (el) ciudadana (o) <b>'.$AL_Apellido.' '.$AL_Nombre.'</b>, Cédula de Identidad N° V- C.I. <b>'.$NU_Cedula.'</b> es ahorrista del Fondo Mutual Habitacional, que contempla la Ley del Subsistema de Vivienda y política Habitacional, manteniendo su aporte mensual y en forma consecutiva desde el '.$FE_Ingreso.'.</span>'),0,10,0,true,'J',true);
	
	$pdf->Ln(10);
	$pdf->writeHTMLCell(0,20,'','',utf8_encode('<span style="line-height:25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Constancia que se expide a petición de la parte interesada en Caracas a los '.$dia.' días del mes de '.$mes.' del año '.$ano.'.</span>'),0,10,0,true,'J',true);
	
	$pdf->Ln(10);
	$pdf->Cell(0,7,'Atentamente,',0,0,'C',0);
	
	/////// ENVIAR DOCUMENTO
	$pdf->Output('ConstanciaTrabajo.pdf', 'I');
?>
