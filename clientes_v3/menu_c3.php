<?php session_start();?>
<!doctype html>
<html class="">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Precios profesional</title>
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="../fluit_menu_c3.css" rel="stylesheet" type="text/css">
<link href="../styles/gesdesc.css" rel="stylesheet" type="text/css">
<script src="respond.min.js"></script>
<?php
	if(!isset($_GET['dni'])){
		echo "NO esta autenticado";
		echo "<script language='javascript'>window.location='../clientes/menu_g_c3.php'</script>;"; 
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
  	<img src="../images/logo_gesdes.jpg" width="334" height="176" /> 
  </div>
  <div id="menu" class="letramenu">
  	
  	<p class="curved-box-css4">&nbsp;&nbsp;Profesional</p>
    <p class="letratext">&nbsp;&nbsp;<?=$nombre . " ".$apellido?></p>
  	<ol>
    	<li>
    		<a href="../clientes/menu_c3.php?go=0&dni=<?=$dni?>&idCliente=<?=$idCliente?>">INICIO</a>
  		</li>
  		<li>
    		<a href="../clientes/menu_c3.php?go=1&dni=<?=$dni?>&idCliente=<?=$idCliente?>">LISTADO DE PRECIOS</a>
  		</li>
      <li>
        <a href="../clientes/menu_c3.php?go=3&dni=<?=$dni?>&idCliente=<?=$idCliente?>">PEDIDOS PENDIENTES</a>
      </li>
   		<li>
   			<a href="../clientes/menu_c3.php?go=2&dni=<?=$dni?>">EDITAR PERFIL</a>
    	</li>
        <!--
        <li>
   			<a href="../clientes/menu_c3.php?go=3&dni=<?=$dni?>">INSTRUCIONES DE USO</a>
    	</li>
        -->
    	<li>
    		<a href="menu_g_c3.php">SALIR SESION</a>
  		</li>
    </ol>    
  </div>
  
   

 
  <?php
  	if (!isset($_GET['go'])) $opcion = 0;
	else $opcion=$_GET['go'];
//echo $_GET['go'];
//echo $opcion;
	switch ($opcion)
	{
		case 0:
		   echo '<div id="gremio" class="rounded"  style="background-color: #E0E0E0 ">';
		    include("../clientes/gremios.php");
			echo "</div>";
			
			echo "<div id='cuerpo'>";
			include("../clientes/instruciones_clie.php");
			echo "</div><br>";
			
			break;
		case 1:
			echo "<div id='cuerpo'>";
 			include("../compras/alta_c_cat3.php");
			echo "</div>";
			break;
    case 3:
		echo "<div id='cuerpo'>";
      include("../compras/list_pedido_clie.php");
	  echo "</div>";
      break;  
	case 2:
		echo "<div id='cuerpo'>";
   		include("../clientes/modificar3.php");
		echo "</div>";
		break;
		/*
		case 3:
   		include("../clientes/instruciones_clie.php");
		break;
	*/
 	default:
		echo "<div id='cuerpo'>";
 		include('../clientes/intro_clie.php');
		echo "</div>";
}
 ?>
</div>
  <br>
  <br>
  <div id="footer">
  	<div style="background-color:#666">
		<span style="color:#FFF">gesdesc.com &copy; Politica de privacidad</span>
	</div>
  </div>

</div>

</body>
</html>
