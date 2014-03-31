<?php
session_start();
if (isset($_SESSION['nif']) && ($_SESSION['autenticado'] == 'SI')) {
	$nif = $_GET["unif"];
?>
    <form action ='../proveedores/menu_prov.php' method='get'>
    	Código de la compra:&nbsp;<INPUT TYPE="text" name="compra" style="color: #00F">		
		<Input type="hidden" name="unif" value="<?=$nif?>">
        <Input type="hidden"  NAME="go" value="5">
		<INPUT TYPE="submit" name = "boto" VALUE="Aceptar">
        <input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
	</form>
	<?php
	
} else{ // autenficacion
	echo "NO esta autenticado";
    //header("Location:../administracion/login_admin.php");
	echo "<a href=../proveedores/menu_g_p.php> Login</a>";
}
 ?>
