<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
include ("../Conexiones/conexion_local.php"); 
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
$consulta = "select * from CLIENTE";
$resultat = mysql_query($consulta, $enllac);
if (!$resultat) die('Error: ' . mysql_error());
else {
?>
<HTML>
<HEAD><TITLE>Listado clientes</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" /> 
</HEAD>
<BODY>
<?php
	echo "<span class='cabecera'> Listado de profesionales</span>";
	$sCadena= "<TABLE border='1' class='rounded'>";
 	$sCadena=$sCadena . "<TR class='curved-box-css3'><TD class='Estilo1'>&nbsp;Nombre</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Apellido1&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Apellido2&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;DNI&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Telefono&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Movil&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Email&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Usuario&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Pwd&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Direccion&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Localidad&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;CP&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Provincia&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Pais&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Activo&nbsp;</TD></TR>";
	echo $sCadena;
    while($fila=mysql_fetch_array($resultat)){
		$dni=$fila["DNI"];
		if($fila["ACTIVO"]==0) {
			$ico = "<img src='../images/no_activado.GIF' width='15 height='15' />";
			$tip ="Activar";
		}else{
			 $ico = "<img src='../images/activado.GIF' width='15' height='15' />";
			 $tip="Desactivar";
		}
   		$sCadena= "<tr><td class='Estilo1'>&nbsp;" . $fila["NOMBRE"] . "</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["APELLIDO1"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["APELLIDO2"] . "&nbsp;</td>";
		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["DNI"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["TELEFONO"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["MOVIL"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["EMAIL"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["USUARIO"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PWD"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["DIRECCION"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["LOCALIDAD"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["CP"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PROVINCIA"] . "&nbsp;</td>";
		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PAIS"] . "&nbsp;</td>";
		$sCadena.= "<td title='$tip'> <a href='../administracion/validacion_clie.php?dni=$dni&accion=$tip'>".$ico."</a></td></tr>";
   		echo $sCadena;
 	}			
	echo "</table>";
	}
}else{ // autorizacion
	//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
	//pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../administracion/login_admin.php> Login</a>";
}
?>
<a href='javascript:history.back()'>Volver</a> 
</BODY>
</HTML>	

