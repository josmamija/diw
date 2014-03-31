<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	//$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$resulta = mysql_query($sql,$link);	
	$subcat=$fila['SUBCAT_ID'];
?>
<!--
<script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
-->
<script type="text/javascript">
$(document).ready(
	function () {
		$("#sel2").load("../productos/makeselect2_modi.php?categoria="+$("#selector1").val()+"&subcat="+$("#subcat").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("../productos/makeselect2_modi.php?categoria="+$("#selector1").val()+"&subcat="+$("#subcat").val());
			}
		);
	}
);
</script>
Categoria: <select id="selector1" name="categoria">
<?php
	while ($fila2 = mysql_fetch_assoc($resulta)) {
		if($fila2['CATEGORIA_ID']==$fila['CATEGORIA_ID']){
		   echo $fila2['CATEGORIA_NOMBRE'] . "<br>";
		   echo sprintf('<option selected value="%s">%s</option>',$fila2['CATEGORIA_ID'],$fila2['CATEGORIA_NOMBRE']);
		}else{
		   echo $fila2['CATEGORIA_NOMBRE'] . "<br>";
		   echo sprintf('<option value="%s">%s</option>',$fila2['CATEGORIA_ID'],$fila2['CATEGORIA_NOMBRE']);
		}
	}
//echo $unif;
//exit();		
?>
</select>
<!--
<Input type="hidden"  id="id_proveedor" value="<?=$idProveedor?>">
-->
<Input type="hidden" id="nif" value="<?=$unif?>">

<Input type="hidden" id="subcat" value="<?=$subcat?>">

<br />Subcategoria: <span id="sel2"></span>

<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>