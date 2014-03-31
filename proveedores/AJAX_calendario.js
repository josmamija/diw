var READY_STATE_COMPLETE=4;  
var peticio_http = null;  

function inicializa_xhr()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  

function crea_xml_calendario()   
{  
   var data = document.getElementById("selector4");  
   var xml = "<parametres>";  
  //xml = xml + "<idprovincia>5<\/idprovincia>";  
   xml = xml + "<nif>" + data.value + "<\/nif>";
   xml = xml + "<\/parametres>"; 
   return (xml);
}	

function procesaRespostaCalendario()   
{ 
	if(peticio_http.readyState == READY_STATE_COMPLETE)   
    { 
	    if(peticio_http.status == 200)   
        {
	    	document.getElementById("resposta_calendario").innerHTML = peticio_http.responseText; 
		}  
	}  
}  


function get_calendario(){
	peticio_http = inicializa_xhr();  
    if(peticio_http)   
    {  
		peticio_http.onreadystatechange = procesaRespostaCalendario;  
       	peticio_http.open("POST", "../proveedores/calendario_leer.php", true);  
		//peticio_http.open("POST", "http://192.168.1.37/wec/UF4/AJAX/prueba2.php", true);  
        var parametres_xml = crea_xml_calendario();  
        peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		//alert (parametres_xml); 
         peticio_http.send('xml='+parametres_xml);    
    }  
} 
