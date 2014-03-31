<?php
$unif=$_SESSION['nif'];
$nombre=$_SESSION['nombre'];
$idProveedor=$_SESSION['idProveedor'];
 ?>
 <!doctype html>

<html class="">
<head><title>Alta producto</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../fluidLayouts/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluidLayouts/fluidLayouts.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css" />
<script src="../fluidLayouts/respond.min.js"></script>
</head>
 <body>
 <div class="gridContainer clearfix">
 <div id="LayoutDiv1">
<div id="apDiv1" class="letratext"><?=$nombre ?></div> 
 <table>
<tr>
<td>
<div id ="logo">
	<img src="../images/logo_gesdes.jpg" width="319" height="162" /> 
</div>
</td>
<td>
<p class="curved-box-css4">&nbsp;&nbsp;Proveedor</p>
<div id="menu2" class="letratext">
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=0&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;01. INICIO</a>
    <br />
    &nbsp;&nbsp;<a href="../productos/alta_t_cat.php">&nbsp;&nbsp;02. ALTA PRODUCTO</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=1&unif=<?=$unif?>&nombre=<?=$nombre?>">&nbsp;&nbsp;03. EDITAR PRODUCTO</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=3&unif=<?=$unif?>">&nbsp;&nbsp;04. LISTAR PRODUCTOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=4&unif=<?=$unif?>">&nbsp;&nbsp;05. CONFIRMAR PEDIDOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/modificar_p2.php?unif=<?=$unif?>">&nbsp;&nbsp;06. EDITAR PERFIL</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_prov.php?go=6&unif=<?=$unif?>">&nbsp;&nbsp;07. EDITAR CALENDARIO FESTIVOS</a>
    <br />&nbsp;&nbsp;<a href="../proveedores/menu_g_p.php">&nbsp;&nbsp;08. SALIR SESION							</a>
</div>
</td>
</tr>
</table>
<div id="apDiv1" class="letratext"><?=$nombre ?></div>
<div id = "detalle" class="letratext">

<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	//$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
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
		$("#sel2").load("makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("makeselect2.php?categoria="+$("#selector1").val()+"&id_proveedor="+$("#id_proveedor").val()+"&nif="+$("#nif").val());
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