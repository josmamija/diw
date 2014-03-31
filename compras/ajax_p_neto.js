var READY_STATE_COMPLETE=4;  
var peticio_http = null;  
var ele=0;  
function inicializa_xhr()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  
function crea_query_string(j)   
{  
  var idnif="nif"+j;
  var onif = document.getElementById(idnif);  
  var obj = "idFabrica"+j;
  var tdFabrica = document.getElementById(obj);
  var idfabrica= tdFabrica.innerHTML;
  var cant = "cantidad"+j;
  var ocantidad = document.getElementById(cant);
  return "nif=" + encodeURIComponent(onif.value) + 
  "&idFabrica=" + encodeURIComponent(idfabrica) +
  "&cantidad=" + encodeURIComponent(ocantidad.value) +    
  "&nocache=" + Math.random();  
}  
  
function valida(j)   
{ 
  ele =j;
  peticio_http = inicializa_xhr();  
  if(peticio_http)   
  {  
    peticio_http.onreadystatechange = procesaResposta;  
    peticio_http.open("POST", "../compras/actualiza_p_neto.php", true); 
	//peticio_http.open("POST", "http://localhost/wec/UF4/AJAX/validaDades.php", true);  
    peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    var query_string = crea_query_string(j);  
    peticio_http.send(query_string);  
  }  
}  


  
function procesaResposta()   
{  
  if(peticio_http.readyState == READY_STATE_COMPLETE)   
  {  
    if(peticio_http.status == 200)   
    {  
	 //missatge=document.getElementById("resposta").innerHTML;
	  var obj = "pneto"+ele;
      opneto=document.getElementById(obj);
	  opneto.innerHTML = peticio_http.responseText;
	  //missatge=document.getElementById("resposta").innerHTML;  
	  var cant = "cantidad"+ele;
	  var k = parseInt(ele);
      var ocantidad = document.getElementById(cant);
	  unidades[k]= parseInt(ocantidad.value);
	  pneto[k]=opneto.innerHTML;
    }  
  }  
} 

function compruebaValido(j){
//alert("Hola"); 
   /*
    Validado = document.f1.cantidad.value;
    if (Validado == ""){
       //si era la cadena vacía es que no era válido. Lo aviso
       alert ("Debe escribir algo!");
       //selecciono el texto
       document.f1.cantidad.select();
       //coloco otra vez el foco
       document.f1.cantidad.focus();
    }else{
       //alert("Hola"); 
       document.f1.cantidad.value = Validado;
       valida(j);
    }  
	*/
	valida(j); 
} 