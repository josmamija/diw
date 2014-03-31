<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<title>Profesional</title>
</head>
<?php
	if(!isset($_GET['dni'])){
		//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    	//pantalla de login, enviando un codigo de error
		echo "NO esta autenticado";
		//exit();
	 	echo "<script language='javascript'>window.location='../clientes/menu_g_c.php'</script>;"; 
        //header("Location:../clientes/menu_g_c.php");
	}
	//session_start();	
	$dni = $_GET['dni'];
	$idCliente = $_GET['idCliente'];
	$nombre=$_GET['nombre'];
	$apellido =$_GET['apellido'];
	//$_SESSION["usuario"] = $miUsuario;
	//Iniciar una sesion de PHP
    //Crear una variable para indicar que se ha autenticado
    $_SESSION['autenticado']    = 'SI';
    $_SESSION['nombre']=$nombre;
	$_SESSION['apellido']=$apellido;
	//echo " DNI : " . $dni ;
	//echo " <BR> USUARIO : " . $usuario ;
 ?>
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
   <BR /> <a href="../compras/alta_c_cat.php?dni=<?=$dni?>&idCliente=<?=$idCliente?>">LISTADO DE PRECIOS</a>   
    <br /><a href="modificar.php?dni=<?=$dni?>">EDITAR PERFIL</a>    
    <br /><a href="menu_g_c.php">SALIR SESION</a>
    
</div>

</td>

</tr>

</table>
<div id="apDiv1" class="letratext"><?=$nombre . " ".$apellido?></div>
<div id = "detalle">
<img  src="../images/man_prof.GIF" />
<!--
<img src="images/portada.JPG" width="746" height="334" /></div>

<p class="letranegrita">FUNCIONALIDAD PARA EL PROFESSIONAL</p>
<p class="letratext"><span class="letranegrita">gesdesc </span>transforma toda compra individual en una compra al por mayor, abaratando el precio final del articuloa obteniendo un mayor descuento.
<br />
<br />
La aplicacion reparte entre los compradores el código de compra dándole derecho a su corrrespondiente descuento, no influyendo en los tratos financieros entre comprador y vendedor.
<br />
<br />
El profesional dispone de varios usos:
<br /><span class="letranegrita"> catálogos; </span> donde se visualizan PVP + descuento 1 ud., datos tecnicos del articulo y proveedores  que disponen de dicho articulo seleccionado. 
<br /><span class="letranegrita"> enlaces de interés </span> 
<br />
-->
</div>
<div style="background-color:#666"><span style="color:#FFF">gesdesc.com &copy; Politica de privacidad  93 831 03 01</span></div>


</body>
</html>