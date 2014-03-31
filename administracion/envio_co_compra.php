<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" /> 
<?php
session_start();
//echo $_SESSION['usuario'];
//echo $_SESSION['autenticado'];
//exit();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
	if (isset($_GET['Submit']) || isset($_GET['compra'])) { 
		include ("../Conexiones/conexion_local.php");
		include ("../Funciones/funciones.php");
		//include ("../Correo/correo.php");
		//include("../PHPMailer-master/enviarCorreo.php");
		$strSQL;
		$compra =$_GET['compra'];
 		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
 		mysql_select_db($baseDatos,$enllac);
		$_SESSION['UrlDestino']="menu_a.php";
		//datos del cliente
		$sql ="SELECT co.*,	EMAIL , CONCAT(cl.NOMBRE,' ', cl.APELLIDO1) as CLIENTE FROM "; 							        $sql.="COMPRA co, CLIENTE cl WHERE COD_COMPRA = '". $_GET['compra']."'";
		$sql.=" AND co.DNI = cl.DNI";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		$fila=mysql_fetch_array($result); 
		//echo $fila['CLIENTE'];
		//exit();
		if($count==1) {
			//echo "hola";
			//exit();
			//datos del proveedor
			$sql ="SELECT NOMBRE, FECHA_COMPRA FROM COMPRA co, PROVEEDOR pr WHERE ";
			$sql.= "COD_COMPRA = '". $_GET['compra']."'";
			$sql.=" AND co.NIF = pr.NIF ";
			$result=mysql_query($sql);
			$count=mysql_num_rows($result);
			$fila2=mysql_fetch_array($result); 
			$nif = $fila['NIF'];
			
			//$sql="SELECT MARCA, DESCRIPCION, PROVEEDOR.NOMBRE FROM PRODUCTO, PROVEEDOR WHERE PROVEEDOR.NIF ='$nif' and ID_FABRICA='$idFabrica' AND PRODUCTO.NIF = PROVEEDOR.NIF";
	        //$resultat = mysql_query($sql,$enllac);
 	        //if (!$resultat) die('Error: ' . mysql_error());
			//$fila3=mysql_fetch_array($resultat);
			$sDestino= $fila['EMAIL'];
			$TextBody = "<img src='http://www.gesdesc.com/images/logoGesdesc.GIF' width='134' height='41' /><br />";
			$TextBody .= "http://www.gesdesc.com<br><br>";
			$TextBody .= "<B>DATOS DEL PEDIDO</B> <hr>";
			$TextBody .= "C&oacute;digo compra: <font color='red' size='+1'><B>".$fila["COD_COMPRA"]. "</B></font><br>";
			$TextBody .= "Fecha compra : <B><font color='red'>".$fila2['FECHA_COMPRA']."</font></B><br>";
			
			$TextBody .= "Cliente: <font color='red'>" . $fila['CLIENTE']."</font> <br>";
			$TextBody .= "DNI : <font color='red'>".$fila['DNI']."</font><br>";
			$TextBody .= "Proveedor: <font color='red'>" . $fila2['NOMBRE']. "</font> <br>";
			
			$sql=" SELECT ID_FABRICA,CANTIDAD,PVP, P_FINAL ";
			$sql.="FROM ITEMS WHERE COD_COMPRA=$compra";
			$resultat2 = mysql_query($sql,$enllac);
			if (!$resultat2) die('Error: ' . mysql_error());
			$count=mysql_num_rows($resultat2);
			$cadena= "<TABLE border ='0' class='rounded'>";
			$cadena.= "<tr bgcolor='#336600' style='color:#FFF'>";
			$cadena.= "<td>Marca</td><td>Descripci&oacute;n</td><td>C. F&aacute;brica</td><td>Cantidad</td><td>PRECIO</td><td>P.FINAL</td></tr>";
			//$ct=0;
			$ptotal=0;
			while($fila3=mysql_fetch_array($resultat2)){ // items
				//echo ++$ct;
				$idFabrica=$fila3['ID_FABRICA'];
				$sql="SELECT MARCA, DESCRIPCION FROM PRODUCTO WHERE ID_FABRICA='$idFabrica' AND NIF = '$nif'";
				$resultat3 = mysql_query($sql,$enllac); 
				if (!$resultat3) die('Error: ' . mysql_error());
				$fila4=mysql_fetch_array($resultat3);//datos del producto
				$pfinal=$fila3['P_FINAL']*$fila3['CANTIDAD'];
				$desc= substr($fila4["DESCRIPCION"],0,50);
				$cadena.= "<tr><td> <font color='#066'>" . $fila4["MARCA"] . "</font></td>";
				$cadena.= "<td><font color='#066'>" . $desc. "</td>";
				$cadena.= "<td><font color='#066'>".$idFabrica."</font> </td>";
	   			$cadena.= "<td><font color='#066'>" . $fila3['CANTIDAD'] . "</font> </td>";
	   			$cadena.= "<td><font color='#066'>" . $fila3['P_FINAL'] . "</font> </td>";
	   			$cadena.= "<td><font color='#066'>" . $pfinal . "</font> </td></tr>";
				$ptotal+=$pfinal;
			}
			$cadena.= "<tr><td colspan ='5'></td><td> <hr></td></tr>";
			$cadena.= "<tr><td colspan ='5'>Precio Final Total (&#8364;)</td><td> ".round($ptotal,2)."</td></tr>";
			$cadena.="</table>";
			$TextBody .=$cadena;
			/*
			$TextBody .= "Codigo Fabrica : <font color='red'>".$fila['ID_FABRICA']."</font><br>";
			$TextBody .= "Marca : <font color='red'>".$fila3['MARCA']."</FONT><br>";
			$TextBody .= "Descripcion :<font color='red'> ".$fila3['DESCRIPCION']."</font><br>";
			$TextBody .= "PRECIO : <font color='red'>".$fila['P_FINAL']."</font><br>";
			$TextBody .= "Uds. : <B><font color='red'>".$fila['CANTIDAD']."</font></B><br>";
			*/
			
			$remitente ="gestion@gesdesc.com";
			$asunto ="Pedido ".$fila['COD_COMPRA'] . " GESDESC";
			//echo $TextBody;
			//exit(); 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: GESDESC <gestion@gesdesc.com>' . "\r\n";
		
			mail ($sDestino, $asunto, $TextBody, $headers);  
			//EnviarCorreo($sDestino,$TextBody,$remitente,$asunto);
			$enviado =1;
			 $strSQL = "update COMPRA set ENVIADO = " .$enviado . " where COD_COMPRA = '". $fila['COD_COMPRA']."'";
			$resultat = mysql_query($strSQL, $enllac);
			if (!$resultat)  die('Error: ' . mysql_error());
    		mysql_close($enllac);
			echo "<br>Ha sido enviado un correo de notificacion<br>"; 
			echo "<a href=../compras/listado_compras_clie.php'> Volver</a>";
			exit();
			
		}else {
			echo "No existe pedido con codigo : " .$_GET['compra'];
			echo "<a href='../administracion/menu_a.php?page=inicio'>Inicio</a>";
			exit();
		}
	}
	?>
    <p class="curved-box-css3">Envío código compra</p>
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<B>&nbsp;&nbsp;Código compra:</B><INPUT type = "text" NAME="compra" SIZE="10">
   		<INPUT TYPE="Submit" name = "Submit" VALUE="Enviar">
	</FORM> 
	<?php
	echo "<a href='../administracion/menu_a.php?page=inicio'>&nbsp;&nbsp;Inicio</a>";
}else{
	
//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=login_admin.php>Login</a>";
	
}
?> 
