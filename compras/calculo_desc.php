<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />  

<?php
 function calcular_des($pvp,$p_neto_1,$p_neto_m, $max_u_des, $unidades) {
   // descuento adicional por cada unidad vendida
   $desc_adic= (($p_neto_1 - $p_neto_m)/$pvp)*100 / ($max_u_des -1); 
   // %descuento a aplicar
   if($unidades > $max_u_des) $unidades = $max_u_des; // limitamos el descuento al maximo de unidades
   $descuento= (($pvp-$p_neto_1)*100)/$pvp + $desc_adic * ($unidades-1);
   //echo "<br>" .(100-$descuento);
   // precio neto final aplicado el descuento por unidad
   $p_net = ((100-$descuento) * $pvp)/100;
   //echo "<br>" .$p_net;
   //exit();
    return(round($p_net*100)/100);
 }
$confirmado =1;
$confirmado_p =0;
//$fecha = date("Y-m-d H:i:s");
$diasemana= date("w",time());
$fecha = date("Y-m-d");
$hora ="15:00:00";
$fecha1 = date("Y-m-d H:i:s",strtotime($fecha . " ". $hora));
$hora ="20:00:00";
$fecha2 = date("Y-m-d H:i:s",strtotime($fecha . " ". $hora));
$fecha4 =$fecha1;
if($diasemana ==7){ //domingo
	$fecha = date("Y-m-d", strtotime("-1 day"));
	$hora ="15:00:00";
	$fecha3 = date("Y-m-d H:i:s",strtotime($fecha . " ". $hora));
	//$fecha4 =$fecha1;
}else if($diasemana ==1){ //lunes
	$fecha = date("Y-m-d", strtotime("-2 day"));
	$hora ="15:00:00";
	$fecha3 = date("Y-m-d H:i:s",strtotime($fecha . " ". $hora));
	//$fecha4 =$fecha1;
}else { //1er turno otro dia
    $hora ="20:00:00";
	$fecha = date("Y-m-d", strtotime("-1 day"));
	$fecha3 = date("Y-m-d H:i:s",strtotime($fecha . " ". $hora));	
}
//echo $fecha1 ."<br>";
//echo $fecha2 ."<br>";
//echo $fecha3 ."<br>";
//exit();  
include ("../Conexiones/conexion_local.php");
//response.write sDestino
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
//$strSQL = " select COD_COMPRA, NIF, ID_FABRICA, sum(CANTIDAD) unidades , FECHA_COMPRA from COMPRA where FECHA_COMPRA <= '$fecha1' and FECHA_COMPRA > '$fecha3' AND CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p group by NIF, ID_FABRICA";
echo "<h2>1er TURNO</h2>";
$strSQL = "select NIF, i.ID_FABRICA, sum(i.CANTIDAD) unidades, sum(i.P_NETO*i.CANTIDAD) TNETO from COMPRA c, ITEMS i where ";
$strSQL .= " c.COD_COMPRA = i.COD_COMPRA and FECHA_COMPRA <= '$fecha1' and ";
$strSQL = $strSQL ."FECHA_COMPRA > '$fecha3' AND CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p group by NIF, ID_FABRICA";

echo "<table border='1' class='rounded' >";
echo "<tr class='curved-box-css3'><th >NIF</th><th>ID_FABRICA</th><th>UDS</th><th>P_NETO_1</th><th>P_NETO_M</th><th>MAX_U</th><th>P_FINAL</th><th>COMPRA</th></tr>";
$resultat = mysql_query($strSQL, $enllac); // unidades compradas por id_fabrica y provevedor
if (!$resultat)  die('Error: ' . mysql_error());
while($fila=mysql_fetch_array($resultat)){
	$nif = $fila["NIF"];
	$idFabrica = $fila["ID_FABRICA"];
	$Tneto = $fila["TNETO"];
	//$codCompra = $fila["COD_COMPRA"];
	$strSQL = " select PVP,P_NETO_1,P_NETO_M,MAX_U_DES from PRODUCTO where NIF = '$nif' and ID_FABRICA = '$idFabrica'";
	$resultat2 = mysql_query($strSQL, $enllac); //precio y descuento por producto y provvedor
	echo "<tr><td>". $fila["NIF"] ."</td><td> ". $fila["ID_FABRICA"] ."</td><td> ".$fila["unidades"];
	$fila2=mysql_fetch_array($resultat2);
	echo "</td><td> " . $fila2["P_NETO_1"] ."</td><td> ". $fila2["P_NETO_M"] ."</td><td> ".$fila2["MAX_U_DES"];
	$p_neto=calcular_des($fila2["PVP"],$fila2["P_NETO_1"],$fila2["P_NETO_M"],$fila2["MAX_U_DES"], $fila["unidades"]);
	echo " </td><td>".$p_neto ."</td>";
	$strSQL = "select i.COD_COMPRA,i.P_NETO, i.CANTIDAD from COMPRA c, ITEMS i where ";
	$strSQL .= " NIF = '$nif' and i.ID_FABRICA ='$idFabrica' and c.COD_COMPRA = i.COD_COMPRA and ";
	$strSQL = $strSQL ."FECHA_COMPRA <= '$fecha1' and FECHA_COMPRA > '$fecha3' AND ";
	$strSQL .= "CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p";
	$resultat3 = mysql_query($strSQL, $enllac);
	if (!$resultat)  die('Error: ' . mysql_error());
	
	echo "<td>";
	while($fila3=mysql_fetch_array($resultat3)){
		
		//exit();
		$p_final = $fila3['P_NETO'] - ($Tneto-$p_neto*$fila["unidades"])/$fila["unidades"];	
		$p_final = round($p_final,2);	
		$codCompra = $fila3["COD_COMPRA"];				
		//$strSQL = "update COMPRA SET P_FINAL = $p_final, FECHA_FINAL = '$fecha1' where COD_COMPRA = $codCompra";
		$strSQL = "update ITEMS SET P_FINAL = $p_final where COD_COMPRA = $codCompra and ID_FABRICA ='$idFabrica'";
		$resultat4 = mysql_query($strSQL, $enllac);
		
		$strSQL = "update COMPRA SET FECHA_FINAL = '$fecha1' where COD_COMPRA = $codCompra and ID_FABRICA ='$idFabrica'";
		$resultat5 = mysql_query($strSQL, $enllac);
		
		//$filas_afectadas = mysql_affected_rows($enllac);
		echo "CO: " .$fila3['COD_COMPRA']. " UDS: ".$fila3['CANTIDAD']." P: " . $p_final."<br>";
		//echo " " .$filas_afectadas;
	}
	echo "</td></tr>";
}
echo "<table>";
// 2nd turno
/*++++++++++++++++++++++++++++++++++++++++*/
echo "<h2>2º TURNO</h2>";
/*
$strSQL = " select NIF, ID_FABRICA, sum(CANTIDAD) unidades, sum(P_NETO*CANTIDAD) TNETO  from COMPRA where FECHA_COMPRA <= '$fecha2' and ";
$strSQL = $strSQL ."FECHA_COMPRA > '$fecha4' AND CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p group by NIF, ID_FABRICA";
*/
$strSQL = "select NIF, i.ID_FABRICA, sum(i.CANTIDAD) unidades, sum(i.P_NETO*i.CANTIDAD) TNETO from COMPRA c, ITEMS i where ";
$strSQL .= " c.COD_COMPRA = i.COD_COMPRA and FECHA_COMPRA <= '$fecha2' and ";
$strSQL = $strSQL ."FECHA_COMPRA > '$fecha4' AND CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p group by NIF, ID_FABRICA";


$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
echo "<table border='1' class='rounded' >";
echo "<tr class='curved-box-css3'><th >NIF</th><th>ID_FABRICA</th><th>UDS</th><th>P_NETO_1</th><th>P_NETO_M</th><th>MAX_U</th><th>P_FINAL</th><th>COMPRA</th></tr>";

while($fila=mysql_fetch_array($resultat)){
	$nif = $fila["NIF"];
	$idFabrica = $fila["ID_FABRICA"];
	$Tneto = $fila["TNETO"];
	//$codCompra = $fila["COD_COMPRA"];
	$strSQL = " select PVP,P_NETO_1,P_NETO_M,MAX_U_DES from PRODUCTO where NIF = '$nif' and ID_FABRICA = '$idFabrica'";
	
	$resultat2 = mysql_query($strSQL, $enllac);	
	echo "<tr><td>". $fila["NIF"] ."</td><td> ". $fila["ID_FABRICA"] ."</td><td> ".$fila["unidades"];
	$fila2=mysql_fetch_array($resultat2);
	echo "</td><td> " . $fila2["P_NETO_1"] ."</td><td> ". $fila2["P_NETO_M"] ."</td><td> ".$fila2["MAX_U_DES"];
	$p_neto=calcular_des($fila2["PVP"],$fila2["P_NETO_1"],$fila2["P_NETO_M"],$fila2["MAX_U_DES"], $fila["unidades"]);
	echo " </td><td>".$p_neto ."</td>";
	$strSQL = "select COD_COMPRA ,P_NETO, CANTIDAD from COMPRA where NIF = '$nif' and ID_FABRICA ='$idFabrica' and ";
	$strSQL = $strSQL ."FECHA_COMPRA <= '$fecha2' and FECHA_COMPRA > '$fecha1' AND CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p";
	
	$strSQL = "select i.COD_COMPRA,i.P_NETO, i.CANTIDAD from COMPRA c, ITEMS i where ";
	$strSQL .= " NIF = '$nif' and i.ID_FABRICA ='$idFabrica' and c.COD_COMPRA = i.COD_COMPRA and ";
	$strSQL = $strSQL ."FECHA_COMPRA <= '$fecha2' and FECHA_COMPRA > '$fecha1' AND ";
	$strSQL .= "CONFIRMADO = $confirmado AND CONFIRMADO_PROV = $confirmado_p";
	$resultat3 = mysql_query($strSQL, $enllac);
	echo "<td>";

	while($fila3=mysql_fetch_array($resultat3)){
		$p_final = $fila3['P_NETO'] - ($Tneto-$p_neto*$fila["unidades"])/$fila["unidades"];	
		$p_final = round($p_final,2);	
		$codCompra = $fila3["COD_COMPRA"];		
		$strSQL = "update ITEMS SET P_FINAL = $p_final where COD_COMPRA = $codCompra and ID_FABRICA ='$idFabrica'";
		$resultat4 = mysql_query($strSQL, $enllac);
		$strSQL = "update COMPRA SET FECHA_FINAL = '$fecha3' where COD_COMPRA = $codCompra and ID_FABRICA ='$idFabrica'";
		$resultat5 = mysql_query($strSQL, $enllac);
		//$filas_afectadas = mysql_affected_rows($enllac);
		echo "CO: " .$fila3['COD_COMPRA']. " UDS: ".$fila3['CANTIDAD']." P: " . $p_final."<br>";
		//echo " " .$filas_afectadas;
	}
	echo "</td></tr>";
}
echo "<table>";
mysql_close($enllac);
include("../productos/ActualizaProducto.php");
?> 
 <br><a href='javascript:history.back()'>Volver</a> 
