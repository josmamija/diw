<html>
<head>
<title>CONSULTAR PEDIDO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" /> 
</head>

 <body bgcolor="white">
 <div style="width:200"></div>
<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
	if (isset($_POST['Submit']) || isset($_GET['compra'])) {
		$compra = $_GET["compra"];
		include ("../Conexiones/conexion_local.php"); 
		$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	 	mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
	 	mysql_query("SET NAMES UTF8",$enlace);
		
		//$sql="SELECT c.DNI, c.NOMBRE, c.APELLIDO1, c.APELLIDO2, v.ID_FABRICA,v.CANTIDAD,v.FECHA_COMPRA, v.PVP, v.P_FINAL, v.NIF FROM CLIENTE c, COMPRA v WHERE COD_COMPRA=$compra AND c.DNI = v.DNI";
		
		$sql="SELECT c.DNI, c.NOMBRE, c.APELLIDO1, c.APELLIDO2, v.FECHA_COMPRA, v.FECHA_FINAL, v.NIF";
		$sql.=" FROM CLIENTE c, COMPRA v WHERE COD_COMPRA=$compra  AND c.DNI = v.DNI";
	 	
		$cadena="";
	 	$resultat = mysql_query($sql,$enlace); 
	 	if (!$resultat) die('Error: ' . mysql_error());
	 	$count=mysql_num_rows($resultat);
	   	if($count >0) { 
		    $ptotal=0;
			$fila1=mysql_fetch_array($resultat);
			$unif = $fila1['NIF'];
			$sql="SELECT NOMBRE FROM PROVEEDOR WHERE NIF='$unif'";
	 		$resultat = mysql_query($sql,$enlace); 
	 		if (!$resultat) die('Error: ' . mysql_error());
	 		$count=mysql_num_rows($resultat);
	   		$filap=mysql_fetch_array($resultat);
			$nombre=$filap['NOMBRE'];
			$cadena="<span class ='curved-box-css4'>Código&nbsp;compra : </span>"."<b><font color='red'>".$compra ."</font></B><br>";
			$cadena.= "<p class='rounded' style='width:250'>Proveedor :  $nombre</p>";
	   		$cadena.= "Datos del cliente <BR><DIV class ='rounded' style='width:250' >";
	   		$cadena.= " DNI : " . $fila1['DNI'] . "<br>";
	   		$cadena.=" Cliente : ".$fila1['NOMBRE']." ".$fila1['APELLIDO1']. " ".$fila1['APELLIDO2']."</div><br>";
		  	//echo "Datos de la compra <BR><DIV class ='rounded'  style='width:250'>";
	   		$cadena.=" Fecha de la compra : <b>" . $fila1['FECHA_COMPRA'] . "</b><br>";
			if(is_null($fila1['FECHA_FINAL'])) $estado ="<font color='red'>Pendiente confirmar proveedor.</font>";
			else $estado= "Fecha de cierre : <b>" . $fila1['FECHA_FINAL'] . "</b>";
			$cadena.=$estado ."<br>";
			
	   	}else{
	    	echo "No existe ese numero de compra";
			echo "<br><a href='javascript:history.back()'>Volver</a>"; 
			exit(); 
	   	}
		$sql=" SELECT ID_FABRICA,CANTIDAD,PVP, P_FINAL,P_NETO ";
		$sql.="FROM ITEMS WHERE COD_COMPRA=$compra";
		$resultat = mysql_query($sql,$enlace);
		if (!$resultat) die('Error: ' . mysql_error());
		$count=mysql_num_rows($resultat);
		$cadena.= "<TABLE border ='1' class='rounded'>";
		$cadena.= "<tr class='cabecera'>";
		$cadena.= "<td>Marca</td><td>Descripción</td><td>C. Fábrica</td><td>Cantidad</td><td>PVP</td><td>P.NETO</td></tr>";
		$ct=0;
		while($fila=mysql_fetch_array($resultat)){
			//echo ++$ct;
			$idFabrica=$fila['ID_FABRICA'];
			$sql="SELECT MARCA, DESCRIPCION FROM PRODUCTO WHERE ID_FABRICA='$idFabrica' AND NIF = '$unif'";
			$resultat2 = mysql_query($sql,$enlace); 
			if (!$resultat2) die('Error: ' . mysql_error());
			$fila2=mysql_fetch_array($resultat2);
   			$cadena.= "<tr><td>" . $fila2["MARCA"] . "</td>";
			$cadena.= "<td>" . $fila2["DESCRIPCION"]. "</td>";
			$cadena.= "<td>" . $idFabrica . "</td>";
	   		$cadena.= "<td>" . $fila['CANTIDAD'] . "</td>";
	   		$cadena.= "<td>" . $fila['PVP'] . "</td>";
	   		$cadena.= "<td>" . $fila['P_NETO'] . "</td></tr>";
			$ptotal+=$fila['P_FINAL']* $fila['CANTIDAD'];
		}
		//$cadena.= "<tr><td colspan ='5'>Precio final Total</td><td> ".$ptotal."</td></tr>";
		$cadena.="</table>";
		echo $cadena;
		?>
       
		 
	<?php
        mysql_close($enlace);
	}else {// submit cod_compra
		
   		?>
        <p class="curved-box-css3">Consultar datos compra</p>
		<!--<a href="../index.php?page=inicio">Inicio</a>-->
         
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<td>&nbsp;&nbsp;Código de la compra:&nbsp;<INPUT TYPE="text" name="compra" style="color: #00F"></td></tr>		
			</table>
    		
			<INPUT TYPE="submit" name = "Submit" VALUE="Aceptar">
		</form>
	<?php
	}
	
} else{ // autenficacion
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../administracion/login_admin.php> Login</a>";
}
 ?>
 <!--
 <br><a href='javascript:history.back()'>&nbsp;&nbsp;Volver</a>  
 -->
 <br><a href='javascript:onClick=window.close(); target="_top"'>&nbsp;&nbsp;Cerrar</a>  
 
</body>
</html>
