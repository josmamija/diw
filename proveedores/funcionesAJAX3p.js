var READY_STATE_COMPLETE=4;  
var peticio_http = null;  
function inicializa_xhr()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  


	
function crea_xml_poblacion()   
{  
   var data = document.getElementById("selector4");  
   var xml = "<parametres>";  
  //xml = xml + "<idprovincia>5<\/idprovincia>";  
   xml = xml + "<nif>" + data.value + "<\/nif>";
   xml = xml + "<\/parametres>"; 
   return (xml);
}	

function procesaRespostam()   
{ 
	if(peticio_http.readyState == READY_STATE_COMPLETE)   
    { 
	    if(peticio_http.status == 200)   
        {
	    	if (window.DOMParser)
		  {
			  parser=new DOMParser();
			  xmlDoc=parser.parseFromString(peticio_http.responseText,"application/xml");
		  }
		  else // Internet Explorer
		  {
			  xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
			  xmlDoc.async=false;
			  xmlDoc.loadXML(peticio_http.responseText); 
		  }  
			
		 	//var xmlDoc = parser.parseFromString(peticio_http.responseText, "text/xml");
		  	var root = xmlDoc.getElementsByTagName("proveedores")[0];  
			//var root = document_xml.getElementsByTagName("proveedores")[0];  
			var proveedores = root.getElementsByTagName("proveedor")[0]; 
			var cadena="";
			var nombres=proveedores.getElementsByTagName("nombre")[0];
			nombre = nombres.firstChild.nodeValue;
			var provincias=proveedores.getElementsByTagName("provincia")[0];
			provincia = provincias.firstChild.nodeValue;
			var poblaciones=proveedores.getElementsByTagName("poblacion")[0];
			poblacion = poblaciones.firstChild.nodeValue;
			var direcciones=proveedores.getElementsByTagName("direccion")[0];
			direccion = direcciones.firstChild.nodeValue;
			var telefonos=proveedores.getElementsByTagName("telefono")[0];
			telefono = telefonos.firstChild.nodeValue;
			
			var ofertas=proveedores.getElementsByTagName("link_ofertas")[0];
			oferta = ofertas.firstChild.nodeValue;
			cadena+="<br>  ==><b><span style='font-size:16px'><a href='"+oferta+"' style='color:#F00' target ='new'>OFERTAS</a></span></b><==";  
			cadena +="<br>" + nombre ; 
			cadena +="<br>" + direccion ;
			cadena +="<br>" + poblacion +"<br>"+provincia+"<br>Tfno. "+telefono;	
			
		  	document.getElementById("resposta_proveedor").innerHTML = cadena; 
		}  
	}  
}  




function get_poblacion(){
	peticio_http = inicializa_xhr();  
    if(peticio_http)   
    {  
		peticio_http.onreadystatechange = procesaRespostam;  
       	peticio_http.open("POST", "../proveedores/poblacionXML.php", true);  
		//peticio_http.open("POST", "http://192.168.1.37/wec/UF4/AJAX/prueba2.php", true);  
        var parametres_xml = crea_xml_poblacion();  
        peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		//alert (parametres_xml); 
         peticio_http.send('xml='+parametres_xml);    
    }  
} 
