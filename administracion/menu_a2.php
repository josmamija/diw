<?php
	session_start();
	//echo "hola"; exit();
	//echo $_SESSION['usuario']. " ". $_SESSION['autenticado'];
	//exit();
	if (isset($_GET['usuario']) || $_SESSION['autenticado'] == 'SI') {
		if(!isset($_SESSION['autenticado'])) $_SESSION['autenticado'] = 'SI';
		if(!isset($_SESSION['usuario'])) $_SESSION['usuario']=$_GET['usuario'];
		session_write_close();	
 ?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Administracion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
</head>
<body>
    <div class="container">
    	<div class="row">
			<div class="span9">
            	<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
                <ul class="nav nav-list">
                <li class="nav-header"><span class="curved-box-css4">Administración</span></li>
                <li><a href="../compras/calculo_desc.php" >Calculo descuento</a></li>
                <li><a href="../administracion/validacion_clie.php" >Activación cliente</a></li>
                <li><a href="../administracion/validacion_prov.php" >Activacion proveedor</a></li>
                <li><a href="../clientes/listado.php" >Listado clientes</a></li>
                <li><a href="../proveedores/listado_prov.php">Listado proveedores</a></li>
                <li><a href="../compras/listado_compras_clie.php">Compras pendientes</a></li>
                <li><a href="../administracion/envio_co_compra.php">Envio codigo compra</a></li>
                <li><a href="../administracion/consulta_compra.php" target="_blank">Consulta compra</a></li>
                <li><a href="../categorias/cat_edit.php">Crear categorias</a></li>
                <li><a href="../categorias/subcat_insert.php">Crear subcategorias</a></li>
                <li><a href="../gremios/grenio_edit.php">Crear gremio</a></li>
                <li><a href="../administracion/login_admin.php">Login</a></li>
                </ul>
            </div>
		</div>
    </div>
   <script src="../jquery/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>

</body>  
</html>
<?php
		
    }else{
	
   //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la 
    //pantalla de login, enviando un codigo de error
	echo "NO esta autenticado";
	echo "<script language='javascript'>window.location='../administracion/login_admin.php'</script>;"; 
    
    //header("Location:../administracion/login_admin.php");
}
?>