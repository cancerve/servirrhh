<?php 
	require_once('../../controller/sessionController.php'); 
	require_once('../../model/ctrabajo_tipoModel.php');	
	
	$objCTrabajo_Tipo 	= new CTrabajo_Tipo();
	///// CONVIERTE FECHA 04/07/1980 A 1980-07-04 (FORMATO MYSQL)
	function setFechaNoSQL($FE_FechaNac)
	{
		$partes = explode("-", $FE_FechaNac);
		$FE_FechaNac = $partes[2].'/'.$partes[1].'/'.$partes[0];
		return $FE_FechaNac;
	}
	//////////////////////////////////////////////////////////////
?>
<html>
<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
<head>
<title>SS :: Sistema en Linea para los Servicios de RRHH de VENALCASA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/jquery-ui.css" />
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/jquery-ui.js"></script>
<script type="text/javascript" src="../../js/funciones.js"></script>
<script type="text/javascript">
    function abrir_dialog() {
		var mensaje = "<?php echo $_GET['mensaje']; ?>";
		if(mensaje){
		  $( "#dialog" ).dialog({
			  show: "blind",
			  hide: "explode",
			  modal: true,
			  buttons: {
				Aceptar: function() {
				  $( this ).dialog( "close" );
				}
			  }
		  });
		}
    };
</script>
</head>
<body onLoad="abrir_dialog();">
<div id="dialog" title="Mensaje" style="display:none;">
    <p><?php echo $_GET['mensaje']; ?></p>
</div>
  <table class="Textonegro" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" align="left" bgcolor="#CCCCCC" class="Negrita">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTANCIAS DE EGRESO</td>
    </tr>
    <tr>
      <td><img src="../../images/blank.gif" width="20" height="5"></td>
    </tr>
    <tr>
      <td height="25" align="center">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="25" align="center"><form name="form1" method="post" action="Constancia_Egreso.php">
        <table width="350" border="0" cellspacing="2" cellpadding="2" class="Textonegro">
          <tr>
            <td align="left">Tipo de Constancia:</td>
            <td align="left"><select name="NU_IdTipoCTrabajo" required id="NU_IdTipoCTrabajo">
              <option selected="selected">:: Seleccione ::</option>
              <?php 
					$RSTipoCTrabajo		= $objCTrabajo_Tipo->listarTipos($objConexion);
					$cantRSTipoCTrabajo = $objConexion->cantidadRegistros($RSTipoCTrabajo);
					for($i=0;$i<$cantRSTipoCTrabajo;$i++){
						  $value	= $objConexion->obtenerElemento($RSTipoCTrabajo,$i,"NU_IdTipoCTrabajo");
						  $des		= $objConexion->obtenerElemento($RSTipoCTrabajo,$i,"AL_Tipo");

						  echo "<option value=".$value.">".$des."</option>";
					}  
				?>
            </select></td>
          </tr>
          <tr>
            <td align="left">Fecha de Egreso:</td>
            <td align="left"><input name="fecha_egreso" type="text" required id="fecha_egreso"></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="left"><input type="submit" name="button" id="button" value="Crear" class="BotonRojo"></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</body>
</html>