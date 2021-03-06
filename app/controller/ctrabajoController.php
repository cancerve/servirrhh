<?php
	session_start();
	
	require_once("../includes/constantes.php");
	require_once("../includes/conexion.class.php");

	$objConexion= new conexion(SERVER,USER,PASS,DB);
	
	require_once('../model/ctrabajoModel.php');
	require_once('../model/usuarioModel.php');

	$objCTrabajo 	= new CTrabajo();
	$objUsuario		= new Usuario();

?>
<?php
////////////////////// CASO DE USO: CREAR CONSTANCIA DE TRABAJO ///////

	if ($_POST['origen']=='CTrabajo')
	{
		
		$RSUsuario 		= $objUsuario->buscarUsuario($objConexion,$_SESSION['NU_Cedula']);
		$cantRSUsuario 	= $objConexion->cantidadRegistros($RSUsuario);
		
		if ($cantRSUsuario>0){
			$NU_IdUsuario 				= $objConexion->obtenerElemento($RSUsuario,0,"NU_IdUsuario");
			$NU_Cedula					= $objConexion->obtenerElemento($RSUsuario,0,"NU_Cedula");
			$sede_NU_IdSede 			= $objConexion->obtenerElemento($RSUsuario,0,"sede_NU_IdSede");
			$gerencia_NU_IdGerencia 	= $objConexion->obtenerElemento($RSUsuario,0,"gerencia_NU_IdGerencia");
			$cargo_NU_IdCargo 			= $objConexion->obtenerElemento($RSUsuario,0,"cargo_NU_IdCargo");
			$BS_SalarioBasico 			= $objConexion->obtenerElemento($RSUsuario,0,"BS_SalarioBasico");
			$BS_PrimaAntiguedad 		= $objConexion->obtenerElemento($RSUsuario,0,"BS_PrimaAntiguedad");
			$BS_PrimaResponsabilidad 	= $objConexion->obtenerElemento($RSUsuario,0,"BS_PrimaResponsabilidad");
			$BS_PrimaEspecializacion 	= $objConexion->obtenerElemento($RSUsuario,0,"BS_PrimaEspecializacion");
			$BS_PrimaTransporte 		= $objConexion->obtenerElemento($RSUsuario,0,"BS_PrimaTransporte");
			$BS_PrimaOtra 				= $objConexion->obtenerElemento($RSUsuario,0,"BS_PrimaOtra");
		}

		$NU_IdCTrabajo 	= ($objCTrabajo->obtenerUltimo($objConexion)+1);
		$AF_Codigo = md5($NU_Cedula.$NU_IdCTrabajo);
		$NU_IdTipoCTrabajo	= $_POST["NU_IdTipoCTrabajo"];

		$objCTrabajo->insertar($objConexion,$_SESSION["NU_IdUsuario"],$AF_Codigo,$sede_NU_IdSede,$gerencia_NU_IdGerencia,$cargo_NU_IdCargo,$BS_SalarioBasico,$BS_PrimaAntiguedad,$BS_PrimaResponsabilidad,$BS_PrimaEspecializacion,$BS_PrimaTransporte,$BS_PrimaOtra,$NU_IdTipoCTrabajo);

		header("Location: ../views/ctrabajo/Constancia_Trabajo".$NU_IdTipoCTrabajo.".php?NU_IdCTrabajo=".$NU_IdCTrabajo);
	}
	
////////////////////// VERIFICAR CONSTANCIA /////////////////////////////////
	if ($_POST['origen']=='Verificacion')
	{
		$AF_Codigo = $_POST['AF_Codigo'];

		$RSConstancia 		= $objCTrabajo->buscarXconstancia($objConexion,$AF_Codigo);
		$cantRSConstancia 	= $objConexion->cantidadRegistros($RSConstancia);
		
		if ($cantRSConstancia>0){
			$NU_IdCTrabajo 		= $objConexion->obtenerElemento($RSConstancia,0,"NU_IdCTrabajo");
			$NU_IdTipoCTrabajo 	= $objConexion->obtenerElemento($RSConstancia,0,"NU_IdTipoCTrabajo");

			header("Location: ../views/ctrabajo/Constancia_Trabajo".$NU_IdTipoCTrabajo.".php?NU_IdCTrabajo=".$NU_IdCTrabajo);
		}else{
			$mensaje = 'El código: <b>'.$_POST['AF_Codigo'].'</b>, no corresponde a ninguna Constancia de Trabajo Valida.';
			header("Location: ../views/ctrabajo/verificacion/central.php?mensaje=".$mensaje);			
		}
	
	}	
	
?>
