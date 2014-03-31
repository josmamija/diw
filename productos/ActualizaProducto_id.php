<?php
header("Content-type: text/html; charset=utf-8"); 
include ("../Funciones/funciones.php"); 
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_set_charset('utf8');
$strSQL = "SELECT * FROM PRODUCTO";
$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
$modificado =1;
while($fila=mysql_fetch_array($resultat)){
	
	$miNIF=$fila['NIF'];
	$strSQL = "update PRODUCTO set PRODUCTO_ID =" . "'" . $modificado . "'";
	$strSQL .= " where NIF = '".$miNIF."' and ID_FABRICA = '".$fila['ID_FABRICA']."'" ; 
	$resultat2 = mysql_query($strSQL, $enllac);
	if (!$resultat2)  die('Error: ' . mysql_error());
  	$modificado+=1	;
}

mysql_close($enllac);
echo "<br>Se ha actualizado la tabla de productos modificados<br>"; 
?> 
