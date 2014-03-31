<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta charset="utf-8">
	<title>GESDESC</title>
    
	<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
    <style>
		#apDiv2 {
		position: absolute;
		width: 680px;
		height: 540px;
		z-index: 1;
		left: 4px;
		top: 27px;
		}
	</style>
</head>
<body>
<div id="apDiv2">
    <table>
    <tr>
    <td>
        <div id ="logo" align="center"  style="width:600">
        <img src="../images/logo_gesdesc_n.jpg" width="400" height="150" /> 
        </div>
    </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
       <!--<div id="header" class="rounded"  style="font-size:16px; background-color: #AC0 ">
       <a href="proveedores/menu_g_p2.php" style=" color:#333">&nbsp;&nbsp;PROVEEDOR&nbsp;&nbsp;</a>
       <br /> <a href="clientes/menu_g_c2.php" style=" color:#333" >&nbsp;&nbsp;PROFESIONAL&nbsp;&nbsp;</a> </div>
       -->
       <a href="#">
   		<img src="../images/video.PNG" width="100" height="180" alt="productos y servicios" />
   		</a> 
    </td>
    </tr>
    </table>
  <div id = "cuerpo"  align="left" class="letratext">
  	<ul id="llista_imatges" class="rounded" style="background-color: #333;color: #CF9">
		<li><a href="../index.html"><strong><em>INICIO</em></strong></a></li>
       	<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><a href="mailto:gestion@gesdesc.com"><strong><em>CONTACTO</em></strong></a></li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li>
        	<a href="../proveedores/menu_g_p4.php?go=5"><strong><em>CONDICIONES DE USO</em></strong></a>
        </li>
         <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
         <li>
        	<a href="../proveedores/menu_g_p3.php"><strong><em>LOGIN</em></strong></a>
        </li>
    </ul> 
	<?php
    if (!isset($_GET['go'])) $opcion = 0;
    else $opcion=$_GET['go'];
    switch ($opcion)
    {
        case 0:
            include("../proveedores/proc_reg_prov.php");
            break;
		/*	
        case 1:
            echo "<p>El uso del servicio de ventas requiere la aceptación del contrato <b>gesdesc.</b>
<a href='../proveedores/menu_g_p2.php?go=5' >Leer contrato</a></p>";
            break;
		*/	
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
</div>
</div>
</body>
</html>