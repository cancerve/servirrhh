<?php 
session_start();
session_destroy();
?>
<html>
<head>
<title>SS :: Sistema en Linea para los Servicios de RRHH de VENALCASA</title>
<link rel="shortcut icon" href="../../../images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../../../css/estilo.css">
<link rel="stylesheet" href="../../../css/jquery-ui.css" />
<style type="text/css">
body {
	background-color: #F8F8F8;
}
</style>
<script type="text/javascript" src="../../../js/jquery.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui.js"></script>
<script type="text/javascript" src="../../../js/funciones.js"></script>
<script type="text/javascript" src="../../../js/jquery.ui.datepicker-es.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body><tr bordercolor="#FFFFFF" bgcolor="#FFFFFF"><td colspan="5"><tr><td valign="bottom"><tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="2" align="center"><table width="972" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../../../images/head1.jpg" width="347" height="25"  alt=""/></td>
        <td align="right"><img src="../../../images/head2.jpg" width="108" height="25"  alt=""/></td>
      </tr>
    </table></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#FF0000"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td width="75%" height="100" align="right" bgcolor="#ffffff"><table width="966" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100" class="Blanquita" style="font-size:18px" background="../../../images/head3.jpg">&nbsp;</td>
      </tr>
    </table></td>
    <td width="23%" align="center" bgcolor="#079bd0">&nbsp;</td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center" bgcolor="#FF0000"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>
  <tr bgcolor="#ffffff" >
    <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
  </tr>

</table>
    <br>
    <table width="966" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="100%" valign="top" scope="col" style="border:solid 1px #ffffff">
                  
                  
                  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#F8F8F8" bgcolor="#FFFFFF">

  <tr>
    <td valign="top" bordercolor="#000000" width="100%" height="500">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" bgcolor="#CCCCCC" class="Negrita">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CREACIÓN DE USUARIO</td>
    </tr>
  </table>
  <br>
  <div id="tabs" style="width:900; margin-left:10px" align="center">
  <ul>
    <li><a href="#tabs-1" class="Negrita">Datos Generales</a></li>
  </ul>
  
  <div id="tabs-1">
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td bordercolor="#F8F8F8">
        <p>&nbsp;</p>
        <table width="42%" border="0" cellspacing="0" cellpadding="0" style="border-color:#b3b1b2" align="center" bgcolor="#FFFFFF">
          <tr>
            <td><table class="TablaRojaGrid" width="100%">
              <tr class="TablaRojaGridTRTitulo">
                <td>&iexcl;Proceso Culminado con Éxito!</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><p>Felicitaciones se ha registrado satisfactoriamente. A continuación haga clic en el siguiente boton para iniciar sesion con su nueva clave.</p>
                  <p>En caso de haber olvidado su clave, le hemos enviado un mensaje con su  clave de acceso a su correo: <strong><?php echo $_GET['AF_Correo']?></strong></p></td>
              </tr>
              <tr>
                <td style="text-align: justify">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><input name="button2" type="submit" class="BotonRojo" id="button2" value="Iniciar Sesión" onClick="javascript:window.location='../../../../index.php'" /></td>
              </tr>
              <tr>
                <td style="text-align: justify">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
          </td>
      </tr>
</table>
</div>

</div>
                  
                  
                  </td>
                  </tr>
                </table></td>
            </tr>
 </table>
    <br>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#ffffff" >
            <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
  <tr bgcolor="#FF0000" >
    <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>
                <tr bgcolor="#ffffff" >
                  <td height="1" colspan="2" align="center"><img src="../../../images/blank.gif" width="100" height="1"  alt=""/></td>
        </tr>  
    <tr valign="middle">
      <td height="50" colspan="2" align="center" valign="middle" background="../../../images/footer.jpg" class="Blanquita"><p>Venezolana de Alimentos La CASA, S.A. Este sistema fue desarrollado cumpliendo los lineamientos del Decreto N&deg; 3390.</p></td>
    </tr>
  </table>
</body>
</html>