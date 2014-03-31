
<?php
	// debes cambiar por tus datos de acceso a MySQL.
	include ("../Conexiones/conexion_local.php"); 
	$link = mysql_connect($servidor,$usuari,$contrasenya);
    mysql_select_db($baseDatos,$link);
  	// debes cambiar "test" por el nombre de tu base de datos en MySQL.
	mysql_query("SET NAMES UTF8",$link);
	//$sql = "SELECT * FROM CATEGORIA ORDER BY CATEGORIA_NOMBRE";
	//$servicio =0;
	$sql = "SELECT * FROM CATEGORIA WHERE SERVICIO = ".$servicio ." ORDER BY CATEGORIA_NOMBRE";
	$result = mysql_query($sql,$link);	
?>
<script type="text/javascript" charset="UTF-8" language="Javascript" src="../proveedores/funcionesAJAX3p.js"> </script>
<script type="text/javascript" charset="UTF-8" language="Javascript" src="../proveedores/AJAX_calendario.js"> </script>
<!--
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
-->
<script type="text/javascript" charset="UTF-8"  src="../js/nhpup_1.1.js"></script>
<script type="text/javascript" charset="UTF-8" language="Javascript" src="../compras/xmlhttp_ex2.js">
</script> 
<script language="Javascript" type="text/javascript" src="../compras/ajax_p_neto.js"> 
</script>

<script language="Javascript" type="text/javascript" src="../productos/ajax_id_prod.js"> 
</script>

<script type="text/javascript">

$(document).ready(
	function () {
		$("#sel2").load("../compras/makeselect2_c.php?categoria="+$("#selector1").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val());
		$("#selector1").change(
			function () {
				$("#sel2").load("../compras/makeselect2_c.php?categoria="+$("#selector1").val()+"&idCliente="+$("#idCliente").val()+"&dni="+$("#dni").val());
			}
		);
	}
);

</script>

<?php 

//session_start();	
	
	//$_SESSION["usuario"] = $miUsuario;
	//Iniciar una sesion de PHP
    //Crear una variable para indicar que se ha autenticado
    $_SESSION['autenticado']    = 'SI';
    $nombre=$_SESSION['nombre'];
	$apellido=$_SESSION['apellido'];

?>
<form method="get">
<br>Categoria: <select id="selector1" name="categoria" >
<?php
	while ($fila = mysql_fetch_assoc($result)) {
		echo sprintf('<option value="%s">%s</option>',$fila['CATEGORIA_ID'],$fila['CATEGORIA_NOMBRE']);
	}	
?>
</select>
<Input type="hidden"  id="idCliente" value="<?=$idCliente?>">
<Input type="hidden" id="dni" value="<?=$dni?>">
<br><br>Subcategoria: <span id="sel2"></span>
</form>
<div id="resposta" >
</div>
<br><INPUT  type="button" name = "confirmar" id="confirmar" VALUE="ACEPTACIÓN PEDIDO"  style="visibility:hidden" onclick="confirmarcompra()"><br><br />

<?php
	mysql_close($link); // Nunca olvides cerrar la conexión a la base de datos.
?>