<head>
	<meta charset="UTF-8">
	<title>Sugerencias</title>
	<script>
		function comentar(valor) {
			var texto="";
			if(valor==0) texto="Categoría:\n";
			else if(valor==1) texto="Sucategoría: \n";
			else texto="Incidencias: \n";
			document.getElementById("comentarios").innerHTML=texto;
		}
	</script>
	
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!--
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
    -->
</head>
	<div class="container">
		<div class="row">
			<div class="span9">
				<form class="form-horizontal" method="post"  action="enviar_correo_contacto_prov.php">
					<fieldset>
						<legend>Sugerencias</legend>
                        <div class="control-group">
  							<label class="control-label">Busqueda</label>
  							<div class="controls">
                                <label class="radio inline">
                                <input type="radio" name="radios" value="1" checked="checked" onClick="comentar(0)">
                                Categoría
                                </label>
                                <br>
                                <label class="radio inline">
                                <input type="radio" name="radios" value="2" onClick="comentar(1)">
                                 Subcategoría
                                </label>
                                <br>
                                <label class="radio inline">
                                <input type="radio" name="radios" value="3" onClick="comentar(2)">
                                Incidencias
                                </label>
    						</div>
						</div>
                 		<div class="control-group">
							<label class="control-label" for="textarea">Comentarios</label>
							<div class="controls">
								<textarea class="form-control" id="comentarios" name ="comentarios" rows="6" required>Categoria:
								</textarea>
							</div>
						</div>
						<Input type="hidden"  NAME="nif" value="<?= $unif?>">
                        <Input type="hidden"  NAME="nombre" value="<?= $nombre?>">
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
