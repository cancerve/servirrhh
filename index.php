<html>
<link rel="stylesheet" type="text/css" href="app/css/estilo.css">
<link rel="shortcut icon" href="app/images/favicon.ico"/>
<style type="text/css">

body {
	background-color: #FFFFFF;
}


</style>

<head>
<title>SS :: Sistema en Linea para los Servicios de RRHH de VENALCASA</title>
<meta http-equiv="" content="text/html; charset=utf-8">
<link rel="stylesheet" href="app/css/jquery-ui.css" />

<script type="text/javascript" src="app/js/jquery.js"></script>
<script type="text/javascript" src="app/js/jquery-ui.js"></script>
<script type="text/javascript" src="app/js/jquery.validate.js"></script>
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
<style text="text/css">
     <style text="text/css">

    
div{
   height:300px;
   width: 435px;
   background:url(app/images/LOGO_SRRHH.png) 0 0 no-repeat;
   background-origin: content-box;
   border: 5px solid #777;
   padding: 15px;
}
    

</style>


</head>

<body onLoad="abrir_dialog();">
<div id="dialog" title="Mensaje" style="display:none;">
    <span class="ui-icon ui-icon-circle-check"></span>
    <p><?php if (isset($_GET['mensaje'])){ echo $_GET['mensaje']; } ?></p>
</div>

<table width="100%" height="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="3"><table width="966" border="0" align="center" cellpadding="2" cellspacing="0">
      <tr>
        <td><img src="app/images/head1.jpg" width="347" height="25"  alt=""/></td>
        <td align="right"><img src="app/images/head2.jpg" width="108" height="25"  alt=""/></td>
        </tr>
    </table></td>
  </tr>
          <tr bgcolor="#ffffff" >
            <td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
  		<tr bgcolor="#ff141f" >
    		<td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
        <tr bgcolor="#ffffff" >
            <td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>  
  <tr>
    <td height="100" align="right">&nbsp;</td>
    <td width="38%" align="right"><table width="966" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100" align="center" class="Blanquita" style="font-size:18px"><img src="app/images/head3.jpg" width="972" height="100"  alt=""/></td>
      </tr>
    </table></td>
    <td align="center" bgcolor="#079bd0">&nbsp;</td>
  </tr>
          <tr bgcolor="#ffffff" >
            <td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
  		<tr bgcolor="#ff141f" >
    		<td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
        <tr bgcolor="#ffffff" >
            <td height="1" colspan="3" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>   
  <tr>
    <td colspan="3" valign="bottom" bgcolor="#f8f8f8">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <table width="966" border="0" align="center" cellpadding="8" cellspacing="8">
              <tr>
                <th width="329" scope="col" valign="top">
                  <form name="form1" id="form1" method="POST" action="app/controller/autenticarController.php">
                       <table width="100%" border="1" align="right" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF" class="TablaRojaGrid">
                        <tr class="TablaRojaGrid">
                        	<th scope="col" class="TablaRojaGridTRTitulo">Iniciar Sesi&oacute;n</th>
                        </tr>                      

                        <tr>
                          <td style="border-color:#FFF; border:none"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="Negrita">
                            <tr>
                              <td colspan="2" align="center"><p>&nbsp;</p>
                              <p>&nbsp;</p></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center">Si ya esta registrado, llene el siguiente formulario para entrar al sistema.</td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="9%"><img src="app/images/blank.gif" width="17" height="5"  alt=""/></td>
                              <td width="91%">N&uacute;mero de C&eacute;dula: <br>
                                <input name="NU_Cedula" type="text" required id="NU_Cedula" style="height:25px; width:200px; font-size:12" size="15"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>Clave:<br>
                                <input name="AF_Clave" type="password" required id="AF_Clave" style="height:25px; width:200px; font-size:12" title="CLAVE SENSIBLE A MAYÚSCULAS Y MINÚSCULAS" size="15""></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>C&oacute;digo:<br>
                                <img src="app/includes/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" style="border:solid 1px #079bd0"></td>
                            </tr>
                            <tr bordercolor="#F8F8F8">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>Escribir C&oacute;digo:<br>
                                <input name="code" type="text" required id="code" style="height:25px; width:200px; font-size:12" size="15"" /></td>
                            </tr>
                            <tr>
                              <td align="center" bordercolor="#F8F8F8">&nbsp;</td>
                              <td align="center" bordercolor="#F8F8F8">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center" bordercolor="#F8F8F8"><input id="submit" name="submit" type="submit" class="BotonRojo" value="Entrar"></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center" bordercolor="#F8F8F8"><p><img src="app/images/blank.gif" width="20" height="46"  alt=""/></p></td>
                            </tr>
                          </table></td>
                        </tr>

                      </table>
                    
                  </form>
                </th>
                <th width="581" scope="col" valign="top"><table width="100%" class="TablaRojaGrid">
                        <tr class="TablaRojaGrid">
                        	<th scope="col" class="TablaRojaGridTRTitulo">Servicios Disponibles</th>
                        </tr> 
                  <tr>
                    <td class="Textonegro" align="justify">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="Textonegro" align="justify"><div align="justify" style="margin-left:12; margin-right:12">
                      <div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td><img src="app/images/bton_CTrabajo.jpg" width="179" height="60"  alt=""/></td>
                            <td>&nbsp;</td>
                            <td><img src="app/images/bton_reciboPago.jpg" width="179" height="60"  alt=""/></td>
                            <td>&nbsp;</td>
                            <td><img src="app/images/bton_CEgreso.jpg" width="179" height="60"  alt=""/></td>
                          </tr>
                          </table>
                        <br>
                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td><img src="app/images/bton_BANAVIH.jpg" width="179" height="60"  alt=""/></td>
                            <td>&nbsp;</td>
                            <td><img src="app/images/bton_Vacaciones.jpg" width="179" height="60"  alt=""/></td>
                            <td>&nbsp;</td>
                            <td><img src="app/images/bton_Fideicomiso.jpg" width="179" height="60"  alt=""/></td>
                          </tr>
                        </table>
                      </div>
                    </div></td>
                  </tr>
                  <tr>
                    <td class="Textonegro" align="justify" height="5px">&nbsp;</td>
                  </tr>
                </table>
                  <br>
                  <table width="100%" class="TablaRojaGrid">
                    <tr>
                      <td class="Textonegro" align="justify"><div align="justify" style="margin-left:12; margin-right:12">
                        <div>
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="Negrita">
                            <tr>
                              <td colspan="5" align="center">&nbsp;</td>
                              </tr>
                            <tr>
                              <td align="center">Si ingresa por primera vez, haga clic en el siguiente bot&oacute;n.</td>
                              <td rowspan="3" align="center"><img src="app/images/blank.gif" width="15" height="10"  alt=""/></td>
                              <td rowspan="3" align="center" bgcolor="#079bd0"><img src="app/images/blank.gif" width="1" height="10"  alt=""/></td>
                              <td rowspan="3" align="center"><img src="app/images/blank.gif" width="15" height="10"  alt=""/></td>
                              <td align="center">Si ha olvidado su clave, haga clic en el siguiente bot&oacute;n.</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><input id="button4" name="button5" type="button" class="BotonRojo" value="Registrese"  onClick="javascript:window.location='app/views/usuario/crear/index.php'"></td>
                              <td align="center"><input id="button2" name="button2" type="button" class="BotonRojo" value="Recuperar"  onClick="javascript:window.location='app/views/usuario/recuperacion/index.php'"></td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center" bgcolor="#079bd0"><img src="app/images/blank.gif" width="20" height="1"  alt=""/></td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="50%" align="center">Para cualquier sugerencia, duda o problema haga clic en el siguiente bot&oacute;n.</td>
                              <td width="5" rowspan="3" align="center"><img src="app/images/blank.gif" width="15" height="10"  alt=""/></td>
                              <td rowspan="3" align="center" bgcolor="#079bd0"><img src="app/images/blank.gif" width="1" height="10"  alt=""/></td>
                              <td width="5" rowspan="3" align="center"><img src="app/images/blank.gif" width="15" height="10"  alt=""/></td>
                              <td width="50%" align="center">Si desea verificar una constancia de Trabajo, haga clic en el siguiente bot&oacute;n.</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><input id="button" name="button" type="button" class="BotonRojo" value="Atender Solicitud"  onClick="javascript:window.location='app/views/usuario/novedad/index.php'"></td>
                              <td align="center"><input id="button3" name="button3" type="button" class="BotonRojo" value="Verificar Constancia"  onClick="javascript:window.location='index.php?mensaje=En Construccion'"></td>
                            </tr>
                            <tr>
                              <td colspan="5" align="center">&nbsp;</td>
                            </tr>
                          </table>
                        </div>
                      </div></td>
                    </tr>
                </table></th>
              </tr>
            </table>
          </td>
        </tr>
                  <tr bgcolor="#ffffff" >
            <td height="1" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
  <tr bgcolor="#FF0000" >
    <td height="1" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
                <tr bgcolor="#ffffff" >
                  <td height="1" align="center"><img src="app/images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
        <tr>
          <td height="92" align="center" class="TextonegroPEQ" background="app/images/footer.jpg"><img src="app/images/footer.png" width="550" height="92"  alt=""/></td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</body>
</html>