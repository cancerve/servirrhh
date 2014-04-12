<?php 
	require_once('../../controller/sessionController.php'); 
	require_once('../../model/ctrabajo_tipoModel.php');
	require_once('../../model/ctrabajoModel.php');	
	
	$objCTrabajo_Tipo 	= new CTrabajo_Tipo();
	$objCTrabajo 		= new CTrabajo();
	
	$RS 	= $objCTrabajo->listarConstancias($objConexion,$_SESSION["NU_IdUsuario"]);
	$cantRS = $objConexion->cantidadRegistros($RS);

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
      <td height="25" align="left" bgcolor="#CCCCCC" class="Negrita">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONSTANCIAS DE TRABAJO</td>
    </tr>
    <tr>
      <td><img src="../../images/blank.gif" width="20" height="5"></td>
    </tr>
    <tr>
      <td height="25" align="center">&nbsp;</td>
    </tr>
    
    <tr>
      <td height="25" align="center"><form name="form1" method="post" action="../../controller/ctrabajoController.php">
        <table width="350" border="0" cellspacing="2" cellpadding="2" class="Textonegro">
          <tr>
            <td colspan="2" align="left">Escoja el tipo de Constancia que desea:
            <input name="origen" type="hidden" id="origen" value="CTrabajo"></td>
          </tr>
          <tr>
            <td align="left">
            <select name="NU_IdTipoCTrabajo" required id="NU_IdTipoCTrabajo">
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
            <td align="center"><input type="submit" name="button" id="button" value="Crear" class="BotonRojo"></td>
          </tr>
        </table>
      </form></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
    </tr>
    <?php if ($cantRS>0){ ?>
    <tr>
      <td height="25">
      <table width="600" class="TablaRojaGrid" align="center">
      <thead>
        <tr class="TablaRojaGridTRTitulo">
          <th width="160" align="center" scope="col">FECHA DE SOLICITUD</th>
          <th width="364" align="center" scope="col">TIPO DE
            CONSTANCIA</th>
          <th width="60" align="center" scope="col">VER</th>
          <!--<th width="60" align="center" scope="col">BORRAR</th>-->
        </tr>
	  </thead>
      <tbody>
	<?php
    	for($i=0; $i<$cantRS; $i++){
			$NU_IdCTrabajo 		= $objConexion->obtenerElemento($RS,$i,'NU_IdCTrabajo');
			$FE_Solicitud 		= $objConexion->obtenerElemento($RS,$i,'FE_Solicitud');
			$NU_IdTipoCTrabajo 	= $objConexion->obtenerElemento($RS,$i,'NU_IdTipoCTrabajo');
			$AL_Tipo			= $objConexion->obtenerElemento($RS,$i,'AL_Tipo');			
    ?>
        <tr>
          <td align="center" class="TablaRojaGridTD"><?php echo setFechaNoSQL($FE_Solicitud); ?></td>
          <td align="left" class="TablaRojaGridTD"><?=$AL_Tipo?></td>
          <td align="center" class="TablaRojaGridTD"><a href="Constancia_Trabajo<?=$NU_IdTipoCTrabajo?>.php?NU_IdCTrabajo=<?=$NU_IdCTrabajo?>"><img src="../../images/bton_ver.gif" width="31" height="31"  alt=""/></a></td>
        </tr>
	<?php
	    }
    ?>          
        </tbody>
      </table>
      </td>
    </tr>
    	<?php
	    }else{ echo '<tr align="center"><td>No se encontraron Constancias de Trabajo.</td></tr>'; }
    ?>
  </table>
</body>
</html>