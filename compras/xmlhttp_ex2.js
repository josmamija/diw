var READY_STATE_COMPLETE=4;  
var peticio_http = null;  
var i=0;
var missatge="";
var unidades= new Array();
var pneto= new Array();
var pvp= new Array();
var enlaces = new Array();
var enlacesp = new Array();
var desc = new Array();
var marcas = new Array();
var idfabricas = new Array();
var nifs = new Array();
var proveedores = new Array();
var campos = new Array();
var adjuntos = new Array();


function novaFi2(enlace)  
{  
if(enlace.trim()=="") return false;       
 var gatFinestra = window.open(enlace,"FinestraGat","resizable=yes,width=500,height=500, top=120,left=100");  
   return false;    
}    




function mostrar(){
  //alert("hola");	
  if(i<1)  document.getElementById("confirmar").style.visibility = "hidden";
  else document.getElementById("confirmar").style.visibility = "visible";
}
function crearcompra(){
	var n_obj=0;
	for (var n=0; n < i;n++) campos[n]=0;
  	var dnis = document.getElementById("dni").value;	
  	var factura;
 	var facturas = new Array();
	for(var n=0;n<i;n++){
		if(campos[n]==0) {
			factura = {
	 			persona: { dni: dnis,  nif:  nifs[n]  },
        		items:[]
			}
		    var itemp = { idfabrica: idfabricas[n], cantidad: unidades[n], pvp: pvp[n] , pneto: pneto[n] }
    	  	factura.items.push(itemp);
			campos[n]=1;
			
			for (var m=n+1; m < i;m++){
		  		if(nifs[m]==nifs[n]){
					if(idfabricas[m]== idfabricas[n]) {
						for(var b=0; b < factura.items.length;++b) {
							if(factura.items[b].idfabrica == idfabricas[m])	{
								factura.items[b].cantidad += unidades[m];
							}
						}
					}else {	
							var itemp = { idfabrica: idfabricas[m], cantidad: unidades[m], pvp: pvp[m] , pneto: pneto[m] }
    	  					factura.items.push(itemp);
					}
					campos[m]=1;
		  		}
			}
			factura.mostrarFactura = function() {
    			var cad="";	
				/*
    			cad+="\n"+this.persona.dni + " "+ this.persona.nif;
				for (var p=0; p< this.items.length; p++){
	    			cad+="\n\t"+this.items[p].idfabrica + " "+ this.items[p].cantidad;
					cad+=" "+this.items[p].pvp + " "+this.items[p].pneto;
				}
				*/
				cad+="\n\t<factura>";
				cad+="\n\t\t<dni>"+this.persona.dni + "<\/dni>";
				cad+="\n\t\t<nif>"+this.persona.nif + "<\/nif>";
				cad+="\n\t\t<items>";
				for (var p=0; p< this.items.length; p++){
					cad+="\n\t\t\t<item>";
	    			cad+="\n\t\t\t\t<idfabrica>"+this.items[p].idfabrica + "<\/idfabrica>";
					cad+="\n\t\t\t\t<cantidad>"+ this.items[p].cantidad+"<\/cantidad>";
					cad+="\n\t\t\t\t<pvp>"+this.items[p].pvp + "<\/pvp>";
					cad+="\n\t\t\t\t<pneto>"+this.items[p].pneto+"<\/pneto>";
					cad+="\n\t\t\t<\/item>";
				}
				cad+="\n\t\t<\/items>";
				cad+="\n\t<\/factura>";
 				return cad;
			}
			facturas[n_obj]=factura;
			n_obj++;
		}
	}
	var xml="\n<facturas>";
	for(var n=0;n<facturas.length;n++){
		xml+=facturas[n].mostrarFactura();
	}
	xml+="\n<\/facturas>";
	//alert(cad1);
	 return "<?xml version='1.0' encoding='utf-8'?>" + xml;
	
}

function confirmarcompra(){
	peticio_http = inicializa_xhr_carrito();  
    if(peticio_http)   
    {  
		peticio_http.onreadystatechange = procesaResposta_confirmar;  
       	//peticio_http.open("POST", "http://192.168.1.37/gesdesc/compras/guardarcompraXML.php", true);  
		peticio_http.open("POST", "../compras/guardarcompraXML.php", true);  
		var parametres_xml = crearcompra(); 
		//document.getElementById("area").value = parametres_xml ; 
		//alert(parametres_xml);
		//return;
        peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticio_http.send('xml='+parametres_xml);    
    } 
}

function mostrarTabla(){
	var j;
	if(i<1){
		missatge="";
		document.getElementById("confirmar").style.visibility = "hidden";
	}
	else {
		document.getElementById("confirmar").style.visibility = 'visible';
		missatge="<table border ='1' class='rounded'><tr class='cabecera'><td> Proveedor</td><td> Codigo</td><td> Marca</td>";
 		missatge+="<td> Descripción</td><td> PVP</td><td>P_NETO</td><td> Uds.</td><td> Info técnica</td><td> Anexos</td></tr>";	
  		var ico = "<img src='../images/cancel.gif' width='20 height='20' />";
   		var icoinfo = "<img src='../images/inboxold.gif' width='20 height='20' />";
		var icoadjunto = "<img src='../images/anexo.png' width='20 height='20' />";
		
		var tip ="Borrar";
		var tipinfo ="Enlace al fabricante";
		var tipinfop ="Enlace al proveedor";
		var tipinfoadj ="Ver documento adjunto";
		
		for (k=0; k<i;++k){
		  j = k.toString();
		  missatge +="<tr>";
		  //missatge +="<td>"+ proveedores[k]+"</td>";
		  missatge +="<td title='"+tipinfop+"'><a href='"+enlacesp[k]+"' target='_blank' onclick='window.open(this.href,this.target,'width=400,height=250,top=120,left=100,toolbar=no,location=no,status=no,menubar=no');return false;'>"+proveedores[k]+"</a></td>";
		  
		  //missatge +="<td>"+ nifs[k]+"</td>";
		  //missatge +="<td>"+ k+"</td>";
		  missatge += "<td id ='idFabrica"+j+"'>"+idfabricas[k]+"</td>";
		  missatge += "<td>"+marcas[k]+"</td>";
		  //missatge += "<td>"+desc[k]+"</td>";
		  missatge += "<td><a onmouseover=\"nhpup.popup(\'"+desc[k]+"\');\" href='#'>"+desc[k].substr(0,30);+"</a></td>";
          //<a onmouseover="nhpup.popup(' <?=$mas?>');" href='#'><?=substr($mas,0,30)?></a>
       
		  missatge += "<td >"+pvp[k]+"</td>";
		  missatge += "<td style='color:#F00' id ='pneto"+j+"'>"+pneto[k]+"</td>";
		  missatge += '<td><INPUT TYPE="text" width="3" size="3"  name="cantidad" id = "cantidad'+j+'" value="'+unidades[k]+'" style="color: #00F" onKeyUp="compruebaValido('+j+')"><INPUT TYPE="hidden"  name="nif" id = "nif'+j+'" value="'+nifs[k]+'"></td>';
		  //missatge += "<td title='"+tipinfo+"'><a href ='"+enlaces[k]+"' target='_new'>"+icoinfo+"</a></td>";
		  
		  
		  
		  missatge +="<td title='"+tipinfo+"'><a href='#' onclick=\"novaFi2(\'"+enlaces[k]+"\')\">"+icoinfo+"</a></td>";
		  if(adjuntos[k]==1) {
		  		var carpeta="http://www.gesdesc.com/uploads/archivos_subidos/";
		  		var adjunto = carpeta + nifs[k]+"_"+idfabricas[k]+".pdf";
		   		missatge +="<td title='"+tipinfoadj+"'><a href='#' onclick=\"novaFi2(\'"+adjunto+"\')\">"+icoadjunto+"</a></td>";
		  }else { missatge +="<td></td>"; }		
		 
		  /*
		  
		  missatge +="<td title='"+tipinfo+"'><a href='"+enlaces[k]+"' target='_blank' onclick='window.open(this.href,this.target,'width=400,height=250,top=120,left=100,toolbar=no,location=no,status=no,menubar=no');return false;'>"+icoinfo+"</a></td>";
		  
		  */
		  
		  missatge += "<td title='"+tip+"'> <a href='#' onclick='delNode("+k+")'>"+ico+"</a></td></tr>";
	   }
	   missatge += "<table>";
	   missatge += "<p>*Precios en &#8364; sin IVA</p>";
	   
	}
	document.getElementById("resposta").innerHTML = missatge ; 
}

function desplazarIzq(celda) {
	unidades.splice(celda,1);
 	pneto.splice(celda,1);
 	pvp.splice(celda,1);
 	enlaces.splice(celda,1);
	enlacesp.splice(celda,1);
 	desc.splice(celda,1);
 	marcas.splice(celda,1);
 	nifs.splice(celda,1);
 	proveedores.splice(celda,1);
	idfabricas.splice(celda,1);
	adjuntos.splice(celda,1);
	
}

function delNode(k)   
{ 
	i--;
	desplazarIzq(k);
	mostrarTabla(); 
} 

function actualizar(){
	var n= i-1;
	var opneto = "pneto"+n.toString();
    pneto[n]= document.getElementById(opneto).innerHTML;
	var cant = "cantidad"+n.toString();
	var ocantidad = document.getElementById(cant);
	ocantidad.value=1;
	unidades[n]=1;
	for (var k =0; k < i;k++){
		cant = "cantidad"+k.toString();
  		ocantidad = document.getElementById(cant);
		ocantidad.value= unidades[k] ;
		opneto = "pneto"+k.toString();
		document.getElementById(opneto).innerHTML = pneto[k];
	}
}

function inicializa_xhr_carrito()   
{  
  if(window.XMLHttpRequest) { return new XMLHttpRequest();}  
  else if(window.ActiveXObject) { return new ActiveXObject("Microsoft.XMLHTTP");}  
}  

function crea_xml_carrito()   
{  
	var idfabrica = document.getElementById("idFabrica"); 
	var nif = document.getElementById("selector4"); 
    var xml = "<parametres>";  
    xml = xml + "<idfabrica>" + idfabrica.value + "<\/idfabrica>";
	xml = xml + "<nif>" + nif.value + "<\/nif>";  
    xml = xml + "<\/parametres>";  
    return "<?xml version='1.0' encoding='utf-8'?>" + xml;
}  

function anadir()   
{ 
    document.getElementById("confirmar").style.visibility = "hidden";
	peticio_http = inicializa_xhr_carrito();  
    if(peticio_http)   
    {  
		peticio_http.onreadystatechange = procesaResposta_carrito;  
       	//peticio_http.open("POST", "http://192.168.1.37/gesdesc/compras/comprovarDisponibilitatXML.php", true);  
		peticio_http.open("POST", "../compras/comprovarDisponibilitatXML.php", true);  
		var parametres_xml = crea_xml_carrito();  
        peticio_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		peticio_http.send('xml='+parametres_xml);    
    } 
	//document.getElementById("selector4").disabled =true; 
}  
  
function procesaResposta_carrito()   
{ 
	if(peticio_http.readyState == READY_STATE_COMPLETE)   
    { 
       if(peticio_http.status == 200)   
       {
		  var nif = document.getElementById("selector4").value; 
		  var j = i.toString();
		  //var document_xml = peticio_http.responseXML;  
		  
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
		  
		  //var parser = new DOMParser();
          //var xmlDoc = parser.parseFromString(peticio_http.responseText, "application/xml");
		  //var xmlDoc = parser.parseFromString(peticio_http.responseText, "text/xml");
		  var root = xmlDoc.getElementsByTagName("compra")[0];  
          //var document_xml = peticio_http.responseText;
		  //var root = document_xml.getElementsByTagName("compra")[0];  
          var missatges = root.getElementsByTagName("proveedor")[0]; 
    	  proveedor =  missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("idfabrica")[0]; 
    	  idfabrica1= missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("marca")[0]; 
    	  marca=missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("descripcion")[0]; 
    	  desc1= missatges.firstChild.nodeValue;
		  //2desc1= desc1.substr(0,50);
		  missatges = root.getElementsByTagName("pvp")[0]; 
    	  pvp1=missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("pneto")[0];
		  pneto1= missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("link")[0]; 
    	  enlace=missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("link_p")[0]; 
    	  enlacep=missatges.firstChild.nodeValue;
		  missatges = root.getElementsByTagName("adjunto")[0]; 
    	  adjunto=missatges.firstChild.nodeValue;
		  
		  var rep =false;
		  for(var r = i-1; r >=0 ; r--){
		  		if(nifs[r]==nif && idfabricas[r]==idfabrica1 && !rep) rep=true;
		  }
		  if(!rep) {
				nifs[i]=nif;
				proveedores[i]=proveedor;
				pneto[i]= pneto1;
				pvp[i]= pvp1;
				enlaces[i] = enlace;
				enlacesp[i] = enlacep;
				desc[i] = desc1;
				marcas[i] = marca;
				idfabricas[i]=idfabrica1;
				adjuntos[i]=adjunto;
				++i
				mostrarTabla();
		  		actualizar();		
		 }
		 document.getElementById("confirmar").style.visibility = "visible"; 
	   }  
    } 
	
}  

function procesaResposta_confirmar()   
{ 
	if(peticio_http.readyState == READY_STATE_COMPLETE)   
    { 
       if(peticio_http.status == 200)   
       {
	 	//var document_xml = peticio_http.responseXML;  
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
          var root = xmlDoc.getElementsByTagName("resposta")[0];  
          var missatges = root.getElementsByTagName("disponible")[0]; 
          var missatge = missatges.firstChild.nodeValue; 
		  if(missatge == "no"){
			 var resp = document.getElementById("resposta");
			 resp.innerHTML = "No se ha podido generar la compra" ; 
		  } else {
			var str= "Pedido realizado con exito.<br>Proximamente recibirá un correo electrónico con datos de su pedido";
			var cad ='<p style="color:#0F0"><b>'+str+'</b></p>';
			i=0;
			mostrar();
			document.getElementById("resposta").innerHTML =cad;
		  }
       }  
    }  
}  
