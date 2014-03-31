<?php
header("Content-type: text/html; charset=utf-8"); 
include ("../Funciones/funciones.php"); 
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_set_charset('utf8');
$strSQL = "SELECT * FROM PRODUCTO_TMP";
$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
while($fila=mysql_fetch_array($resultat)){
	$modificado =1;
	$miNIF=$fila['NIF'];
	$strSQL = "update PRODUCTO set ID_FABRICA =" . "'" . $fila["ID_FABRICA"] . "',";
	$strSQL = $strSQL . "COD_ALMACEN = " . "'" . $fila["COD_ALMACEN"] . "',";
	$strSQL = $strSQL . "COD_PRODUCTO = " . "'" . $fila["COD_PRODUCTO"] . "',";  
	$strSQL = $strSQL . "CATEGORIA_ID = " . "'" . $fila["CATEGORIA_ID"] . "',";
	$strSQL = $strSQL . "SUBCAT_ID = " . "'" . $fila["SUBCAT_ID"] . "',";
	$strSQL = $strSQL . "MARCA = " . "'" . $fila["MARCA"] . "',";
	$strSQL = $strSQL . "DESCRIPCION = " . "'" . trim($fila["DESCRIPCION"]) . "',";
	$strSQL = $strSQL . "LINK = " . "'" . $fila["LINK"] . "',";			
	$strSQL = $strSQL . "PVP = " . "'" . $fila["PVP"] . "',";
	$strSQL = $strSQL . "MAX_U_DES = " . "'" . $fila["MAX_U_DES"] . "',";
	$strSQL = $strSQL . "DESCUENTO = " . "'" . $fila["DESCUENTO"] . "',";
	$strSQL = $strSQL . "P_NETO_1 = " . "'" . $fila['P_NETO_1']. "',";
	$strSQL = $strSQL . "P_NETO_M = " . "'" . $fila['P_NETO_M'] . "',";
	$strSQL = $strSQL . "ADJUNTO = " . "'" . $fila['ADJUNTO'] . "',";
	$strSQL = $strSQL . "MODIFICADO = " . "'" . $modificado . "',";
	$strSQL = $strSQL . "EXISTENCIAS = " . "'" . $fila["EXISTENCIAS"] . "'";	
	$strSQL .= " where NIF = '".$miNIF."' and ID_FABRICA = '".$fila['ID_FABRICA']."'" ; 
	$resultat2 = mysql_query($strSQL, $enllac);
	if (!$resultat2)  die('Error: ' . mysql_error());	
}
$strSQL = "DELETE FROM PRODUCTO_TMP";
$resultat3 = mysql_query($strSQL, $enllac);
if (!$resultat3)  die('Error: ' . mysql_error());
mysql_close($enllac);
echo "<br>Se ha actualizado la tabla de productos modificados<br>"; 
?> 
