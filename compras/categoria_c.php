
<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$result = mysql_query($sql,$link);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Compra</title>

<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/nhpup_1.1.js"></script>
<script type="text/javascript" language="Javascript" src="xmlhttp_ex2.js">
</script> 

<script language="Javascript" type="text/javascript" src="ajax_p_neto.js"> 
</script>
<script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">


$(document).ready(
	function () {
		$("#sel2").load("makeselect2_c.php?categoria="+$("#selector1").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("makeselect2_c.php?categoria="+$("#selector1").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val());
			}
		);
	}
);
</script>

</head>
<body>


<table>
<tr>
<td>
<div id ="logo">
	<img src="../images/logo_gesdes.jpg" width="319" height="162" /> 
</div>
</td>
<td>
<p class="curved-box-css4">&nbsp;&nbsp;Profesional</p>
<div id="header" class="letratext">
    <!--
    <a href="../index.html">INICIO</a>
    -->
    <br /><a href='javascript:history.back()'>VOLVER</a> <br>
    
</div>

</td>

</tr>

</table>
<?php 

//session_start();	
	
	//$_SESSION["usuario"] = $miUsuario;
	//Iniciar una sesion de PHP
    //Crear una variable para indicar que se ha autenticado
    $_SESSION['autenticado']    = 'SI';
    $nombre=$_SESSION['nombre'];
	$apellido=$_SESSION['apellido'];

?>
<div id="apDiv1" class="letratext"><?=$nombre . " ".$apellido?></div>
<br />
<div id = "detalle" class="rounded" style="width:400">
<form method="get">
Categoria: <select id="selector1" name="categoria" >
<?php
	while ($fila = mysql_fetch_assoc($result)) {
		echo sprintf('<option value="%s">%s</option>',$fila['CATEGORIA_ID'],$fila['CATEGORIA_NOMBRE']);
	}	
?>
</select>
<Input type="hidden"  id="idCliente" value="<?=$idCliente?>">
<Input type="hidden" id="dni" value="<?=$dni?>">
Subcategoria: <span id="sel2"></span>
</form>
</div>
<br />
<div id="resposta" ></div>
<INPUT  type="button" name = "confirmar" id="confirmar" VALUE="ACEPTACIÓN PEDIDO"  style="visibility:hidden" onclick="confirmarcompra()">

</body>
</html>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>