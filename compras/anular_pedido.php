<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_GET['compra'])) {
	include ("../Conexiones/conexion_local.php");
	$compra = $_GET['compra'];
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
	mysql_select_db($baseDatos,$enllac);
	$strSQL = "delete from COMPRA where COD_COMPRA = '" .  $compra . "'" ;
	$resultat = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
	$strSQL = "delete from ITEMS where COD_COMPRA = '" .  $compra . "'" ;
	$resultat = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
	mysql_close($enllac);
	header('Location:listado_compras_clie.php');
	//echo "<p style='color:red'>Pedido anulado con éxito</p>"; 
	//echo "<br><a href='javascript:history.back()'>Volver</a>"; 
	//exit();		
}
?>
