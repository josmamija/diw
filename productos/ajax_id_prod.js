var READY_STATE_COMPLETE=4;  
var peticio_http = null;  
  
function inicializa_xhr()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  
function crea_query_string_p()   
{  
  //var data = document.getElementById("DataNaixement");  
  var onif = document.getElementById("nif");  
  var oidFabrica = document.getElementById("id_fabrica");
  return "nif=" + encodeURIComponent(onif.value) + 
  "&idFabrica=" + encodeURIComponent(oidFabrica.value) +
  "&nocache=" + Math.random();  
}  

function crea_query_string_desc(idfabrica)   
{  
   return "&idFabrica=" + encodeURIComponent(idfabrica) +
  "&nocache=" + Math.random();  
} 
  
function valida_p()   
{ 
  
  peticio_http = inicializa_xhr();  
  if(peticio_http)   
  {  
    peticio_http.onreadystatechange = procesaResposta_p;  
    peticio_http.open("POST", "../productos/valida_idfabrica_desc.php", true); 
	//peticio_http.open("POST", "http://localhost/wec/UF4/AJAX/validaDades.php", true);  
    peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    var query_string = crea_query_string_p();  
    peticio_http.send(query_string);  
  }  
}  
  
function get_descripcion(idfabrica)   
{ 
  
  peticio_http = inicializa_xhr();  
  if(peticio_http)   
  {  
    peticio_http.onreadystatechange = procesaResposta_desc;  
    peticio_http.open("POST", "../productos/get_descripcion.php", true); 
	//peticio_http.open("POST", "http://localhost/wec/UF4/AJAX/validaDades.php", true);  
    peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    var query_string = crea_query_string_desc(idfabrica);  
    peticio_http.send(query_string);  
  }  
}    
  
function procesaResposta_p()   
{  
  if(peticio_http.readyState == READY_STATE_COMPLETE)   
  {  
    if(peticio_http.status == 200)   
    {  
      //document.getElementById("id_fabrica").value = peticio_http.responseText; 
	  //var res= trim(peticio_http.responseText);
	  if(peticio_http.responseText==1) {
		   document.getElementById("resposta").innerHTML = " Cód. existente";
	  }
	  else {
		var respuesta = peticio_http.responseText;
		var textos=respuesta.split("&");  
		document.getElementById("marca").value=textos[0];  
	  	document.getElementById("descripcion").innerHTML = textos[1];
		document.getElementById("resposta").innerHTML = "";
	  }
    }  
  }  
} 

function procesaResposta_desc()   
{  
  if(peticio_http.readyState == READY_STATE_COMPLETE)   
  {  
    if(peticio_http.status == 200)   
    {  
      //document.getElementById("id_fabrica").value = peticio_http.responseText; 
	  //var res= trim(peticio_http.responseText);
	  document.getElementById("desc_produc").innerHTML = peticio_http.responseText;
	  
	  
    }  
  }  
} 

function compruebaValido_p(){
//alert("Hola"); 
    Validado = document.f1.id_fabrica.value;
    
    if (Validado == ""){
       //si era la cadena vacía es que no era válido. Lo aviso
       //alert ("Debe escribir algo!");
       //selecciono el texto
       document.f1.id_fabrica.select();
       //coloco otra vez el foco
       document.f1.id_fabrica.focus();
    }else{
       //alert("Hola"); 
       document.f1.id_fabrica.value = Validado;
       valida_p();
    }   
} 