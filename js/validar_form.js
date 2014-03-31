// Comprueba si es un DNI correcto (entre 5 y 8 letras seguidas de la letra que corresponda).
// Acepta NIEs (Extranjeros con X, Y o Z al principio)
function isDNI(dni) {
	var numero, let, letra;
	var expresion_regular_dni = /^[XYZ]?\d{5,8}[A-Z]$/;
 
	dni = dni.toUpperCase();
 
	if(expresion_regular_dni.test(dni) === true){
		numero = dni.substr(0,dni.length-1);
		numero = numero.replace('X', 0);
		numero = numero.replace('Y', 1);
		numero = numero.replace('Z', 2);
		let = dni.substr(dni.length-1, 1);
		numero = numero % 23;
		letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
		letra = letra.substring(numero, numero+1);
		if (letra != let) {
			alert('DNI erroneo, la letra del NIF no se corresponde');
			return false;
		}else{
			//alert('Dni correcto');
			return true;
		}
	}else{
		alert('DNI erroneo, formato no válido');
		return false;
	}
}

function isValidCif(abc){
	par = 0;
	non = 0;
	letras = "ABCDEFGHKLMNPQS"; 
	let = abc.charAt(0);   
	
	if (abc.length!=9) {
	  alert('El CIF debe tener 9 dígitos'); 
	  return false; 
	}
	
	if (letras.indexOf(let.toUpperCase())==-1) 
	{ 
		alert("El comienzo del CIF no es válido"); 
		return false; 
	}   
	for (zz=2;zz<8;zz+=2) { 
		par = par+parseInt(abc.charAt(zz)); 
	}   
	for (zz=1;zz<9;zz+=2) { 
		nn = 2*parseInt(abc.charAt(zz)); 
		if (nn > 9) nn = 1+(nn-10);
	 	non = non+nn; 
	}   
	parcial = par + non; 
	control = (10 - ( parcial % 10)); 
	if (control==10) control=0;   
	if (control!=abc.charAt(8)) { 
		alert("El CIF no es válido"); 
		return false; 
	} 
	alert("El CIF es válido"); 
	return true; 
}



function compruebaCambio() {
	
	
	if(f1.usuario.value != f1.usuario_old.value){
		//alert("hola");
	    compruebaValido();
	}
	
}


function deshabilita()
{
    if(document.getElementById('condicion').checked)
    {
        document.getElementById('registrarse').disabled=false;
    }
    else
    {
        document.getElementById('registrarse').disabled=true;
    }
}

function validate_link(enlace) {
	    var objLink=document.getElementById(enlace);
	    if (objLink){
			var url = objLink.value;
			if(url=="" || url=="#" ) return true;
			var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
			if (pattern.test(url)) return true;
			return false;
		}
		return true;
}


 function validar(f1) {
  if (f1.direccion.length < 1) {
    alert("Escriba una direccion en el campo \"Direccion\".");
    f1.direccion.focus();
    return (false);
  }
  
  if (f1.nombre.value.length < 3) {
    alert("Escriba por lo menos 3 caracteres en el campo \"Nombre\".");
    f1.nombre.focus();
    return (false);
  }
  
  var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚÀÈÒÇ " + "abcdefghijklmnñopqrstuvwxyzáéíóúàèòïü'l.-ç, ";
  var checkStr = f1.nombre.value;
  var allValid = true; 
  for (i = 0; i < checkStr.length; i++) {
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    }
  }
  if (!allValid) { 
    alert("Escriba sólo letras en el campo \"Nombre\"."); 
    f1.nombre.focus(); 
    return (false); 
  } 
  var checkOK = "0123456789"; 
  var checkStr = f1.tfno.value; 
  var allValid = true; 
  var decPoints = 0; 
  var allNum = ""; 
  for (i = 0; i < checkStr.length; i++) { 
    ch = checkStr.charAt(i); 
    for (j = 0; j < checkOK.length; j++) 
      if (ch == checkOK.charAt(j))
        break; 
    if (j == checkOK.length) { 
      allValid = false; 
      break; 
    } 
    allNum += ch; 
  } 
  if (!allValid) { 
    alert("Escriba sólo dígitos en el campo \"Telefono\".");
    f1.tfno.focus(); 
    return (false); 
  } 
  var chkVal = allNum; 
  var prsVal = parseInt(allNum); 
  if (chkVal != "" && !(prsVal >= "100000000" && prsVal <= "999999999999")) { 
    alert("Escriba un valor mayor de 9 cifras campo \"Telefono\"."); 
    f1.tfno.focus();
    return (false); 
  }
  if ( (f1.Email.value.indexOf ('.', 0) == -1)||(f1.Email.value.indexOf ('@', 0) == -1)||(f1.Email.value.length < 5)) { 
    alert("Escriba una dirección de correo válida en el campo \"Dirección de correo\"."); 
    return (false); 
  }
  
  
  
  if(!validate_link("Link")) {
	   alert("Link no valida, comprobar si ha escrito http:// o https://");
	   return (false); 
  }
  if(!validate_link("Link_ofertas")) {
	   alert("Link no valida, comprobar si ha escrito http:// o https://");
	   return (false); 
  }
  
  var objLink=document.getElementById("dni");
 
  if (objLink){
	var nifcif =getRadioButtonSelectedValue(document.f1.nifcif);  
	if (nifcif=="1") {
		var a = isDNI(f1.dni.value);
  		if(!a) return a;
	} else {
		
		b= isValidCif(f1.dni.value)
		if(!b) return b;
  	}
  }
  return (true); 
}

function getRadioButtonSelectedValue(ctrl)
{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

function validar_producto(f1) {
  if (f1.id_fabrica.value=="") {
    alert("El campo \"Codigo fabrica\" no puede estar vacio.");
    f1.nombre.focus();
    return (false);
  }
  if(!validate_link("link")) {
	   alert("Link de ofertas no valida, comprobar si ha escrito http:// o https://");
	   return (false); 
  }
  return (true); 
}

