<?php
		$miNIF = $_GET["unif"];?>
		
        <form action ='../proveedores/menu_prov.php' method='get'>
		    Porcentaje: 
            <input type = "text" name = "subida" size="6">%
        	<Input type="hidden"  NAME="unif" value="<?= $miNIF?>">
            <Input type="hidden"  NAME="go" value="12">
       		<input type = "submit" name = "boto" value ="Enviar">
            <input type="button" name="cancelar" value="Cancelar" onclick="history.back(-1);" />
		</form>
       

