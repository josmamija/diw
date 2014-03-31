<?php
		$miNIF = $_GET["unif"];?>
		<form action ='../proveedores/menu_prov.php' method='get'>
		
       
			Codigo Producto: 
            <input type = "text" name = "cod_producto" size="15">
        	<Input type="hidden"  NAME="unif" value="<?= $miNIF?>">
            <Input type="hidden"  NAME="go" value="2">
       		<input type = "submit" name = "boto" value ="Enviar">
            <input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
		</form>
       

