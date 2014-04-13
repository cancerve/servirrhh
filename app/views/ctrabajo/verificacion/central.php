<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>SS :: Sistema en Linea para los Servicios de RRHH de VENALCASA</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../../../css/estilo.css" >
<link rel="shortcut icon" href="../../../images/favicon.ico"/>
<link rel="stylesheet" href="../../../css/jquery-ui.css" />
<script type="text/javascript" src="../../../js/jquery.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui.js"></script>
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
    <span class="ui-icon ui-icon-circle-check"></span>
    <p><?php if (isset($_GET['mensaje'])){ echo $_GET['mensaje']; } ?></p>
</div>
<p>&nbsp;</p>
</body>
</html>
