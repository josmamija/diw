<?php session_start();?>
<!doctype html>
<html class="">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profesional</title>
<link href="../boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluit_menu_c.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
<script src="../respond.min.js"></script>
<script type="text/javascript" src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../js/nhpup_1.1.js"></script>
<?php
	if(!isset($_GET['dni'])){
		echo "NO esta autenticado";
		echo "<script language='javascript'>window.location='../clientes/menu_g_c2.php'</script>;"; 
        //header("Location:../clientes/menu_g_c.php");
	}
	$dni = $_GET['dni'];
	$idCliente = $_GET['idCliente'];
	if(isset($_GET['nombre'])){
		$nombre=$_GET['nombre'];
		$apellido =$_GET['apellido'];
		$_SESSION['nombre']=$nombre;
		$_SESSION['apellido']=$apellido;
	}else {	
		$nombre=$_SESSION['nombre'];
		$apellido=$_SESSION['apellido'];
	}
	$_SESSION['autenticado']  = 'SI';
 ?>
</head>
<body>
<div class="gridContainer clearfix">
  <div id="header">
   <br>
   <br>
  	<img src="../images/logo_gesdesc_n.jpg" width="400" height="140" /> 
  </div>
  <div id="menu" class="letramenu">  	
  	<span class="curved-box-css4">&nbsp;&nbsp;Profesional</span>
    <span class="letratext">&nbsp;&nbsp;<?=$nombre . " ".$apellido?></span>
  	<ol>
    	<li>
    		<a href="../clientes/menu_c2.php?go=0&dni=<?=$dni?>&idCliente=<?=$idCliente?>">INICIO</a>
  		</li>
  		<li>
    		<a href="../clientes/menu_c2.php?go=1&dni=<?=$dni?>&idCliente=<?=$idCliente?>">LISTADO DE PRECIOS</a>
  		</li>
        <li>
    		<a href="../clientes/menu_c2.php?go=5&dni=<?=$dni?>&idCliente=<?=$idCliente?>">LISTADO DE SERVICIOS</a>
  		</li>
      <li>
        <a href="../clientes/menu_c2.php?go=3&dni=<?=$dni?>&idCliente=<?=$idCliente?>">PEDIDOS PENDIENTES</a>
      </li>
   		<li>
   			<a href="../clientes/menu_c2.php?go=2&dni=<?=$dni?>">EDITAR PERFIL</a>
    	</li>
        
        <li>
            <?php
			 $mas ="Utilice este canal para <br>ayudarnos a <br>mejorar el servicio<br>";
			 $mas.="<br> En caso de no encontrar <br>un proveedor<br>";
			 $mas.="<br> En caso de no encontrar <br>un producto<br>";
			 $mas.="<br> En caso de no encontrar <br>un gremio<br>";
			 $mas.="<br> En caso de encontrar <br>incidencias<br>";
			 
			?> 
   			<a onmouseover="nhpup.popup(' <?=utf8_decode($mas)?>');" href="../clientes/menu_c2.php?go=4&dni=<?=$dni?>&idCliente=<?=$idCliente?>">SUGERENCIAS</a>
            
            
    	</li>
        <!--
        <li>
   			<a href="../clientes/menu_c2.php?go=3&dni=<?=$dni?>">INSTRUCIONES DE USO</a>
    	</li>
        -->
    	<li>
    		<a href="menu_g_c3.php">SALIR SESION</a>
  		</li>
    </ol>    
  </div>
  <div class="gridContainer clearfix" id="cuerpo">
  <hr>
  <?php
  	if (!isset($_GET['go'])) $opcion = 0;
	else $opcion=$_GET['go'];
//echo $_GET['go'];
//echo $opcion;
	switch ($opcion)
	{
		case 0:
		    echo "<div>";
		    include("../clientes/gremios2.php");
			echo "</div><br>";
			echo "<div>";
   			include("../clientes/instruciones_clie.php");
			echo "</div>";
			break;
		case 1:
			 $servicio =0;
 			include("../compras/alta_c_cat2.php");
			break;
			
		case 5:
		    $servicio =1;
 			include("../compras/alta_c_cat2.php");
			break;	
    case 3:
      include("../compras/list_pedido_clie.php");
      break;  
	case 2:
   		include("../clientes/modificar2.php");
		break;
		
	case 4:
   		include("../clientes/contacto.php");
		break;	
		/*
		case 3:
   		include("../clientes/instruciones_clie.php");
		break;
	*/
 	default:
 		include('../clientes/intro_clie.php');
}
 ?>
  </div>
  <br>
  <div id="footer">
  	<div style="background-color:#666">
		<span style="color:#FFF">gesdesc.com &copy; Politica de privacidad</span>
	</div>
  </div>
</div>
</body>
</html>
