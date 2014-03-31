<HTML>
<HEAD><TITLE>Listado proveedores</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" /> 
</HEAD>
<BODY>
<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {

include ("../Conexiones/conexion_local.php"); 
/*
$usuari ='fgarcia';
$contrasenya ='fgarcia';
$servidor ='localhost';
$baseDatos ='gesdesc';
*/
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_set_charset('utf8');
// COMPROBAR QUE EL SOCIO NO TENGA MAS DE 3 PRESTECS 
$consulta = "select * from PROVEEDOR";
$resultat = mysql_query($consulta, $enllac);

if (!$resultat) die('Error: ' . mysql_error());
else {
	echo "<span class='cabecera'> Listado de PROVEEDORES</span>";
	$sCadena= "<TABLE border='1' class='rounded'>";
 	$sCadena=$sCadena . "<TR class='curved-box-css3'><TD class='Estilo1'>&nbsp;Nombre</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;NIF&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Telefono&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Movil&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Email&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Usuario&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Pwd&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Direccion&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Localidad&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;SECTOR&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Provincia&nbsp;</TD>";
	//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Pais&nbsp;</TD>";
	$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Activo&nbsp;</TD>";
	$sCadena.= "<TD class='Estilo1'>Eliminar</TD></tr>";
	echo $sCadena;
	$ico_del = "<img src='../images/cancel.GIF' width='15 height='15' />";
    while($fila=mysql_fetch_array($resultat)){
		$nif=$fila["NIF"];
		$idProveedor= $fila["ID_PROVEEDOR"];
		if($fila["ACTIVO"]==0) {
			$ico = "<img src='../images/no_activado.GIF' width='15 height='15' />";
			$tip ="Activar";
		}else{
			 $ico = "<img src='../images/activado.GIF' width='15' height='15' />";
			 $tip="Desactivar";
		}
   		$sCadena= "<tr><td class='Estilo1'>&nbsp;" . $fila["NOMBRE"] . "</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["NIF"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["TELEFONO"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["MOVIL"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["EMAIL"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["USUARIO"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PWD"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["DIRECCION"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["LOCALIDAD"] . "&nbsp;</td>";
   		$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["SECTOR"] . "&nbsp;</td>";
   		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PROVINCIA"] . "&nbsp;</td>";
		//$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["PAIS"] . "&nbsp;</td>";
		$sCadena.= "<td title='$tip'> <a href='../administracion/validacion_prov.php?nif=$nif&accion=$tip'>".$ico."</a></td>";
   		$sCadena.= "<td> <a href='../proveedores/procesarDatos_p.php?idProveedor=$idProveedor' onclick=\"return confirm('¿Está seguro de borrar este proveedor?');\">" . $ico_del . "</a></td>";
   		echo $sCadena . "</tr>";
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

