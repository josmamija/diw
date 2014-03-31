<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
<script>
		function comentar(valor) {
			var objc= document.getElementById("correo");
			objc.style.display="block";
			var texto="";
			if(valor==0) {
				var objp= document.getElementById("pwdr");
				var obju= document.getElementById("usuarior");
				var objd= document.getElementById("dnir");
				
				objp.style.display="none";
				obju.style.display="block";
				objd.style.display="none";
				
			}
			else if(valor==1) {
				var objp= document.getElementById("pwdr");
				var obju= document.getElementById("usuarior");
				var objd= document.getElementById("dnir");
				
				objp.style.display="block";
				obju.style.display="none";
				objd.style.display="none";
				
			}
			
			else {
				var objp= document.getElementById("pwdr");
				var obju= document.getElementById("usuarior");
				var objd= document.getElementById("dnir");
				
				objp.style.display="none";
				obju.style.display="none";
				objd.style.display="block";
				
			}
			
		}
	
    
function validar(f1) {
 		if ( (f1.emailr.value.indexOf ('.', 0) == -1)||(f1.emailr.value.indexOf ('@', 0) == -1)||(f1.emailr.value.length < 5)) { 
    		alert("Escriba una dirección de correo válida en el campo \"E-mail\"."); 
    		return (false); 
  		}
		return (true); 
}
    </script>
    
<div class="container">
	<div class="row">
		<div class="span6">
			<form class="form-horizontal" method="post"  action="../includes/recuperar.php" onSubmit="return validar(this)">
			<fieldset>
   			<legend>¿No puede iniciar sesión?</legend>
    		<br>
  	 		<div class="control-group">
                <label class="radio inline" >
                <input type="radio" name="radios" value="1"  onClick="comentar(0)">
                He olvidado mi contraseña.
                </label>
                <br>
                <label class="radio inline" >
                <input type="radio" name="radios" value="2" onClick="comentar(1)">
                He olvidado mi nombre de usuario.
                </label>
                <br>
                <label class="radio inline">
                <input type="radio" name="radios" value="3" onClick="comentar(2)">
                He olvidado contraseña y usuario.
                </label>
			</div>
    		<br>
            <div class="control-group" id = "usuarior"  style="display:none">
				<label for="usuarior" class="control-label"> Usuario:&nbsp;</label>
				<div class="controls" >
					<input type="text" name="usuarior">
				</div>
			</div>
            
            <div class="control-group" id = "pwdr"  style="display:none">
				<label for="pwdr" class="control-label"> Password:&nbsp;</label>
				<div class="controls" >
					<input type="text" name="usuarior">
				</div>
			</div>
            
            <div class="control-group" id = "dnir"  style="display:none">
				<label for="dnir" class="control-label"> NIF/CIF:&nbsp;</label>
				<div class="controls" >
					<input type="text" name="dnir">
				</div>
			</div>
            
            <div class="control-group" id = "correo"  style="display:none">
				<label for="emailr" class="control-label"> E-mail:&nbsp;</label>
				<div class="controls" >
					<input type="email" id="emailr" name ="emailr" size="30" MAXLENGTH="50"  required>
				</div>
			</div>
   			<Input type="hidden" name="desde" id ="dni" value="<?=$desde?>">
            <div class="form-actions">
				<button type="submit" class="btn btn-primary" NAME="accion">Enviar</button>
			</div>
			</fieldset>
			</form>
         </div>
     </div>
 </div>
<script src="../jquery/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>