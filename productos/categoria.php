<?php
$unif=$_SESSION['nif'];
$nombre=$_SESSION['nombre'];
//$idProveedor=$_SESSION['idProveedor'];
//echo "idproveedor:".$idProveedor;
 ?>

<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	//$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$sql = "SELECT * FROM CATEGORIA WHERE SERVICIO = ". $servicio . " ORDER BY CATEGORIA_NOMBRE";
	$result = mysql_query($sql,$link);	
?>

<script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
/*
$(document).ready(
	function () {
		$("#sel2").load("makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nombre="+$("#nombre").val()+"&nif="+$("#nif").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nombre="+$("#nombre").val()+"&nif="+$("#nif").val());
			}
		);
	}
);
*/

$(document).ready(
	function () {
		$("#sel2").load("../productos/makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("../productos/makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val());
			}
		);
	}
);



</script>

<img src="../images/altaproducto.GIF" width="150" height="35" /><br />
Categoria: <select id="selector1" name="categoria">
<?php
	while ($fila = mysql_fetch_assoc($result)) {
		echo $fila['CATEGORIA_NOMBRE'] . "<br>";
		echo sprintf('<option value="%s">%s</option>',$fila['CATEGORIA_ID'],$fila['CATEGORIA_NOMBRE']);
	}	
?>
</select>
<Input type="hidden"  id="id_proveedor" value="<?=$idProveedor?>">
<Input type="hidden" id="nif" value="<?=$unif?>">
<Input type="hidden" id="nombre" value="<?=$nombre?>">
<BR />Subcategoria: <span id="sel2"></span>
</div>
</div>
</body>
</html>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>