<head>
	<meta charset="UTF-8">
	<title>Sugerencias</title>
	<script>
		function comentar(valor) {
			var texto="";
			if(valor==0) texto="Proveedor:\nRazon social:\nTelefono:\nE-mail:\nActividad:";
			else if(valor==1) texto="Articulo: \n";
			else if(valor==2) texto="Gremio: \n";
			else texto="Incidencias: \n";
			document.getElementById("comentarios").innerHTML=texto;
		}
	</script>
    <!--
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
    -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	
</head>
	<div class="container">
		<div class="row">
			<div class="span9">
				<form class="form-horizontal" method="post"  action="enviar_correo_contacto.php">
					<fieldset>
						<legend>Sugerencias</legend>
                        <!--
						<div class="control-group">
							<label class="control-label" for="nombre">Nombre</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="nombre" required>
								
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="email" >E-mail</label>
							<div class="controls">
								<input type="email" class="input-xlarge" id="email"placeholder="comercial@gesdesc.com" required>

							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="asunto">Asunto</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="asunto" required>			
							</div>
						</div>
						<!--
						<div class="control-group">
							<label class="control-label" for="fileInput">File input</label>
							<div class="controls">
								<input class="input-file" id="fileInput" type="file">
							</div>
						</div>
                        -->
                        
                        <div class="control-group">
  						<label class="control-label">Busqueda</label>
  						<div class="controls">
    						<label class="radio inline">
      						<input type="radio" name="radios" value="1" checked="checked" onClick="comentar(0)">
      						Proveedor
    						</label>
                            <br>
   							<label class="radio inline">
      						<input type="radio" name="radios" value="2" onClick="comentar(1)">
      						 Artículo
    						</label>
                            <br>
   							<label class="radio inline">
      						<input type="radio" name="radios" value="3" onClick="comentar(2)">
      						Gremio
    						</label>
                            <br>
                            <label class="radio inline">
      						<input type="radio" name="radios" value="3" onClick="comentar(3)">
      						Incidencias
    						</label>
    					</div>
					</div>
                        
                        
                        
						<div class="control-group">
							<label class="control-label" for="textarea">Comentarios</label>
							<div class="controls">
								<textarea class="form-control" id="comentarios" name ="comentarios" rows="6" required>Nombre Proveedor:
Razón social:
Teléfono:
E-mail:
Actividad:</textarea>
							</div>
						</div>
                        <Input type="hidden"  NAME="idCliente" value="<?= $idCliente?>">
						<Input type="hidden"  NAME="dni" value="<?= $dni?>">
						<div class="form-actions">
							<button type="submit" class="btn btn-primary" NAME="accion">Enviar</button>
							
						</div>
                        
					</fieldset>
				</form>
			</div>
		</div>
	</div>
    <!--
	<script src="../jquery/jquery.js"></script>
    -->
<script src="../bootstrap/js/bootstrap.js"></script>
