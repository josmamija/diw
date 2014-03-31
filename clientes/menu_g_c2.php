<?php session_start();?>
<!doctype html>
<html class="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profesionales</title>
<link href="../boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluitgesdesc.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
<script src="../respond.min.js"></script>
<script type="text/javascript">
	function mostraracceso() {
		//document.getElementById("acceso").style.visibility ='visible';
		document.getElementById("acceso").style.display="block";
	}
	function ocultar() {
		//document.getElementById("acceso").style.visibility ='hidden';
		document.getElementById("acceso").style.display="none";
	}
</script>
</head>
<body>
<?php
/*
if(isset($_GET['ver'])){$visible='visible';}
else{$visible='hidden';}
*/
if(isset($_GET['ver'])){$visible='block';}
else{$visible='none';}
?>
<div class="gridContainer clearfix">
<div id="header">
	<p><img src="../images/logo_gesdesc_n.jpg" width="400" height="140" /></p>
</div>
<div id="menu" class="letramenu">
	<p class="curved-box-css4">&nbsp;&nbsp;Profesional</p>
	<ol>
    	<li><a href="../clientes/menu_g_c2.php?go=0">INICIO</a></li>
        <li><a href="#" onclick="mostraracceso()"><span>ACCESO</span></a></li>
    	<li><a href="../clientes/menu_g_c2.php?go=1">REGISTRARSE</a></li>
        <li><a href="../clientes/menu_g_c2.php?go=2">CONDICIONES DE USO</a></li>
        <li><a href="mailto:gestion@gesdesc.com">CONTACTO</a></li>
    </ol>
    <div class="rounded" id ="acceso" style='display:<?=$visible?>;'>
    	<?php include "accesoCliente2_recordar.php" ?>
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
   		include("../clientes/bienvenida_clie.php");
		break;
	case 1:
 		//include("../clientes/alta2.php");
		echo "<p>El uso del servicio de compras es totalmente gratuito, requiere confirmación de las condiciones de uso de gesdesc
<a href='../clientes/menu_g_c2.php?go=5' >condiciones</a></p>";
		break;
	case 2:
   		include("../clientes/cond_uso.php");
		break;
	case 3:
	    $desde=$_GET['desde'];
   		include("../includes/recordar2.php");
		break;	
	case 4:
	    if(isset($_POST['aceptacion']))	include("../clientes/alta2.php");
		else include("../clientes/cond_uso2.php");
		break;
	case 5:
   		include("../clientes/cond_uso2.php");
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
