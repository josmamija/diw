<head>
	<meta charset="UTF-8">
	<title>Datos bancarios</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
</head>
	<div class="container">
		<div class="row">
			<div class="span12">
				<form class="form-horizontal span12" method="post" action="../includes/enviarDatosBanco.php">
				<fieldset>
				<legend>Datos bancarios</legend>
 
				<div class="control-group">
					<label class="control-label">Titular</label>
					<div class="controls">
						<input type="text" class="input-block-level" name="titular" pattern="\w+\w+.*" title="Titular" value="<?= $_GET['nombre']?>" required>
					</div>
				</div>
                
                <div class="control-group">
					<label class="control-label">NIF/CIF</label>
					<div class="controls">
						<input type="text" class="input-block-level" name="nif" maxlength="9" title="NIF/CIF" value="<?=$_GET['nif']?>" required>
					</div>
				</div>
 
				<div class="control-group">
					<label class="control-label">Código de cuenta</label>
					<div class="controls">
						<div class="row-fluid">
							<div class="span3">
								<input type="text" class="input-block-level" name="entidad" autocomplete="off" size ="4"maxlength="4" pattern="\d{4}" title="Entidad" required>
							</div>
							<div class="span3">
								<input type="text" class="input-block-level" name="oficina" autocomplete="off"  size ="4" maxlength="4" pattern="\d{4}" title="Oficina" required>
							</div>
					  		<div class="span2">
								<input type="text" class="input-block-level" name="control" autocomplete="off" size ="2" maxlength="2" pattern="\d{2}" title="Control" required>
							</div>
							<div class="span4">
								<input type="text" class="input-block-level" name="cuenta" autocomplete="off" size ="10" maxlength="10" pattern="\d{10}" title="Número de cuenta" required>
							</div>
						</div>
					</div>
				</div>
 			<div class="form-actions">
                <Input type="hidden"  NAME="emailb" value="<?= $emailb?>">
				<button  type="submit" NAME="accion" class="btn btn-primary">Submit</button>
				<button type="button" class="btn" onclick="history.back(-1);">Cancel</button>
			</div>
            
            
			</fieldset>
		</form>
		</div>
	</div>
</div>
<script src="../jquery/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
