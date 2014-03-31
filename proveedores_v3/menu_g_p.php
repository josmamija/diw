<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Proveedores</title>
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
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

<table>
<tr>
<td>
  	<div id ="logo">
		<img src="../images/logo_gesdes.jpg" width="319" height="162" /> 
	</div>
</td>
<td>
    <p class="curved-box-css4">&nbsp;&nbsp;Proveedor</p>
    <div id="header" class="letratext">
        <br /><a href="../proveedores/menu_g_p.php?go=0">01.&nbsp;&nbsp;INICIO</a>
        <br /><a href="#" onClick="mostraracceso()">02.&nbsp;&nbsp;ACCESO</a>
        <br /><a href="../proveedores/menu_g_p.php?go=1">03.&nbsp;&nbsp;REGISTRARSE</a>
        <br /> <a href="mailto:gestion@gesdesc.com">04.&nbsp;&nbsp;CONTACTO</a>
        <br /><a href="../proveedores/menu_g_p.php?go=7">05.&nbsp;&nbsp;CONDICIONES REGISTRO</a>
    </div>
</td>
<td colspan="2" align="right">
    <div class="rounded" id ="acceso" style='visibility:<?=$visible?>;'>
         <?php include "accesoProveedor.php" ?>
    </div>
</td>
</tr>
</table>
<div id = "detalle"  align="left" class="letratext">
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
            include("alta_prov.php");
            break;
        case 7:
            include("../proveedores/instruc_reg_prov.php");
            break;	
        default:
            include('../proveedores/bienvenida_prov.php');
    }
    ?>
</div>
<div style="background-color:#666"><span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span></div>


</body>
</html>