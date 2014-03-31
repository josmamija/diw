<?php session_start();?>
<!doctype html>
<html class="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profesionales</title>
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluitgesdesc.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
<script src="respond.min.js"></script>
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
if(isset($_GET['ver'])){$visible='visible';}
else{$visible='hidden';}
?>
<div class="gridContainer clearfix">
<div id="header">
	<p><img src="../images/logo_gesdes.jpg" width="319" height="162" /></p>
</div>
<div id="menu" class="letramenu">
	<p class="curved-box-css4">&nbsp;&nbsp;Profesional</p>
	<ol>
    	<li><a href="../clientes/menu_g_c3.php?go=0">INICIO</a></li>
        <li><a href="#" onclick="mostraracceso()"><span>ACCESO</span></a></li>
    	<li><a href="../clientes/menu_g_c3.php?go=1">REGISTRARSE</a></li>
        <li><a href="../clientes/menu_g_c3.php?go=2">CONDICIONES DE USO</a></li>
        <li><a href="mailto:gestion@gesdesc.com">CONTACTO</a></li>
    </ol>
    <div class="rounded" id ="acceso" style='visibility:<?=$visible?>;'>
    	<?php include "accesoCliente3.php" ?>
    </div>    
</div>
<div id="cuerpo">
<?php
if (!isset($_GET['go'])) $opcion = 0;
else $opcion=$_GET['go'];
//echo $_GET['go'];
//echo $opcion;

switch ($opcion)
{
	case 0:
   		include("../clientes/intro_clie.php");
		break;
	case 1:
 		include("../clientes/alta3.php");
		break;
	case 2:
   		include("../clientes/cond_uso.php");
		break;
	default:
 		include('../clientes/intro_clie.php');
}
 ?>
    <div style="background-color:#666">
		<span style="color:#FFF">gesdesc.com &copy; Politica de privacidad</span>
	</div>
</div>
</div>
</body>
</html>
