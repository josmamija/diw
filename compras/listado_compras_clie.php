<HTML>
<HEAD><TITLE>Listado compras pendientes confirmar proveedor</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />  
<script type="text/javascript"> 
function novaFi(enlace)  
{         
 var gatFinestra = window.open(enlace,"FinestraGat","resizable=1,width=340,height=200, top=120,left=100");  
   return false;    
}

function novaFi_compra(enlace)  
{         
 var gatFinestra = window.open(enlace,"FinestraGat","resizable=1,width=460,height=400, top=120,left=100");  
   return false;    
}
</script> 
</HEAD>
<BODY>
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
	$enllac = mysql_connect($servidor,$usuari,$contrasenya);
	mysql_select_db($baseDatos,$enllac);
	// COMPROBAR QUE EL SOCIO NO TENGA MAS DE 3 PRESTECS 
	$consulta = "select PROVEEDOR.NOMBRE, PROVEEDOR.NIF, COMPRA.* from COMPRA, PROVEEDOR WHERE ";
	$consulta .= " COMPRA.NIF = PROVEEDOR.NIF and CONFIRMADO = 1 and CONFIRMADO_PROV = 0" ;
	$resultat = mysql_query($consulta, $enllac);
	//echo "DNI : " . $dni;

	if (!$resultat) die('Error: ' . mysql_error());
	else {
		echo "<span class='cabecera'> LISTADO DE PEDIDOS PENDIENTES DE CONFIRMAR POR EL PROVEEDOR</span><br>";
		$sCadena= "<TABLE BORDER=0 class='rounded'>";
		$sCadena=$sCadena . "<TR class='curved-box-css3'>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;COD_COMPRA&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;DNI&nbsp;</TD>";
 		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;PROVEEDOR&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;NIF&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;FECHA_COMPRA&nbsp;</TD>";
		//$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;FECHA_CIERRE&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;VISITAS&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;&nbsp;</TD>";
		$sCadena=$sCadena . "<TD class='Estilo1'>&nbsp;&nbsp;</TD>";
		
		$sCadena=$sCadena . "</TR>";
		echo $sCadena;
		$linea=0;
		$ico_borrar = "<img src='../images/cancel.GIF' width='15 height='15' />";
		$ico_calendario = "<img src='../images/calendar.jpg' width='15' height='15' />";
    	while($fila=mysql_fetch_array($resultat)){
			$unif= $fila["NIF"];
			$nombre=$fila["NOMBRE"];
			$compra=$fila['COD_COMPRA'];
			$enlace="../proveedores/calendario_leer.php?unif=$unif&nombre=$nombre";
			$enlace_compra="../administracion/consulta_compra.php?compra=".$compra;
			
			
			if($fila["ENVIADO"]==0) $ico = "<img src='../images/send.png' width='15 height='15' />";
			else  $ico = "<img src='../images/receive.jpg' width='15' height='15' />";
   			if($linea%2==0) $sCadena= "<tr bgcolor='#D5FFFA'>";
			else  $sCadena= "<tr>";	
			$linea++;
			//$sCadena.="<td title='Ver detalle'><a href ='../administracion/consulta_compra.php?compra=".$compra."' target =_new'>".$compra."</a></td>";
			$sCadena.="<td title='Ver detalle'><a href='#' onclick=\"novaFi_compra('".$enlace_compra ."')\">".$compra."</a></td>";
			
			$sCadena .= "<td class='Estilo1'>&nbsp;" . $fila["DNI"] . "</td>";
			$sCadena= $sCadena . "<td class='Estilo1'>&nbsp;" . $fila["NOMBRE"] . "</td>";
			$sCadena .= "<td class='Estilo1'>&nbsp;" . $fila["NIF"] . "</td>";
   			$sCadena=$sCadena . "<td class='Estilo1'>&nbsp;" . $fila["FECHA_COMPRA"] . "&nbsp;</td>";
			//$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["FECHA_FINAL"] . "&nbsp;</td>";
			$sCadena.= "<td class='Estilo1'>&nbsp;" . $fila["VISITAS"] . "&nbsp;</td>";
			$sCadena.= "<td title='Enviar correo' > <a href='../administracion/envio_co_compra.php?compra=$compra'>" . $ico . "</a></td>";
			$sCadena.= "<td title='Ver calendario proveedor'> <a href='#' onclick=\"novaFi('".$enlace ."')\">".$ico_calendario ."</a></td>";
			//$sCadena.= "<td title='Borrar pedido' > <a href='../compras/anular_pedido.php?compra=$compra'>" . $ico_borrar . "</a></td>";
			
			$sCadena.= "<td title='Borrar pedido' > <a href='../compras/anular_pedido.php?compra=$compra' onclick=\"return confirm('¿Está seguro de borrar pedido?');\">" . $ico_borrar . "</a></td>";
			
			$sCadena=$sCadena . "</TR>";
			echo $sCadena;
 		}
		echo "</table>";
		mysql_close($enllac);
	}
}else{ // autorizacion
//En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../administracion/login_admin.php> Login</a>";

}
?>
 <div id ="detalle"></div>
 <br><a href='../administracion/menu_a.php'>Inicio</a>>><a href='javascript:history.back()'>Volver</a> 
</BODY>
</HTML>
		

