<?php
extract ($_REQUEST);//Esto extrae todas las variables del formulario
$dom = new DomDocument;
$dom->loadXML($xml);
include ("../Conexiones/conexion_local.php"); 
$enlace = mysql_connect($servidor,$usuari,$contrasenya)or die("cannot connect");
mysql_select_db($baseDatos, $enlace)or die("cannot select DB" );
mysql_query("SET NAMES UTF8",$enlace);
$resp="no";
foreach ($dom->documentElement->childNodes as $facturas){
	if($facturas->nodeName == "factura") {
		foreach ($facturas->childNodes as $lafactura){
			if(($lafactura->nodeType ==1) && ($lafactura->nodeName == "dni")) {
 				$dni=$lafactura->textContent;
			}
			if(($lafactura->nodeType ==1) && ($lafactura->nodeName == "nif")) {
 				$nif=$lafactura->textContent;
			}
			if($lafactura->nodeName == "items") {
				//echo "<br>".$dni." ".$nif;
				$codcompra=insertarcompra($dni,$nif,$enlace);
				unset($dni);
     			unset($nif);
 				foreach ($lafactura->childNodes as $items){
					if($items->nodeName == "item") {
						foreach ($items->childNodes as $elitem){
							if(($elitem->nodeType ==1) && ($elitem->nodeName == "idfabrica")) {
 								$idfabrica=$elitem->textContent;
							}
							if(($elitem->nodeType ==1) && ($elitem->nodeName == "cantidad")) {
 								$cantidad=$elitem->textContent;
							}
							if(($elitem->nodeType ==1) && ($elitem->nodeName == "pvp")) {
 								$pvp=$elitem->textContent;
							}
							if(($elitem->nodeType ==1) && ($elitem->nodeName == "pneto")) {
 								$pneto=$elitem->textContent;
							}
						}
						//echo "<br>". $idfabrica." ".$cantidad." ".$pvp." ".$pneto;
						insertaritems($codcompra,$idfabrica,$cantidad,$pvp,$pneto,$enlace);
						unset($idfabrica);
     					unset($cantidad);
     					unset($pvp);
     					unset($pneto);	
					}
				}
			}
 		}
	}
 }

 function insertarcompra($dni,$nif,$enlace){
	$confirmado =1;
	$fecha_actual = date("Y-m-d H:i:s");
	$sql="INSERT INTO COMPRA (
 		 DNI, NIF, FECHA_COMPRA, CONFIRMADO)
		  VALUES ('". $dni."','".$nif."','".$fecha_actual."',".$confirmado.")";
 		$resultat = mysql_query($sql,$enlace);
 	if (!$resultat) die('Error: ' . mysql_error());
 	else {
		$codcompra= mysql_insert_id($enlace);
	}
	return $codcompra;
}

function insertaritems($codcompra,$idfabrica,$cantidad,$pvp,$pneto,$enlace){
	
 	$sql="INSERT INTO ITEMS (
 		 COD_COMPRA, ID_FABRICA, CANTIDAD, PVP, P_NETO)
		  VALUES ('" 
 		. $codcompra . "','" 
 		. $idfabrica . "','" 
 		. $cantidad  . "','" 
 		. $pvp . "','" 
 		. $pneto . "')";
 		$resultat = mysql_query($sql,$enlace);
 	if (!$resultat) die('Error: ' . mysql_error());
}
$resp="si";
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
 	echo "<resposta> \n".
       "\t <disponible>".$resp."</disponible> \n".
       "</resposta>";  
	   
?>