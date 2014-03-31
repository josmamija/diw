 <?php
 

extract ($_REQUEST);//Esto extrae todas las variables del formulario

 $xml1 = "<?xml version='1.0' encoding='utf-8'?>" .$xml;
// Obtener el valor del login que se quiere comprobar
 $xml1 = simplexml_load_string($xml1) or die("Error: Can not create object");
 $nif = $xml1->nif;

 //$nif="A64207400";
 include ("../Conexiones/conexion_local.php");
$enllac = mysql_connect($servidor,$usuari,$contrasenya);
mysql_select_db($baseDatos,$enllac);
mysql_set_charset('utf8');
$strSQL = " select * from PROVEEDOR where NIF = '$nif'";
$resultat2 = mysql_query($strSQL, $enllac); 
$count=mysql_num_rows($resultat2);

/*
 if($count==1)echo "* Usuario ya existe!!!";
 else echo "" ;

*/
$fila=mysql_fetch_assoc($resultat2);
$idprovincia = $fila['PROVINCIA'];
$idpoblacion = $fila['LOCALIDAD'];
//echo $idprovincia;

//exit();
$strSQL = "select poblacion FROM poblacion where idprovincia = " . $idprovincia .  " AND idpoblacion  =" .$idpoblacion ;
$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
$fila2=mysql_fetch_assoc($resultat);
$poblacion=$fila2['poblacion'];

$strSQL = "select * FROM provincia where idprovincia = " . $idprovincia ;
$resultat = mysql_query($strSQL, $enllac);
if (!$resultat)  die('Error: ' . mysql_error());
 

 
$fila2=mysql_fetch_assoc($resultat);
$provincia =$fila2['provincia'];
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
$link_ofertas=$fila['LINK_OFERTAS']==NULL ? '#': $fila['LINK_OFERTAS'];
$direccion=$fila['DIRECCION'];
$telefono=$fila['TELEFONO'];
$movil=$fila['MOVIL'];
$theValue = ($telefono != "") ? $telefono : $movil;
echo "<proveedores> \n";
    echo "\t <proveedor> \n".
		"\t\t <nombre>".utf8_decode($fila['NOMBRE']) ."</nombre> \n".
       "\t\t <provincia>".$provincia ."</provincia> \n".
	   " \t\t <poblacion>". utf8_decode($poblacion) ."</poblacion> \n".
	   "\t\t <direccion>".$direccion ."</direccion> \n".
	   " \t\t <telefono>". $theValue ."</telefono> \n".
	   " \t\t <link_ofertas>". utf8_decode($link_ofertas) ."</link_ofertas> \n".
      "\t </proveedor> \n";
echo "</proveedores> \n";


/* 
 $dom = new DomDocument;
 $dom->loadXML($xml);
 foreach ($dom->documentElement->childNodes as $logins){
 	if($logins->nodeName == "login") {
 		$login=$logins->textContent;
 	}
 	
 }
}
*/

mysql_close($enllac);
?>
