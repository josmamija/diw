<?php
	$idcat = $_GET['categoria'];
	$miNIF = $_GET['nif'];
	$nombre=$_GET['nombre'];
	$idProveedor=$_GET['id_proveedor'];
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);	
	$sql = "SELECT * FROM `SUBCATEGORIA` WHERE `CATEGORIA_ID` = ".mysql_real_escape_string($idcat)." ORDER BY `SUBCAT_NOMBRE`";
	$result = mysql_query($sql,$link);
?>

<script type="text/javascript">
$(document).ready(
	function () {		
		$("#sel3").load("../productos/makeselect3_alta.php?subcategoria="+$("#selector2").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val()+"&categoria="+$("#categoria").val());		
		$("#selector2").change(
			function () {
				//document.writeln("valor subcat "+ $("#sel2").val());
				$("#sel3").load("../productos/makeselect3_alta.php?subcategoria="+$("#selector2").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val()+"&categoria="+$("#categoria").val());
			}
		);
	}
);
</script>
<?php
	echo '<select id="selector2" name="subcategoria">';
	while ($fila = mysql_fetch_assoc($result)) {
		echo sprintf('<option value="%s">%s</option>',$fila['SUBCAT_ID'],$fila['SUBCAT_NOMBRE']);
	}
	echo '</select>';

?>
<Input type="hidden"  id="id_proveedor" value="<?=$idProveedor?>">
<Input type="hidden" id="nif" value="<?=$miNIF?>">
<Input type="hidden" id="nombre" value="<?=$nombre?>">
<Input type="hidden" id="categoria" value="<?=$idcat?>">
<span id="sel3"></span>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>