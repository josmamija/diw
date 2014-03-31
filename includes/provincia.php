<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	//$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	$sql = "SELECT * FROM `provincia` ORDER BY `provinciaseo`";
	$result = mysql_query($sql,$link);	
	if(!isset($idprovincia)) $idprovincia=0;
	if(!isset($idpoblacion)) $idpoblacion=0;
	
?>

<script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(
	function () {
		$("#sel2").load("../includes/municipio.php?idprovincia="+$("#selector1").val()+"&idpoblacion="+$("#idpoblacion").val() );
		$("#selector1").change(	function () {
				$("#sel2").load("../includes/municipio.php?idprovincia="+$("#selector1").val() +"&idpoblacion="+$("#idpoblacion").val());
			}
		);
	}
);
</script><meta charset="utf-8" />

Provincia: <select id="selector1" name="provincia">
<?php


	while ($fila = mysql_fetch_assoc($result)) {
		if($fila['idprovincia']==$idprovincia){
			echo sprintf('<option selected value="%s">%s</option>',$fila['idprovincia'],$fila['provincia']);
		}else{
		//echo $fila['provincia'] . "<br>";
		echo sprintf('<option value="%s">%s</option>',$fila['idprovincia'],$fila['provincia']);
		}
	}	
?>
</select>
<Input type="hidden" id="idpoblacion" value="<?=$idpoblacion?>">

<br>Municipio: <span id="sel2"></span>
<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>