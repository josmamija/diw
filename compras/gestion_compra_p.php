<?php
session_start();
if (isset($_SESSION['nif']) && ($_SESSION['autenticado'] == 'SI')) {
	$compra = $_GET["compra"];
	$unif = $_GET['unif'];
	$ptotal=0;
	include ("../Conexiones/conexion_local.php"); 
	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
	//mysql_query("SET NAMES UTF8",$enlace);
	//$sql="SELECT NOMBRE FROM PROVEEDOR WHERE NIF='$unif'";
	//$resultat = mysql_query($sql,$enlace); 
	//if (!$resultat) die('Error: ' . mysql_error());
	//$count=mysql_num_rows($resultat);
	//$fila1=mysql_fetch_array($resultat);
	//$nombre=$fila1['NOMBRE'];
	//echo $nombre;
	//$sql="SELECT c.DNI, c.NOMBRE, c.APELLIDO1, c.APELLIDO2, v.ID_FABRICA,v.CANTIDAD,v.FECHA_COMPRA,";
	//$sql.=" v.PVP, v.P_FINAL FROM CLIENTE c, COMPRA v WHERE COD_COMPRA=$compra and v.NIF ='$unif' AND c.DNI = v.DNI";
	$sql="SELECT c.DNI, c.NOMBRE, c.APELLIDO1, c.APELLIDO2, v.FECHA_COMPRA";
	$sql.=" FROM CLIENTE c, COMPRA v WHERE v.COD_COMPRA=$compra and v.NIF ='$unif' AND c.DNI = v.DNI";
	$resultat = mysql_query($sql,$enlace); 
	if (!$resultat) die('Error: ' . mysql_error());
	$count=mysql_num_rows($resultat);
	//echo $unif . " ". $compra; 
	//echo " ".$sql;
	//exit();
	
	if($count >0) { 
	
		$fila1=mysql_fetch_array($resultat);
		echo "<span class ='curved-box-css4'>Código&nbsp;compra : </span>"."<b><font color='red'>".$compra ."</font></B><br>";
		echo "<p class='rounded' style='width:250'>Proveedor :  $nombre</p>";
	   	echo "Datos del cliente <BR><DIV class ='rounded' style='width:250' >";
	   	echo " DNI : " . $fila1['DNI'] . "<br>";
	   	echo " Cliente : ".$fila1['NOMBRE']." ".$fila1['APELLIDO1']. " ".$fila1['APELLIDO2']."</div><br>";
	   	//echo "Datos de la compra <BR>
		//echo "<DIV class ='rounded'  style='width:250'>";
	   	echo " Fecha de la compra : <b>" . $fila1['FECHA_COMPRA'] . "</b><br>";
	}else{
	   	echo "No existe ese numero de compra";
		echo "<br><a href='javascript:history.back()'>Volver</a>"; 
		exit(); 
	}
	$sql=" SELECT ID_FABRICA,CANTIDAD,PVP, P_FINAL ";
	$sql.="FROM ITEMS WHERE COD_COMPRA=$compra";
	$resultat = mysql_query($sql,$enlace);
	if (!$resultat) die('Error: ' . mysql_error());
	$count=mysql_num_rows($resultat);
	echo "<TABLE border ='1' class='rounded'>";
	echo "<tr class='cab_inv'>";
	echo "<td>Marca</td><td>Descripción</td><td>C. Fábrica</td><td>Cantidad</td><td>Precio</td><td>P.FINAL</td></tr>";
	while($fila=mysql_fetch_array($resultat)){
		$idFabrica=$fila['ID_FABRICA'];
		$sql="SELECT MARCA, DESCRIPCION FROM PRODUCTO WHERE ID_FABRICA='$idFabrica' AND NIF = '$unif'";
		$resultat2 = mysql_query($sql,$enlace); 
		if (!$resultat2) die('Error: ' . mysql_error());
		$fila2=mysql_fetch_array($resultat2);
   		echo "<tr><td>" . $fila2["MARCA"] . "</td>";
		echo "<td>" . $fila2["DESCRIPCION"]. "</td>";
		echo "<td>" . $idFabrica . "</td>";
		echo "<td>" . $fila['CANTIDAD'] . "</td>";
		echo "<td>" . $fila['P_FINAL'] . "</td>";
		echo "<td>" . $fila['P_FINAL']*$fila['CANTIDAD']. "</td></tr>";
		$ptotal+=$fila['P_FINAL']*$fila['CANTIDAD'];
	}
	echo "<tr><td colspan ='5'>Precio final Total</td><td> ".$ptotal."</td></tr>";
	echo"</table>";
	?>
    <form action = "../compras/confirmar_g_c_p.php" method="post">
		<Input type="hidden" name="cod_compra" value="<?=$compra?>">
        <Input type="hidden" name="unif" value="<?=$unif?>">
        <Input type="hidden" name="idProveedor" value="<?=$unif?>">
		<INPUT TYPE="submit" name = "Submit" VALUE="Confirmar">
        <input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
	</form>
    <!--
    <a href='javascript:history.back()'>Volver</a>
    -->  
	<?php
	$sql="UPDATE COMPRA SET VISITAS = (VISITAS + 1) WHERE COD_COMPRA = $compra";
	$resultat = mysql_query($sql,$enlace);
    mysql_close($enlace);
} else{ // autenficacion
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../proveedores/menu_g_p.php> Login</a>";
}
 ?>
