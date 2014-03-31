<?php
	$idcat = $_GET['categoria'];
	$idsubcat = $_GET['subcategoria'];
	$dni= $_GET['dni'];
	$idCliente=$_GET['idCliente'];
	//echo "<br>cat:".$idcat . " subcat: " . $idsubcat;
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	//mysql_query("SET NAMES UTF8",$link);	
	mysql_query("SET NAMES 'UTF8'");
	$sql = "SELECT DISTINCT (ID_FABRICA), MARCA,DESCRIPCION FROM `PRODUCTO` ";
	$sql .= " WHERE `CATEGORIA_ID` = ". mysql_real_escape_string($idcat) ;
	$sql .= " AND SUBCAT_ID = " .mysql_real_escape_string($idsubcat)." GROUP BY ID_FABRICA ORDER BY `DESCRIPCION` ";
	$result = mysql_query($sql,$link);
	if (!$result)  die('Error: ' . mysql_error());
	$count=mysql_num_rows($result);
 	if($count==0) {
	 	echo " <span style='color:red'>No existe producto de esa categoria</span>";
 		exit();
 	}
?>

<script type="text/javascript">
$(document).ready(
	function () {		
		$("#sel4").load("../compras/makeselect4_carrito2.php?idFabrica="+$("#selector3").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val()+"&categoria="+$("#categoria").val() +"&subcategoria="+$("#subcategoria").val());		
		$("#selector3").change(
			function () {
				//document.writeln("valor subcat "+ $("#sel2").val());
				$("#sel4").load("../compras/makeselect4_carrito2.php?idFabrica="+$("#selector3").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val()+"&categoria="+$("#categoria").val()+"&subcategoria="+$("#subcategoria").val());
			}
		);
	}
);
</script>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php
	//echo '<select id="selector3" name="producto" onchange="verproducto(this.options[this.selectedIndex].text)">';
	echo '<select id="selector3" name="producto" onfocus="get_descripcion(this.value)" onchange="get_descripcion(this.value)">';
	while ($fila = mysql_fetch_assoc($result)) {
		echo sprintf('<option value="%s">%s</option>',$fila['ID_FABRICA'],$fila['MARCA'] . " - " .  utf8_decode(substr($fila['DESCRIPCION'],0,30)));
	}
	echo '</select>';
?>
<Input type="hidden"  id="idCliente" value="<?=$idCliente?>">
<Input type="hidden" id="dni" value="<?=$dni?>">
<Input type="hidden" id="categoria" value="<?=$idcat?>">
<Input type="hidden" id="subcategoria" value="<?=$idsubcat?>">

<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div id="desc_produc" style="color:#690" class="rounded"></div>
<br />
<span id="sel4"></span>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>