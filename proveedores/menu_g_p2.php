<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Proveedores</title>
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
	<p class="curved-box-css4">&nbsp;&nbsp;Proveedor</p>
	<ol>
    	<li><a href="../proveedores/menu_g_p2.php?go=0">INICIO</a></li>
        <li><a href="#" onClick="mostraracceso()">ACCESO</a></li>
    	<li><a href="../proveedores/menu_g_p2.php?go=1">REGISTRARSE</a></li>
        <li><a href="../proveedores/menu_g_p2.php?go=7">CONDICIONES REGISTRO</a></li>
        <li><a href="mailto:gestion@gesdesc.com">CONTACTO</a></li>
    </ol>
    <div class="rounded" id ="acceso" style='display:<?=$visible?>;'>
    	<?php include "accesoProveedor.php" ?>
    </div>    
</div>

<div id = "cuerpo"  align="left">
	<?php
    if (!isset($_GET['go'])) $opcion = 0;
    else $opcion=$_GET['go'];
    //echo $_GET['go'];
    //echo $opcion;
    
    switch ($opcion)
    {
        case 0:
            include("../proveedores/bienvenida_prov.php");
            break;
        case 1:
            echo "<p>El uso del servicio de ventas requiere la aceptación del contrato <b>gesdesc.</b>
<a href='../proveedores/menu_g_p2.php?go=5' >Leer contrato</a></p>";
            break;
		case 3:
	    	$desde=$_GET['desde'];
   			include("../includes/recordar2.php");
			break;
			
		case 2:
	    	$emailb=$_GET['emailb'];
   			include("../proveedores/datosbanco.php");
			break;	
		case 4:
			if(isset($_POST['aceptacion']))	include("../proveedores/alta_prov.php");
			else include("../proveedores/instruc_reg_prov.php");
			break;	
		case 5:
   			include("../proveedores/instruc_reg_prov2.php");
			break;			
        case 7:
            include("../proveedores/instruc_reg_prov.php");
            break;	
        default:
            include('../proveedores/bienvenida_prov.php');
    }
    ?>
    
<br>
 	<div style="background-color:#666">
	  <span style="color:#FFF">gesdesc.com &copy; Politica de privacidad</span>
   	</div>
</div>
</div>
</body>
</html>