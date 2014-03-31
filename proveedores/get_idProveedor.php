<?php
	include ("../Conexiones/conexion_local.php"); 
	 // Unas pequeñas medidas de seguridad para proteger las bases de datos de posibles inyecciones
    //Conectamos con el servidor y seleccionamos la base de datos
 	$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
	 mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
 	//$sql="SELECT * FROM PROVEEDOR WHERE USUARIO='$miUsuario' and PWD='$miPassword'";
 	$sql = "SELECT ID_PROVEEDOR, NOMBRE FROM PROVEEDOR WHERE NIF='" .$unif ."'";
	$result=mysql_query($sql);
	$fila=mysql_fetch_array($result);
	$idProveedor = $fila['ID_PROVEEDOR'];
	$nombre=$fila['NOMBRE'];
	mysql_close($enlace);
 ?>