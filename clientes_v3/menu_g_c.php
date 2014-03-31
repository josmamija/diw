<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GESDESC</title>
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function mostraracceso() {
	document.getElementById("acceso").style.visibility ='visible';
	}
	function ocultar() {
		document.getElementById("acceso").style.visibility ='hidden';
	}
</script>
</head>
<body>
<?php
if(isset($_GET['ver'])){
		$visible='visible';
}else{
		$visible='hidden';
		//$visible='visible';
}
?>
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
    <a href="../index.html">01.&nbsp;&nbsp;INICIO</a>
    -->
    <br /><a href="#" onclick="mostraracceso()">01.&nbsp;&nbsp;ACCESO</a>
    <br /><a href="../clientes/alta.php">02.&nbsp;&nbsp;REGISTRARSE</a>
    
</div>
<td colspan="2" align="right">
<div class="rounded" id ="acceso" style='visibility:<?=$visible?>;'> <?php include "accesoCliente.php" ?>
</div>
</td>
</td>

</tr>

</table>

<!--
<img src="images/portada.JPG" width="746" height="334" /></div>
-->
<?php include("bienvenida_clie.php") ?>

<div style="background-color:#666">
<span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span>
</div>


</body>
</html>