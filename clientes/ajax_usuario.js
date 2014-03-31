var READY_STATE_COMPLETE=4;  
var peticio_http = null;  
  
function inicializa_xhr()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  
function crea_query_string()   
{  
  //var data = document.getElementById("DataNaixement");  
  var oUs = document.getElementById("usuario");  
  return "usuario=" + encodeURIComponent(oUs.value) + 
  "&nocache=" + Math.random();  
}  
  
function valida()   
{ 
  
  peticio_http = inicializa_xhr();  
  if(peticio_http)   
  {  
    peticio_http.onreadystatechange = procesaResposta;  
    peticio_http.open("POST", "../clientes/validaUsuario.php", true); 
	//peticio_http.open("POST", "http://localhost/wec/UF4/AJAX/validaDades.php", true);  
    peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    var query_string = crea_query_string();  
    peticio_http.send(query_string);  
  }  
}  
  
function procesaResposta()   
{  
  if(peticio_http.readyState == READY_STATE_COMPLETE)   
  {  
    if(peticio_http.status == 200)   
    {  
      //document.getElementById("id_fabrica").value = peticio_http.responseText; 
	  //var res= trim(peticio_http.responseText);
	  document.getElementById("resposta_existe").innerHTML = peticio_http.responseText;
	  
	  
    }  
  }  
} 

function compruebaValido(){
//alert("Hola"); 
    Validado = document.f1.usuario.value;
    
    if (Validado == ""){
       //si era la cadena vacía es que no era válido. Lo aviso
       alert ("Debe escribir un nombre de usuario!");
       //selecciono el texto
       document.f1.usuario.select();
       //coloco otra vez el foco
       document.f1.usuario.focus();
    }else{
       //alert("Hola"); 
       document.f1.usuario.value = Validado;
       valida();
    }   
} 