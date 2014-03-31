<?php
	$idprovincia = $_GET['idprovincia'];
	$idpoblacion =$_GET['idpoblacion'];
	
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);	
	$sql = "SELECT * FROM poblacion WHERE idprovincia = ".mysql_real_escape_string($idprovincia)." ORDER BY `poblacionseo`";
	$result = mysql_query($sql,$link);
?>

<script type="text/javascript">
/*
$(document).ready(
	function () {		
		$("#sel3").load("../clientes/alta.php?idpoblacion="+$("#selector2").val()+"&idprovincia="+$("#idprovincia").val());		
		$("#selector2").change(
			function () {
				//document.writeln("valor subcat "+ $("#sel2").val());
				$("#sel3").load("alta.php?idpoblacion="+$("#selector2").val()+"&idprovincia="+$("#idprovincia").val());
			}
		);
	}
);
*/
</script>
<?php
    
	echo '<select id="selector2" name="poblacion">';
	while ($fila = mysql_fetch_assoc($result)) {
		if($fila['idpoblacion']==$idpoblacion){
			echo sprintf('<option selected value="%s">%s</option>',$fila['idpoblacion'],$fila['poblacion']);
		}else{
		  echo sprintf('<option value="%s">%s</option>',$fila['idpoblacion'],$fila['poblacion']);
		}
	}
	echo '</select>';

?>
<!---
<Input type="hidden" id="idprovincia" value="<?=$idprovincia?>">
-->
<br> <span id="sel3"></span>

<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>