<?php
header("Content-type: text/html; charset=utf-8"); 
include ("../Funciones/funciones.php"); 
include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_set_charset('utf8');
//$miNIF = $_GET['nif'];
//$miNIF="22222222A";
$aumento=1+$_GET['subida']/100;
$strSQL = "insert into PRODUCTO_TMP ";
$strSQL .= "(PRODUCTO_ID,COD_PRODUCTO,NIF,ID_PROVEEDOR,ID_FABRICA,COD_ALMACEN,CATEGORIA_ID,SUBCAT_ID,MARCA,DESCRIPCION,PVP,MAX_U_DES,DESCUENTO, EXISTENCIAS,LINK,LINK2,P_NETO_1,P_NETO_M)";
$strSQL .=" SELECT PRODUCTO_ID,COD_PRODUCTO,NIF,ID_PROVEEDOR,ID_FABRICA,COD_ALMACEN,CATEGORIA_ID,SUBCAT_ID,MARCA,DESCRIPCION,PVP*($aumento),MAX_U_DES,DESCUENTO, EXISTENCIAS,LINK,LINK2,P_NETO_1,P_NETO_M FROM PRODUCTO";
$strSQL .= " where PRODUCTO.NIF = '".$unif."'";
$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
mysql_close($enllac);
echo "<br>Se ha actualizado los precios de todos los productos productos<br> Los efectos serán efectivos  una vez aplicados los descuentos en los pedidos pendientes"; 
?> 
