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
				<form class="form-horizontal span6">
				<fieldset>
				<legend>Pago</legend>
 
				<div class="control-group">
					<label class="control-label">Nombre que figura en la targeta</label>
					<div class="controls">
						<input type="text" class="input-block-level" pattern="\w+ \w+.*" title="Introduzca su nombre y apellidos" required>
					</div>
				</div>
 
				<div class="control-group">
					<label class="control-label">Card Number</label>
					<div class="controls">
						<div class="row-fluid">
							<div class="span3">
								<input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Primeros cuatro dígitos" required>
							</div>
							<div class="span3">
								<input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="segundo cuatro digitos" required>
							</div>
							<div class="span3">
								<input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Terceros cuatro digitos" required>
							</div>
							<div class="span3">
								<input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Cuarto cuatro digitos" required>
							</div>
						</div>
					</div>
				</div>
 
				<div class="control-group">
					<label class="control-label">Fecha expiracion de su targeta</label>
					<div class="controls">
						<div class="row-fluid">
							<div class="span9">
								<select class="input-block-level">
									<option>January</option>
									<option>...</option>
									<option>December</option>
								</select>
							</div>
							<div class="span3">
								<select class="input-block-level">
									<option>2013</option>
									<option>2014</option>
									<option>2015</option>
								</select>
							</div>
						</div>
					</div>
				</div>
 
				<div class="control-group">
					<label class="control-label">Targeta CVV</label>
					<div class="controls">
						<div class="row-fluid">
							<div class="span3">
								<input type="text" class="input-block-level" autocomplete="off" maxlength="3" pattern="\d{3}" title="Los tres digitos  de la parte  reversa de su targeta" required>
							</div>
						<div class="span8">
						<!-- screenshot may be here -->
						</div>
					</div>
				</div>
			</div>
 
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="button" class="btn">Cancel</button>
			</div>
			</fieldset>
		</form>
		</div>
	</div>
</div>
<script src="../jquery/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
