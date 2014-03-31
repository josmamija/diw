
<?php
if (isset($_POST['Submit'])) {
	$cod_compra = $_POST['cod_compra'];
	$unif = $_POST['unif'];
	$confirmado =1;
	$fecha_actual = date("Y-m-d H:i:s");
	//$fecha_actual = date("d/m/Y H:i:s"); 
	//echo " pvp:" .$pvp;
	//echo "$fecha_actual " . $fecha_actual;
	//exit;
	include ("../Conexiones/conexion_local.php"); 
	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	 mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
	 mysql_query("SET NAMES UTF8",$enlace);
	 
	 $sql="UPDATE COMPRA SET CONFIRMADO_PROV = $confirmado ,FECHA_FINAL = ";
	 $sql.="'$fecha_actual' WHERE COD_COMPRA = $cod_compra"; 

 $resultat = mysql_query($sql,$enlace);
 
	if (!$resultat) die('Error: ' . mysql_error());
	else {
		$sCadena= "COMPRA CONFIRMADA CON EXITO!!";
 		echo $sCadena;
   
	}
	mysql_close($enlace);
}
 ?>
 <br />
 <a href=../proveedores/menu_prov?unif=<?=$unif?>> Inicio</a>>>
 <a href='javascript:history.back()'>Volver</a>  

