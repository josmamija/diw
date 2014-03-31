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
    

<form  method="post"  action="../includes/recuperar.php" onSubmit="return validar(this)">
	<fieldset>
	<legend>¿No puede iniciar sesión?</legend>
    <br>
  	
  	<div >
    <label >
    <input type="radio" name="radios" value="1"  onClick="comentar(0)">
    He olvidado mi contraseña.
    </label>
    <br>
   	<label >
    <input type="radio" name="radios" value="2" onClick="comentar(1)">
   	He olvidado mi nombre de usuario.
   	</label>
    <br>
   	<label >
    <input type="radio" name="radios" value="3" onClick="comentar(2)">
    He olvidado contraseña y usuario.
    </label>
	</div>
    <br>
	<div id = "usuarior"  style="display:none">
    Usuario:&nbsp; 
	<input type="text" name ="usuarior" />
     <br>
	</div>
   
	<div id="pwdr" style="display:none">    
    	Password:
    	<input  type="password" name ="pwdr" />
         <br>
	</div>
   
	<div id ="dnir" style="display:none">  
		DNI/NIF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
    	<input type="text" name ="dnir" />
         <br>
	</div> 
  
	<div id ="correo" style="display:none">  
		<label for="emailr" >E-mail:&nbsp;&nbsp;</label>
		<input type="emailr"  id="emailr" name ="emailr" size="30" MAXLENGTH="50"  required>
	</div>    
  <Input type="hidden" name="desde" id ="dni" value="<?=$desde?>">
<button type="submit"  NAME="accion">Enviar</button>
	</fieldset>
</form>