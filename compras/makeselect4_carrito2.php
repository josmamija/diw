<script language="javascript">
window.onchange=mostrar;
function limpiar() {
	document.getElementById("resposta_proveedor").innerHTML="";
	document.getElementById("resposta_calendario").innerHTML="";
}


</script>

<?php
	$idcat = $_GET['categoria'];
	$idsubcat = $_GET['subcategoria'];
	$idFabrica = $_GET['idFabrica'];
	$idCliente=$_GET['idCliente'];
	$dni = $_GET['dni'];
	/*
	echo " idFabrica " . $idFabrica;
	echo " dni " . $dni;
	exit();
	*/
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
	$activo=1;
    mysql_select_db($baseDatos,$link);
  	mysql_query("SET NAMES UTF8",$link);	
	/*
	$sql = "SELECT PROVEEDOR.NIF, NOMBRE , ACTIVO FROM PRODUCTO, PROVEEDOR ";
	$sql.= " WHERE ID_FABRICA = '".mysql_real_escape_string($idFabrica)."'";
	$sql.= " AND PROVEEDOR.ACTIVO = " .$activo;
	$sql.= " AND PRODUCTO.NIF = PROVEEDOR.NIF ORDER BY `NOMBRE`";
	
	*/
	
	$sql = "SELECT PROVEEDOR.NIF, NOMBRE , ACTIVO, provincia.provincia FROM PRODUCTO, PROVEEDOR, provincia ";
	$sql.= " WHERE ID_FABRICA = '".mysql_real_escape_string($idFabrica)."'";
	$sql.= " AND PROVEEDOR.ACTIVO = " .$activo;
	$sql.= " AND PRODUCTO.NIF = PROVEEDOR.NIF and provincia.idprovincia = PROVEEDOR.PROVINCIA ORDER BY provincia.provincia,PROVEEDOR.NOMBRE";
	$result = mysql_query($sql,$link);
	?>
  <!--
	<form id="f1" name="f1" method="post" >
   --> 
	
    <?php
	/*
	while ($fila = mysql_fetch_assoc($result)) {
		echo $fila['ACTIVO'];
		echo sprintf('Nif="%s", nombre=%s',$fila['NIF'] ,$fila['NOMBRE']);
		
	}
	*/
	$count=mysql_num_rows($result);
 	if($count==0) {
	 	echo " <span style='color:red'>No existe proveedor para ese producto</span>";
 		exit();
 	}
	//echo "<br />Proveedor:";
	echo "<a href='#' onclick='get_poblacion()'> Proveedor: </a>";
	//echo "<span style='cursor:hand;'  onmouseover='get_poblacion()'  >";
	echo '<select id="selector4" name="proveedor"  onchange="limpiar()">';
	while ($fila = mysql_fetch_assoc($result)) {
		//echo $fila['ACTIVO'];
		//exit();
		if($fila['ACTIVO'] == $activo) {
			echo sprintf('<option value="%s">%s</option>',$fila['NIF'] ,$fila['provincia']. " - ". $fila['NOMBRE']);
		}
	}
	echo '</select>';
	
	//echo "</span>";
	
	echo "&nbsp;&nbsp;<a href='#' onclick='get_calendario()'>Calendario festivos</a>";
	?>
        <meta name="http-equiv" content="Content-type: text/html; charset=UTF-8"/>
    	<div id ="resposta_proveedor"  style="color:#333"></div>
        <br />
    	<div id ="resposta_calendario"  style="color:#690"></div>
    <!--
    <INPUT  type="button" name = "proveedor" id="proveedor" VALUE="PROVEEDOR" onclick="get_poblacion()"><br /><br />
     -->
    <INPUT TYPE="hidden"  name="idCliente" VALUE="<?=$idCliente?>">
	<Input type="hidden" name="dni" id ="dni" value="<?=$dni?>">
	<Input type="hidden" name="categoria" value="<?=$idcat?>">
	<Input type="hidden" name="subcategoria" value="<?=$idsubcat?>">
	<Input type="hidden" name="idFabrica" id="idFabrica" value="<?=$idFabrica?>" >
   	<br>
    <hr /><INPUT  type="button" name = "tarifa" id="tarifa" VALUE="TARIFAS" onclick="anadir()"><br /><br />
        <!--
    <textarea id="area" style="height:auto" style="width:auto"></textarea>
   
	</form> 
    -->
  <?php
	mysql_close($link);
?>
 