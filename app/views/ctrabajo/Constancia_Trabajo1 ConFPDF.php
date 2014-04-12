<?php 
	require_once('../../controller/sessionController.php');
	require('../../includes/pdf/fpdf.php'); 
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

	////////////////////////////////////////////////////////////////////
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

	
	/*$Parrafo1 = '     Quien suscribe <b>DIRECTOR (A) GENERAL DE RECURSOS HUMANOS</b> de <b>VENEZOLANA DE ALIMENTOS LA CASA, S.A.</b>, hace constar por medio de la presente, que la (el) ciudadana (o) <b>'.$AL_Apellido.' '.$AL_Nombre.'</b>, Cédula de Identidad N° V- C.I. <b>'.$NU_Cedula.'</b> presta sus servicios en esta Empresa desde el <b>'.$FE_Ingreso.'</b>, desempeñando el cargo de <b>'.$cargo_NU_IdCargo.'</b>, adscrito a <b>'.$AL_Adscripcion.'</b>, con un Sueldo Mensual Integral de <b>'.$SalarioIntegralLetras.' (Bs. '.$SueldoIntegral.')</b> más una asignación por concepto de Bono de Alimentación al 0,50% de la Unidad Tributaria Vigente, Monto Promedio Mensual de <b>MIL NOVECIENTOS CINCO BOLIVARES CON 00/100 CTS (Bs. 1.905,00).</b>'*/;

?>
<?php
//////////////////////[ CONVERSION A PDF ]///////////////////////////////

class PDF extends FPDF{
	function Header(){
		$this->SetMargins('25', '', '25');
		$this->Image('../../images/head.jpg',25,20,160,0);
		$this->SetFillColor(232,232,232);
		$this->Ln(20);	
		$this->Cell(0,0,'',1,0,'C');
		$this->SetFont('Arial','B',10);
		$this->Ln(3);
		$this->Cell(0,0,'Rif. G-20008504-5',0,0,'L');
		$this->Ln(15);
		$this->SetFont('Arial','BI',14);
		$this->Cell(0,0,'C O N S T A N C I A',0,0,'C');
		$this->Ln(10);
	}
	function Footer()	{
		$this->SetMargins('25', '', '25');
		$this->SetY(-80);
		$this->SetFont('Arial','BI',12);
		$this->Ln(5);
		$this->Cell(0,0,'LIC. YURISMAR MEDINA',0,0,'C');
		$this->Ln(5);
		$this->Cell(0,0,'DIRECTOR (A) GENERAL DE RECURSOS HUMANOS',0,0,'C');
		$this->Ln(30);
		$this->SetFont('Arial','',8);
		$this->Cell(0,7,'Constancia que tiene validez por un periodo de Noventa (90) días.',0,0,'C',0);
		$this->Ln(10);
		$this->Cell(0,0,'Código de Verificación: '.$_SESSION['AF_Codigo'],0,0,'R');
		$this->Ln(3);
		$this->SetFillColor(232,232,232);	
		$this->Cell(0,0,'',1,0,'C');
		$this->Ln(5);
		$this->Cell(0,0,'VENEZOLANA DE ALIMENTOS LA CASA, S.A.',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Av. Sucre, entre la Policía Nacional Bolivariana y Calle Mauri, Centro de Acopio Catia Parroquia Sucre',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Municipio Libertador. Caracas - Venezuela',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'Telfs.: 0416.607.77.14',0,0,'C');
		$this->Ln(3);				
	}
	
////////// FUNCION PARA FORMATEAR TEXTO HTML ///////
	var $B;
	var $I;
	var $U;
	var $HREF;
	
	function PDF($orientation='P', $unit='mm', $size='A4')
	{
		// Llama al constructor de la clase padre
		$this->FPDF($orientation,$unit,$size);
		// Iniciación de variables
		$this->B = 0;
		$this->I = 0;
		$this->U = 0;
		$this->HREF = '';
	}
	
	function WriteHTML($html)
	{
		// Intérprete de HTML
		$html = str_replace("\n",' ',$html);
		$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				// Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else
					$this->Write(5,$e);
			}
			else
			{
				// Etiqueta
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					// Extraer atributos
					$a2 = explode(' ',$e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}
	
	function OpenTag($tag, $attr)
	{
		// Etiqueta de apertura
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF = $attr['HREF'];
		if($tag=='BR')
			$this->Ln(5);
	}
	
	function CloseTag($tag)
	{
		// Etiqueta de cierre
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF = '';
	}
	
	function SetStyle($tag, $enable)
	{
		// Modificar estilo y escoger la fuente correspondiente
		$this->$tag += ($enable ? 1 : -1);
		$style = '';
		foreach(array('B', 'I', 'U') as $s)
		{
			if($this->$s>0)
				$style .= $s;
		}
		$this->SetFont('',$style);
	}
	
	function PutLink($URL, $txt)
	{
		// Escribir un hiper-enlace
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}	
}

//Creacin del Contenido

$pdf=new PDF();
$pdf->AddPage('P','A4');
$pdf->SetMargins('25', '', '25');
$pdf->Ln(7);
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,7,'     Quien suscribe DIRECTOR (A) GENERAL DE RECURSOS HUMANOS de VENEZOLANA DE ALIMENTOS LA CASA, S.A., hace constar por medio de la presente, que la (el) ciudadana (o) '.$AL_Apellido.' '.$AL_Nombre.', Cédula de Identidad N° V- C.I. '.$NU_Cedula.' presta sus servicios en esta Empresa desde el '.$FE_Ingreso.', desempeñando el cargo de '.$cargo_NU_IdCargo.', adscrito a '.$AL_Adscripcion.', con un Sueldo Mensual Integral de '.$SalarioIntegralLetras.' (Bs. '.$SueldoIntegral.') más una asignación por concepto de Bono de Alimentación al 0,50% de la Unidad Tributaria Vigente, Monto Promedio Mensual de MIL NOVECIENTOS CINCO BOLIVARES CON 00/100 CTS (Bs. 1.905,00).',0,'J',0);
$pdf->Ln(10);
$pdf->MultiCell(0,7,'             Constancia que se expide a petición de la parte interesada en Caracas a los '.$dia.' días del mes de '.$mes.' del año '.$ano.'.',0,'J',0);
$pdf->Ln(13);
$pdf->Cell(0,7,'Atentamente,',0,0,'C',0);
$pdf->Ln(40);


//$pdf->WriteHTML($Parrafo1);


/*
	$pdf->Cell(60,7,ucwords(strtolower(utf8_decode($AF_NombreProducto.' ('.setDecimalEsp($NU_Contenido).' '.$AL_Medida.')'))),1,0,'L',1);
	$pdf->Cell(25,7,number_format($BS_PrecioUnitario,2,',','.').' BsF.',1,0,'R',1);
//	$pdf->Cell(25,7,$NU_Max,1,0,'R',1);	
	$pdf->Cell(25,7,number_format($Solicitantes,0,'','.'),1,0,'R',1);
	$pdf->Cell(36,7,number_format($totalKg,3,',','.').' '.$AL_Medida,1,0,'R',1);	
	$pdf->Cell(36,7,number_format($totalBs,2,',','.').' BsF.',1,0,'R',1);
	$pdf->Ln(7);
	
//	$total_NU_Max 		+= $NU_Max;
	$total_Solicitantes += $Solicitantes ;
	$total_kilos		+= $totalKg;
	$total_totalBs 		+= $totalBs;

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(93,7,'TOTAL PRODUCTOS SOLICITADOS',0,0,'R',0);
//$pdf->Cell(25,7,$total_NU_Max,1,0,'R',1);
$pdf->Cell(25,7,number_format($total_Solicitantes,0,'','.'),1,0,'R',1);	
//$pdf->Cell(25,7,number_format($total_kilos,3,',','.'),1,0,'R',1);	
$pdf->Cell(36,7,'TOTAL COMPRA',0,0,'R',0);
$pdf->Cell(36,7,number_format($total_totalBs,2,',','.').' BsF.',1,0,'R',1);
$pdf->Ln(5);
$pdf->Ln(30);
$pdf->Cell(0,10,'LDA. YURISMAR MEDINA',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(0,10,'DIRECTORA GENERAL DE RECURSOS HUMANOS',0,0,'C');

$pdf->SetLeftMargin(10);
$pdf->Ln(5);

*/
$pdf->Ln(3);
$pdf->Output();
/**/
?>