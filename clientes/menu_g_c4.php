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
        	<a href="../clientes/menu_g_c4.php?go=4"><strong><em>CONDICIONES DE USO</em></strong></a>
        </li>
         <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
         <li>
        	<a href="../clientes/menu_g_c3.php"><strong><em>LOGIN</em></strong></a>
        </li>
    </ul> 
	<?php
    if (!isset($_GET['go'])) $opcion = 0;
    else $opcion=$_GET['go'];
    switch ($opcion)
    {
        case 0:
            include("../clientes/proc_reg_clie.php");
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
</div>
</div>
</body>
</html>