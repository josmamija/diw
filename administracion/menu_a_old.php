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
    <head></head>
    <body>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
	<link rel="stylesheet" rev="stylesheet" href="../styles/gesdesc.css" />
	<img src="../images/logoGesdesc.GIF" width="134" height="41" /><br />
	<p class="curved-box-css4">&nbsp;&nbsp;Administración</p>
	<div id="menu2" class="rounded" style="width:250">
            <span class="titulopetit">
            <ul>
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
            <li><a href="../administracion/login_admin.php">Inicio</a></li>
            </ul>
            </span>
	</div>
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