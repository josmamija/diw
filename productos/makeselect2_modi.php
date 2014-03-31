<?php
	$idcat = $_GET['categoria'];
	$subcat=$_GET['subcat'];
	//echo "hola ". $subcat;
	//exit();
	//$miNIF = $_GET['nif'];
	//echo $miNIF ." ". $idcat." ". $subcat;
	//exit();
	//$idProveedor=$_GET['id_proveedor'];
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);	
	$sql = "SELECT * FROM SUBCATEGORIA WHERE CATEGORIA_ID = ".mysql_real_escape_string($idcat)." ORDER BY SUBCAT_NOMBRE";
	$result = mysql_query($sql,$link);
?>
<?php
    
	echo '<select id="selector2" name="subcategoria">';
	while ($fila = mysql_fetch_assoc($result)) {
		if($fila['SUBCAT_ID']==$subcat) {
			echo sprintf('<option selected value="%s">%s</option>',$fila['SUBCAT_ID'],$fila['SUBCAT_NOMBRE']);
		}else{
			echo sprintf('<option value="%s">%s</option>',$fila['SUBCAT_ID'],$fila['SUBCAT_NOMBRE']);
		}
	}
	echo '</select>';

?>
<!--
<Input type="hidden"  id="id_proveedor" value="<?=$idProveedor?>">
<Input type="hidden" id="nif" value="<?=$miNIF?>">
<Input type="hidden" id="categoria" value="<?=$idcat?>">
-->
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>