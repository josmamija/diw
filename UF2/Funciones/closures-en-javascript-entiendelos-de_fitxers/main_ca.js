(function(){var c=document,d="length",e=" mitjan\u00e7ant Google Traductor?",h=".",i="Desactiva la traducci\u00f3 del ",j="Desactiva per a: ",k="Google Traductor",l="Google ha tradu\u00eft autom\u00e0ticament aquesta p\u00e0gina a: ",m="Mostra aquesta p\u00e0gina en: ",n="Tecnologia de ",p="Tradueix-ho tot a: ",q="Tradu\u00eft a l'idioma: ",r="Voleu traduir aquesta p\u00e0gina a ",s="var ",t=this;
function v(a,u){var f=a.split(h),b=t;!(f[0]in b)&&b.execScript&&b.execScript(s+f[0]);for(var g;f[d]&&(g=f.shift());)!f[d]&&void 0!==u?b[g]=u:b=b[g]?b[g]:b[g]={}}Math.floor(2147483648*Math.random()).toString(36);var w={"0":k,1:"Cancel\u00b7la",2:"Tanca",3:function(a){return l+a},4:function(a){return q+a},5:"Error: el servidor no ha pogut completar la sol\u00b7licitud. Torneu-ho a provar m\u00e9s tard.",6:"M\u00e9s informaci\u00f3",7:function(a){return n+a},8:k,9:"Traducci\u00f3 en curs",10:function(a){return r+(a+e)},11:function(a){return m+a},12:"Mostra l'original",13:"El contingut d'aquest fitxer local s'enviar\u00e0 a Google per traduir-lo mitjan\u00e7ant una connexi\u00f3 segura.",14:"El contingut d'aquesta p\u00e0gina segura s'enviar\u00e0 a Google per traduir-lo mitjan\u00e7ant una connexi\u00f3 segura.",
15:"El contingut d'aquesta p\u00e0gina d'intranet s'enviar\u00e0 a Google per traduir-lo mitjan\u00e7ant una connexi\u00f3 segura.",16:"Seleccioneu l'idioma",17:function(a){return i+a},18:function(a){return j+a},19:"Amaga sempre",20:"Text original:",21:"Contribu\u00efu a millorar la traducci\u00f3",22:"Contribueix",23:"Tradueix-ho tot",24:"Restaura-ho tot",25:"Cancel\u00b7la-ho tot",26:"Tradueix les seccions al meu idioma",27:function(a){return p+a},28:"Mostra els idiomes originals",29:"Opcions",
30:"Desactiva la traducci\u00f3 per a aquest lloc",31:null,32:"Mostra traduccions alternatives",33:"Feu clic a les paraules que hi ha m\u00e9s amunt per obtenir traduccions alternatives",34:"Fes-lo servir",35:"Arrossegueu amb la tecla Maj per canviar l'ordre",36:"Feu clic per obtenir traduccions alternatives",37:"Manteniu premuda la tecla de maj\u00fascules, feu clic a les paraules i arrossegueu-les per canviar l'ordre.",38:"Gr\u00e0cies per contribuir a Google Traductor amb el teu suggeriment de traducci\u00f3.",
39:"Gestiona la traducci\u00f3 d'aquest lloc",40:"Feu clic en una paraula per veure'n traduccions alternatives o b\u00e9 feu-hi doble clic per editar-la directament",41:"Text original",42:"Traductor de Google",43:"Tradueix",44:"S'ha enviat la vostra correcci\u00f3."};var x=window.google&&google.translate&&google.translate._const;
if(x){var y;a:{for(var z=[],A=["10,0.01,20121113"],B=0;B<A[d];++B){var C=A[B].split(","),D=C[0];if(D){var E=Number(C[1]);if(E&&!(0.1<E||0>E)){var F=Number(C[2]),G=new Date,H=1E4*G.getFullYear()+100*(G.getMonth()+1)+G.getDate();F&&!(F<H)&&z.push({version:D,a:E,b:F})}}}for(var I=0,J=window.location.href.match(/google\.translate\.element\.random=([\d\.]+)/),K=Number(J&&J[1])||Math.random(),B=0;B<z[d];++B){var L=z[B],I=I+L.a;if(1<=I)break;if(K<I){y=L.version;break a}}y="11"}var M="/translate_static/js/element/%s/element_main.js".replace("%s",
y);if("0"==y){var N=" translate_static js element %s element_main.js".split(" ");N[N[d]-1]="main_ca.js";M=N.join("/").replace("%s",y)}var O=("https:"==window.location.protocol?"https://":"http://")+x._pah+M,P=c.createElement("script");P.type="text/javascript";P.charset="UTF-8";P.src=O;var Q=c.getElementsByTagName("head")[0];Q||(Q=c.body.parentNode.appendChild(c.createElement("head")));Q.appendChild(P);v("google.translate.m",w);v("google.translate.v",y)};})()