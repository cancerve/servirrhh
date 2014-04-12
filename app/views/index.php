<?php
/*
$path = getcwd();
echo "La ruta absoluta es: ";
echo $path;
die();
*/
?>
<?php 
	require_once('../controller/sessionController.php'); 
	require_once('../model/rolModel.php');
	require_once('../model/usuarioModel.php');
	
	$objRol = new Rol();
	$objUsuario = new Usuario();
	
	if (isset($_POST['rol'])){
		$objUsuario->cambiarRol($objConexion,$_SESSION['NU_IdUsuario'],$_POST['rol']);
	}
	
	$RSUsuario = $objUsuario->buscarUsuario($objConexion,$_SESSION["NU_Cedula"]);
	$cantUsuario = $objConexion->CantidadRegistros($RSUsuario);
	if($cantUsuario>0){
		$rol = $objConexion->obtenerElemento($RSUsuario,0,"rol_NU_IdRol");	
	}
?>
<!DOCTYPE HTML PUBLIC>
<html>
<head>
<title>SS :: Sistema en Linea para los Servicios de RRHH de VENALCASA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link rel="shortcut icon" href="../images/favicon.ico"/>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/maximizar.js"></script>
<script type="text/javascript" src="../js/desconectar.js"></script>

<script type="text/javascript">
    function abrir_dialog() {
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
    };
</script>
</head>
<body>
<div id="dialog" title="Mensaje" style="display:none;">
    <p>En Construccion!!.</p>
</div>
<table width="100%" height="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="2" align="center"><table width="972" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/head1.jpg" width="347" height="25"  alt=""/></td>
        <td align="right"><img src="../images/head2.jpg" width="108" height="25"  alt=""/></td>
        </tr>
    </table></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#FF0000"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td width="75%" height="100" align="right" bgcolor="#ffffff"><table width="966" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100" class="Blanquita" style="font-size:18px" background="../images/head3.jpg">&nbsp;</td>
      </tr>
    </table></td>
    <td width="23%" align="center" bgcolor="#079bd0">&nbsp;</td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#FF0000"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top" bgcolor="#F8F8F8">
    <table width="966" border="0" align="center" cellpadding="0" cellspacing="0" class="Textonegro">
      <tr>
        <td width="541" align="left"><span class="Textonegro">Bienvenido(a), <?php echo $_SESSION['AL_NombreApellido']; ?></span></td>
        <td width="425" align="right" valign="middle" style="vertical-align:middle;">        <?php if ($_SESSION['BI_Admin']==1){ ?>
        <form name="form1" method="post" action="index.php" id="form1">
            Cambiar de Rol:
              <?php 
				$RSRol 		= $objRol->listarRoles($objConexion);
				$cantRSRol 	= $objConexion->CantidadRegistros($RSRol);
			?>
            <select name="rol" id="rol" onchange='javascript:document.form1.submit();'>
				<?php
                if ($cantRSRol>0){
                    for($i=0; $i<$cantRSRol; $i++){	
						$valor = $objConexion->obtenerElemento($RSRol,$i,"NU_IdRol");
						$desc = $objConexion->obtenerElemento($RSRol,$i,"AF_Rol");						
						$selected="";
						if($rol==$valor){
						  $selected="selected='selected'";
						}
						echo "<option value=".$valor." ".$selected.">".$desc."</option>";
                    }
                }
                ?>
            </select>
            <?php } ?> </form>

          
          </td>
      </tr>
    </table></td>
  </tr>
    <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#666666"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top" bgcolor="#FFFFFF">
    
    <table width="963" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#EFEFEF">
      <tr>
        <td height="25"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2"><img src="../images/blank.gif" width="1" height="1"></td>
          </tr>
          <tr>
            <td colspan="2"><?php switch($rol){
             
			 case '1':
		  ?>
              <table width="878" border="0" align="center" cellpadding="1" cellspacing="5" class="Textonegro">
                <tr>
                  <td width="90" align="center"><a href="centralView.php" target="central">
                      <img src="../images/bton_Inicio.png" width="46" height="46"  alt=""/><br>
                      Inicio<br>
                      <br></a>
                 </td>
                  <td width="90" align="center"><a href="ctrabajo/index.php" target="central"><img src="../images/bton_CTrabajo.png" width="46" height="46"  alt=""/><br>Constancia<br>
                    de Trabajo</a></td>
                  <td width="90" align="center"><a href="#" onClick="abrir_dialog()"><img src="../images/bton_reciboPago.png" width="46" height="47"  alt=""/><br>
                    Recibo<br>de Pago</a></td>
                  <td width="90" align="center"><a href="egreso/index.php" target="central" onClick="abrir_dialog()"><img src="../images/bton_CEgreso.png" width="46" height="46"  alt=""/><br>
                    Constancia<br>
                    de Egreso
                  </a></td>
                  <td width="90" align="center"><a href="#" onClick="abrir_dialog()"><img src="../images/bton_BANAVIH.png" width="46" height="46"  alt=""/><br>
                    Constancia<br>
                    de BANAVIH</a></td>
                  <td width="90" align="center"><a href="#" onClick="abrir_dialog()"><img src="../images/bton_Vacaciones.png" width="46" height="47"  alt=""/><br>
                    Solicitud de<br>
                    Vacaciones</a></td>
                  <td width="90" align="center"><a href="#" onClick="abrir_dialog()"><img src="../images/bton_Fideicomiso.png" width="46" height="46"  alt=""/><br>
                    Consulta<br>
                    Fideicomiso</a></td>
                  <td width="90" align="center"><a href="#" onClick="abrir_dialog()"><img src="../images/Bton_Clave.png" alt="Cambiar Clave" width="46" height="46" border="0"><br>
                    Perfil<br>
                    Usuario </a></td>
                  <td width="90" align="center"><a href="salirView.php"><img src="../images/Bton_Salir.png" alt="Salir del Sistema" width="46" height="46" border="0"><br>
                    Salir del<br>
                    Sistema</a></td>
                </tr>
              </table>
              <?php break;
			 case '3':
		  ?>
              <table width="490" border="0" align="center" cellpadding="1" cellspacing="5">
                <tr>
                  <td width="90" align="center" class="BotonGris"><a href="centralView.php" target="central"><img src="../images/inicio.jpg" width="51" height="51"><br>
&nbsp;Inicio<br>
&nbsp; </a></td>
                  <td width="90" height="20" align="center" class="BotonGris"><a href="apertura_mercado/index.php" target="central"><img src="../images/mercado.jpg" width="51" height="51"><br>
                    Apertura<br>
                    Mercado </a></td>
                  <td width="90" align="center" class="BotonGris"><p><a href="#" onClick="abrir_dialog()"><img src="../images/config.jpg" width="51" height="51"  alt=""/><br>
                    Parámetros<br>
                    del Sistema</a></p></td>
                  <td width="90" align="center" class="BotonGris"><a href="#" onClick="abrir_dialog()"><img src="../images/clave.jpg" alt="Cambiar Clave" width="51" height="51" border="0"><br>
                    Perfil<br>
                    Usuario </a></td>
                  <td width="90" align="center" class="BotonGris"><a href="salirView.php"><img src="../images/salir.jpg" alt="Salir del Sistema" width="51" height="51" border="0"><br>
                    Salir del<br>
                    Sistema</a></td>
                </tr>
              </table>
              <?php break;
			 case '2':
		  ?>
              <table width="600" border="0" align="center" cellpadding="1" cellspacing="5">
                <tr>
                  <td width="120" align="center" class="BotonGris"><a href="centralView.php" target="central"><img src="../images/inicio.jpg" width="51" height="51"><br>
&nbsp;Inicio<br>
&nbsp; </a></td>
                  <td width="120" height="20" align="center" class="BotonGris"><a href="verificar_compra/index.php" target="central"> <img src="../images/verificar.jpg" width="51" height="51"><br>
                    Verificar<br>
                    Compras <br>
                  </a></td>
                  <td width="120" align="center" class="BotonGris"><a href="#" onClick="abrir_dialog()"><img src="../images/nota_credito.jpg" width="52" height="51"><br>
                    Notas de<br>
                    Crédito
                    &nbsp; </a></td>
                  <td width="120" align="center" class="BotonGris"><a href="consulta/index.php" target="central"><img src="../images/consulta.jpg" width="51" height="51"><br>
                    Consultas<br>
                    &nbsp; </a></td>
                  
                  <td width="120" align="center" class="BotonGris"><a href="#" onClick="abrir_dialog()"><img src="../images/clave.jpg" alt="Cambiar Clave" width="51" height="51" border="0"><br>
                    Perfil<br>
                    Usuario </a></td>
                  <td width="120" align="center" class="BotonGris"><a href="salirView.php"><img src="../images/salir.jpg" alt="Salir del Sistema" width="51" height="51" border="0"><br>
                    Salir del<br>
                    Sistema</a></td>
                </tr>
              </table>
              <?php break;
		  }
		  ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
    </td>
  </tr>
      <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#666666"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#F8F8F8">
      <table width="100%" border="0" cellpadding="8" cellspacing="8">
        <tr>
          <th valign="top" scope="col"><iframe src="centralView.php?mensaje=<?=$_GET['mensaje']?>" name="central" width="963" height="540" vspace="0" scrolling="yes" frameborder="1" style="border:solid 1px #666666"></iframe>        </th>
        </tr>
      </table>
    </td>
  </tr>
          <tr bgcolor="#ffffff" >
            <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
  <tr bgcolor="#FF0000" >
    <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
                <tr bgcolor="#ffffff" >
                  <td height="1" colspan="2" align="center"><img src="../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
        <tr valign="middle">
          <td height="50" colspan="2" align="center" valign="middle" background="../images/footer.jpg" class="Blanquita"><p>Venezolana de Alimentos La Casa, VENALCASA S.A. Este sistema fue desarrollado cumpliendo los lineamientos del Decreto N&deg; 3390.</p>
          </td>
        </tr>
</table>

</body>
</html>