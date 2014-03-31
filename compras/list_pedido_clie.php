<script type="text/javascript"> 

function novaFi_compra(enlace)  
{         
 var gatFinestra = window.open(enlace,"FinestraGat","resizable=no,width=460,height=400, top=120,left=100, resizable=1");  
   return false;    
}
</script> 
<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['autenticado'] == 'SI')) {
	include ("../Conexiones/conexion_local.php"); 
	/*
	$usuari ='fgarcia';
	$contrasenya ='fgarcia';
	$servidor ='localhost';
	$baseDatos ='gesdesc';
	*/
	//$dni = $_GET["dni"];
	//$dni="37212587W";
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
	mysql_select_db($baseDatos,$enllac);
	// COMPROBAR QUE EL SOCIO NO TENGA MAS DE 3 PRESTECS 
	$consulta = "select PROVEEDOR.NOMBRE, PROVEEDOR.NIF, COMPRA.* from COMPRA, PROVEEDOR WHERE ";
	$consulta .= " COMPRA.NIF = PROVEEDOR.NIF and CONFIRMADO = 1 and CONFIRMADO_PROV = 0 AND COMPRA.DNI ='$dni'"  ;
	$consulta .= " AND ENVIADO = 0";
	$resultat = mysql_query($consulta, $enllac);
	//echo "DNI : " . $dni;

	if (!$resultat) die('Error: ' . mysql_error());
	else {
  		$count=mysql_num_rows($resultat);
  		if($count < 1) echo "* NO TIENE PEDIDOS PENDIENTES";
  		else {
			echo "<span class='cabecera'> PEDIDOS PENDIENTES DE CONFIRMAR POR EL PROVEEDOR</span><br><br>";
			$sCadena= "<TABLE BORDER=0 class='rounded'>";
			$sCadena=$sCadena . "<TR class='curved-box-css3'>";
			$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;PEDIDO&nbsp;</TD>";
			//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;DNI&nbsp;</TD>";
	 		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;PROVEEDOR&nbsp;</TD>";
			//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;NIF&nbsp;</TD>";
			$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;FECHA_COMPRA&nbsp;</TD>";
			//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;FECHA_CIERRE&nbsp;</TD>";
			$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;Anular&nbsp;</TD>";
			$sCadena=$sCadena . "</TR>";
			echo $sCadena;
			$linea=0;
			$ico = "<img src='../images/cancel.GIF' width='15 height='15' />";
	    	while($fila=mysql_fetch_array($resultat)){
				$compra=$fila['COD_COMPRA'];
				$enlace_compra="../administracion/consulta_compra.php?compra=".$compra;
				
				
				if($linea%2==0) $sCadena= "<tr bgcolor='#D5FFFA'>";
				else  $sCadena= "<tr>";	
				$linea++;
				//$sCadena.="<td title='Ver detalle'><a href ='../administracion/consulta_compra_clie.php?compra=".$compra."' target =_new'>".$compra."</a></td>";
				
				
				$sCadena.="<td title='Ver detalle'><a href='#' onclick=\"novaFi_compra('".$enlace_compra ."')\">".$compra."</a></td>";
				
				
				//$sCadena .= "<td class='Estilo1'>&nbsp;" . $fila["DNI"] . "</td>";
				$sCadena= $sCadena . "<td class='Estilo1'>&nbsp;" . $fila["NOMBRE"] . "</td>";
				//$sCadena .= "<td class='Estilo1'>&nbsp;" . $fila["NIF"] . "</td>";
	   			$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["FECHA_COMPRA"] . "&nbsp;</td>";
				//$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["FECHA_FINAL"] . "&nbsp;</td>";
				//$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["VISITAS"] . "&nbsp;</td>";
				$sCadena.= "<td class='Estilo1' > <a href='../compras/anular_pedido.php?compra=$compra' onclick=\"return confirm('¿Está seguro de borrar pedido?');\">" . $ico . "</a></td>";
	   			
			
				
				$sCadena=$sCadena . "</TR>";
				echo $sCadena;
	 		}
			echo "</table>";
			echo "<br>";
		}	
		mysql_close($enllac);
	}
}else{ // autorizacion
//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../clientes/menu_g_c2.php> Login</a>";

}
?>
 
		

