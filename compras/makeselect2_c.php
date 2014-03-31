<?php


	$idcat = $_GET['categoria'];
	$dni= $_GET['dni'];
	$idCliente=$_GET['idCliente'];
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
/*
$(document).ready(
	function () {		
		$("#sel3").load("makeselect3_c.php?subcategoria="+$("#selector2").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val()+"&categoria="+$("#categoria").val());		
		$("#selector2").change(
			function () {
				//document.writeln("valor subcat "+ $("#sel2").val());
				$("#sel3").load("makeselect3_c.php?subcategoria="+$("#selector2").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val()+"&categoria="+$("#categoria").val());
			}
		);
	}
);
*/
$(document).ready(
	function () {		
		$("#sel3").load("../compras/makeselect3_c.php?subcategoria="+$("#selector2").val()+"&categoria="+$("#categoria").val());		
		$("#selector2").change(
			function () {
				//document.writeln("valor subcat "+ $("#sel2").val());
				$("#sel3").load("../compras/makeselect3_c.php?subcategoria="+$("#selector2").val()+"&categoria="+$("#categoria").val());
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
 
<br>
<Input type="hidden"  id="idCliente" value="<?=$idCliente?>">
<Input type="hidden" id="dni" value="<?=$dni?>">
<Input type="hidden" id="categoria" value="<?=$idcat?>">
<br />Producto:<span id="sel3"></span>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>