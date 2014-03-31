<?php
if (!isset($_GET['unif']) || $_GET['unif']==""  )
{
  	echo "NO esta autenticado";
	//exit();
    echo "<script language='javascript'>window.location='../proveedores/menu_g_p2.php'</script>;"; 
	//header("Location:../proveedores/login_prov.php");
	exit();
}
session_start();
$unif = $_GET['unif'];
include("../proveedores/get_idProveedor.php");
if(!isset($_GET['nombre'])) {
	
	$_SESSION['nombre']=$nombre;
}
else $_SESSION['nombre']=$_GET['nombre'];
$_SESSION['nif']= $_GET['unif'];
$_SESSION['autenticado']= 'SI';
$_SESSION['idProveedor']=$_GET['idProveedor'];
$nombre =$_SESSION['nombre'];
//echo "idproveedor:" .$idProveedor;
/*
if(!isset($_GET['idProveedor'])) {
  include("../proveedores/get_idProveedor.php");
}else {
	$id_proveedor = $_GET['idProveedor'];
}
*/
//echo " NIF : " . $unif ;
//echo " <BR> ID_PROVEEDOR : " . $id_proveedor ;
 ?>
 
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Proveedor</title>

<link href="../boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluitgesdesc.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
<script src="../respond.min.js"></script>
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
-->

<script type="text/javascript" src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../js/nhpup_1.1.js"></script>

</head>
<body>

<div class="gridContainer clearfix">
  <div id="header">
     <p>
     <br>
     <br>
     <br>
     <br>
      <img src="../images/logo_gesdesc_n.jpg"  />
     <!--
     <img src="../images/logo_gesdesc_n.jpg" width="400" height="130" />
     -->
     </p>
  </div>
  <div id="menu" class="letramenu">
    <span class="curved-box-css4">&nbsp;&nbsp;Proveedor</span>
    <span class="letratext">&nbsp;&nbsp;<?=$nombre?></span>
   <ol>
   <li>
   	<a href="../proveedores/menu_prov.php?go=0&unif=<?=$unif?>&nombre=<?=$nombre?>">INICIO</a>
   </li>
   <li>
   	<a href="../proveedores/menu_prov.php?go=7&unif=<?=$unif?>&nombre=<?=$nombre?>">ALTA ARTICULO</a> 
   </li>
   <li>
   	<a href="../proveedores/menu_prov.php?go=13&unif=<?=$unif?>&nombre=<?=$nombre?>">ALTA SERVICIO</a> 
   </li>
   <li>
   	<a href="../proveedores/menu_prov.php?go=1&unif=<?=$unif?>&nombre=<?=$nombre?>">EDITAR ARTICULO</a>
	</li>
    <li>
    	<a href="../proveedores/menu_prov.php?go=3&unif=<?=$unif?>">LISTAR ARTICULOS</a>
    </li>
    <li>
    	<a href="../proveedores/menu_prov.php?go=4&unif=<?=$unif?>">CONFIRMAR PEDIDOS</a>
    </li>
   
    <li>
    <a href="../proveedores/menu_prov.php?go=8&unif=<?=$unif?>&nombre=<?=$nombre?>">EDITAR PERFIL</a>
    </li>  
    <li>
    	<a href="../proveedores/menu_prov.php?go=6&unif=<?=$unif?>">CALENDARIO FESTIVOS</a>
    </li> 
     <li>
     <?php
			 $mas ="Utilice esta opci&oacute;n para realizar una subida general de los <br>precios de todos sus art&iacute;culos<br>";
			 $mas.="<br> Si desea realizar una bajada de precios. Introduzca un porcentaje negativo<br>";
			 $mas.="<br> La variaci&oacute;n de los precios ser&aacute; efectiva";
			 $mas.=" una vez aplicados los descuentos de los pedidos pendientes<br>";
			 
			?> 
    	<a onmouseover="nhpup.popup(' <?=utf8_decode($mas)?>');" href="../proveedores/menu_prov.php?go=11&unif=<?=$unif?>">ACTUALIZAR PRECIOS</a>
    </li> 
     <li>
   	<a href="../proveedores/menu_prov.php?go=9&unif=<?=$unif?>&nombre=<?=$nombre?>">CONDICIONES DE VENTA</a>
   </li> 
   <li>
            <?php
			 $mas ="Utilice este canal para <br>ayudarnos a <br>mejorar el servicio<br>";
			 $mas.="<br> En caso de no encontrar <br>una categor&iacute;a<br>";
			 $mas.="<br> En caso de no encontrar <br>una subcategor&iacute;a<br>";
			 $mas.="<br> En caso de encontrar <br>alguna incidencia<br>";
			 
			?> 
   			<a onmouseover="nhpup.popup(' <?=utf8_decode($mas)?>');" href="../proveedores/menu_prov.php?go=10&unif=<?=$unif?>&nombre=<?=$nombre?>">SUGERENCIAS</a>
            
            
    	</li>
   
    <li>
    	<a href="../proveedores/menu_g_p3.php">SALIR SESION</a>
    </li>
</ol>
</div>
<div id = "cuerpo"  align="left" class="letratext">

<?php
if (!isset($_GET['go'])) $opcion = 0;
else $opcion=$_GET['go'];
//echo $_GET['go'];
//echo $opcion;
if(isset($_GET['texto'])) echo $_GET['texto'];
switch ($opcion)
{
	case 0:
   		include("../proveedores/instrucciones_prov2.php");
		break;
	case 1:
 		include("../productos/SelecModi_t.php");
		break;
	case 2:
   		include("../productos/modificar_t.php");
		break;
	case 3:
		
 		include("../productos/listado_t.php");
		break;
	
 	case 4:
 		include("../compras/select_compra.php");
		break;
 	case 5:
 		if  (isset($_GET['boto'])) {
 			include("../compras/gestion_compra_p.php");
 		}
		break;
 	case 6:
		
		include("../proveedores/calendario.php");
 		break;
	case 7:
		$servicio =0;
		include("../productos/alta_t_cat.php");
 		break;	
	case 13:
		$servicio =1;
		include("../productos/alta_t_cat.php");
 		break;		
	case 8:
		include("../proveedores/modificar_p2.php");
 		break;
	case 9:
   		include("../proveedores/cond_venta.php");
		break;	
	case 10:
   		include("../proveedores/contactoprov.php");
		break;
	case 11:
   		include("../productos/subida.php");
		break;	
	case 12:
   		include("../productos/ActualizaPrecios.php");
		break;					
	default:
 		include('../proveedores/instrucciones_prov2.php');
}
 ?>

<br />
	<div style="background-color:#666">
		<span style="color:#FFF">gesdesc.com &copy; Politica de privacidad</span>
    </div>
</div>

</div>
</body>
</html>