<!--
// script para iluminar texto que deseemos 
// pasamos como parametro un texto en html con un identificador 
// span con id="iluminar", i tambien pasarle a la funcion como parametro
// la palabra a reemplazar
var original=document.getElementById("iluminar").innerHTML;
function hilite(texto){
	var vTexto= new RegExp(texto,"g");
 if(document.getElementById &&
    document.getElementById("iluminar") &&
    document.getElementById("iluminar").innerHTML){
     var iluminado=original.replace(vTexto,
        '<span style="color:red;font-weight:bold">web</span>');
    document.getElementById("iluminar").innerHTML=iluminado;
    }
}
function no_iluminar(){
 if(document.getElementById &&
    document.getElementById("iluminar") &&
    document.getElementById("iluminar").innerHTML){
    document.getElementById("iluminar").innerHTML=original;
    }
}
//-->