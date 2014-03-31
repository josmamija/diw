<?php
	if (isset($_GET['fecha'])) {
		extract($_GET);
		//$destino="calendario.php?anoactual=$anoactual&nif=$nif&mesactual=$mesactual&fecha=$fecha";
		$destino="../proveedores/menu_prov.php?go=6&unif=$unif&anoactual=$anoactual&mesactual=$mesactual&fecha=$fecha";
		
		include ("../Conexiones/conexion_local.php");
		$enllac = mysql_connect($servidor,$usuari,$contrasenya);
		mysql_select_db($baseDatos,$enllac);
		if($esFestivo==0) {
			$strSQL = "insert into calendario ";
			$strSQL = $strSQL . "(NIF,FECHA)";
			$strSQL = $strSQL . " values (" ;
			$strSQL = $strSQL . "'" . $unif;
			$strSQL = $strSQL . "','" . $fecha . "')" ;
			
		}else {
			$strSQL = "delete from calendario ";
			$strSQL .= " where NIF ='".$unif . "' and FECHA = ";
			$strSQL .= "'". $fecha . "'" ;
		}
		$resultat = mysql_query($strSQL, $enllac);
		if (!$resultat)  die('Error: ' . mysql_error());
    	mysql_close($enllac);
		//echo "<br>Se ha introducido correctamente el dia festivo<br>"; 
		//echo "<a href='calendario.php?anoactual=$anoactual&nif=$nif&mesactual=$mesactual&fecha=$fecha>Volver</a>";
	    header('Location:' . $destino);
	}
	

?> 
