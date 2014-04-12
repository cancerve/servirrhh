<?php 
	require_once("app/includes/constantes.php");
	require_once("app/includes/conexion.class.php");
	require_once('app/model/usuarioModel.php');
	
	$objConexion= new conexion(SERVER,USER,PASS,DB);
	$objUsuario = new Usuario();

	
	$RSUsuario 	= $objUsuario->listar($objConexion);
	$cantRS		= $objConexion->cantidadRegistros($RSUsuario);
?>
<html>
<head>
<title>MERCADO VIRTUAL DE VENALCASA</title>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>ID</td>  
    <td>CEDULA</td>
    <td>NOMBRE</td>
    <td>APELLIDO</td>
    <td>CARGO</td>
    <td>INGRESO</td>
    <td>SALARIO</td>
    <td>ANTIGUEDAD</td>  
    <td>RESPONSABILIDAD</td>       
    <td>ESPECIALIZACION</td>
    <td>TRANSPORTE</td>  
    <td>OTRA PRIMA</td>       
  </tr>
<?php
	for($i=0;$i<$cantRS;$i++){
		$NU_IdUsuario				= $objConexion->obtenerElemento($RSUsuario,$i,"NU_IdUsuario");						
		$NU_Cedula					= $objConexion->obtenerElemento($RSUsuario,$i,"NU_Cedula");						
		$AL_Nombre					= $objConexion->obtenerElemento($RSUsuario,$i,"AL_Nombre");						
		$AL_Apellido				= $objConexion->obtenerElemento($RSUsuario,$i,"AL_Apellido");						
		$cargo_NU_IdCargo			= $objConexion->obtenerElemento($RSUsuario,$i,"cargo_NU_IdCargo");						
		$FE_Ingreso					= $objConexion->obtenerElemento($RSUsuario,$i,"FE_Ingreso");												
		$BS_SalarioBasico			= $objConexion->obtenerElemento($RSUsuario,$i,"BS_SalarioBasico");						
		$BS_PrimaAntiguedad			= $objConexion->obtenerElemento($RSUsuario,$i,"BS_PrimaAntiguedad");
		$BS_PrimaResponsabilidad	= $objConexion->obtenerElemento($RSUsuario,$i,"BS_PrimaResponsabilidad");						
		$BS_PrimaEspecializacion	= $objConexion->obtenerElemento($RSUsuario,$i,"BS_PrimaEspecializacion");												
		$BS_PrimaTransporte			= $objConexion->obtenerElemento($RSUsuario,$i,"BS_PrimaTransporte");						
		$BS_PrimaOtra				= $objConexion->obtenerElemento($RSUsuario,$i,"BS_PrimaOtra");		
											

?>

  <tr>
    <td>&nbsp;<?php echo $NU_IdUsuario; ?></td>
    <td>&nbsp;<?php echo $NU_Cedula; ?></td>
    <td>&nbsp;<?php echo $AL_Nombre; ?></td>
    <td>&nbsp;<?php echo $AL_Apellido; ?></td>
    <td>&nbsp;<?php echo $cargo_NU_IdCargo; ?></td>
    <td>&nbsp;<?php echo $FE_Ingreso; ?></td>
    <td>&nbsp;<?php echo $BS_SalarioBasico; ?></td>
    <td>&nbsp;<?php echo $BS_PrimaAntiguedad; ?></td>
    <td>&nbsp;<?php echo $BS_PrimaResponsabilidad; ?></td>
    <td>&nbsp;<?php echo $BS_PrimaEspecializacion; ?></td>
    <td>&nbsp;<?php echo $BS_PrimaTransporte; ?></td>
    <td>&nbsp;<?php echo $BS_PrimaOtra; ?></td>    
    <?php
		//$objUsuario->actualizar_primas($objConexion,$NU_Cedula);

?>
  </tr>
  
<?php } ?>  
</table>
</body>
</html>