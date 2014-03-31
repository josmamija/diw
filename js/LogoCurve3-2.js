<!-- Hide
/*
    LOGO CURVE Version 3.2 
    24.01.2003
    Writen by David Bann - South Africa
    e-mail: david@ftgconsulting.co.za

    Feel free to use this code, but please email me the website it is used on,
    and leave this commenting in tact. Thank you!
    Please let me know of any bugs or if you edit the script.

    Additions since version 3.1:
     - Added chengeable formulas for curve.
     - Added changeable event at which the script is initiated.

    Things to come:
     - Better use of layers - will use less layers, but still get same
       effect... (User will be able to specify how many layers to be used,
       adding more functionality and effects, as well as performance)
     - I want to add an option of document boundaries for the curve,as to stop
       the logo from going out of the document and dissapearing totaly.
	 - Fade to work in browsers other then IE.
*/

//----------------------- Start Customizable Variables -----------------------//
//=== Positioning ===//  
var left = 0;		// Starting left position
var top = 320;		// Starting left position

//=== Curve and Distance ===//
var topInc = 5;		// Incriment of top position
var leftInc = 5;		// Incriment of left position

/* Make both the horizontal curve and the vertical curve the same to..
.. get an increasing gap with no curve. */
var hor_curve = 20;		// Horizontal curve - 0 for no curve
var ver_curve = -20;		// Vertical curve - 0 for no curve    

//=== Timing and Other ===//
var noTimes = 50;		// Number of times the picture is shown
var waitTime = 1;		// Time delay

var layer = 2;		// Layer level
var picture = 'headerlogo.gif';		// Picture to display (Smaller images work better)

var start_retracted= true;		// Start the image retracted (true / false)
var retract= true;		// Retract from behind after expanding (true / false)

//=== Fade options (Only IEusers see fade) ===//
var fade = true;		// Gradual Fade (true / false) - Only works if retract =true
var fd_destop = 0;		// Destination transparency level (ie 80, for mostly solid)
var fd_rate = 10;		// Time in milliseconds between trasparency changes (best under 100)
var fd_delta = 5;		// Amount of change each time (ie 5, for 5% change in transparency)

var event_init = 'onClick';		// Event at which the script is initiated
var left_formula = '(left + leftInc) + ((count/100) * hor_curve)';		// Left position formula
var top_formula = '(top + topInc) + ((count/100) * ver_curve)';		// Top position formula
//----------------------- End Customizable Variables -----------------------//
//--------------------- DO NOT EDIT BEYOND THIS POINT! ---------------------//

var count = 0;
var count2 = 0;
var timeOutVal = waitTime * 10;
var txt;
var image;
var imageName;
var lay = new Array;

function addLayer(){
  left = eval(left_formula);
  top = eval(top_formula);

  txt = "<div id='Layer" + count + "' style='position:absolute; visibility:hidden; left:" + left + "; top:" + top + ";   z-index:" + layer + "'>";
  txt += "<a href='#' " + event_init + "='replay()'><img src='" + picture + "' border=0 style='filter:alpha(opacity=100)' name = 'Image" + count + "'></a>";
  txt += "</div>";

  document.write(txt);

  lay[count]=new lib_obj("Layer"+count);
}

function logoCurveInit(){
  while (count < noTimes) {
    addLayer();
    count++;
  }
  count = 0;

  lay[0].showIt();

  if (!start_retracted) 
    animate();
}

function animate(){
  if (start_retracted) {
    if (!retract){
      if (count > 0){
        setTimeout('animate()',timeOutVal);

        lay[count].hideIt();

        count--;
      }
    }
    else{
      if (count >= 0){
        setTimeout('animate()',timeOutVal);

        lay[count].showIt();

        if (count != 0)
          fadeImage();

        count--;
      }
    }

    if (retract){
      if(count==0)
        retractIt();
    }
  }
  else{    
      if (count < noTimes){
        setTimeout('animate()',timeOutVal);

        lay[count].showIt();

        if (count != noTimes-1 && retract)
          fadeImage();

        count++;
      }

      if (retract){
        if (count == noTimes)
          retractIt();

      }
  }  
}

function replay(){
  if ((count == noTimes || (count == 0 || count == -1)) &&(count2 == noTimes-1 || count2 == 0)){
    start_retracted = !start_retracted;    // Make the value opposite of what it is

    make_all_visible();

    if (start_retracted){
      count = noTimes-1;
    }
    else {
      count = 0;
    }
  
    animate();
  }
}

function retractIt(){
    if (start_retracted) {  // If the logo is not retracted (showing all the layers)
      if (count2 > 0){
        setTimeout('retractIt()',timeOutVal);
        lay[count2].hideIt();
        count2--;
      }
    }
    else{            // If the logo is retracted (Only showing the first layer)
      if (count2 < noTimes-1){
        setTimeout('retractIt()',timeOutVal);
        lay[count2].hideIt();
        count2++;
      }
    }
}

function fadeImage(){
  if (fade){
    if (count >= 0 && count <= noTimes){
      image = document.images['Image' + count];
      nereidFade(image,fd_destop,fd_rate,fd_delta);
    }
  }
}

function make_all_visible(){
  for (var i = 0; i< noTimes ; i++){
    if (document.images['Image' + i].style.MozOpacity){
      document.images['Image' + i].style.MozOpacity=100;
    }
    else if (document.images['Image' + i].filters) {
      document.images['Image' + i].filters.alpha.opacity = 100;
    }
  }
}
////***************(DHTMLCentral.com)****************////
function check_browser(){
  this.ver=navigator.appVersion
  this.agent=navigator.userAgent
  this.dom=document.getElementById?1:0
  this.opera5=this.agent.indexOf("Opera 5")>-1
  this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0; 
  this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
  this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
  this.ie=this.ie4||this.ie5||this.ie6
  this.mac=this.agent.indexOf("Mac")>-1
  this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0; 
  this.ns4=(document.layers && !this.dom)?1:0;
  this.bw=(this.ie6||this.ie5||this.ie4||this.ns4||this.ns6||this.opera5)
  return this
}
bw=new check_browser()
function show_message(txt){alert(txt); return false}
function lib_obj(obj,nest){ 
  if(!bw.bw) return show_message('Old browser')
  nest=(!nest) ? "":'document.'+nest+'.'
  this.evnt=bw.dom? document.getElementById(obj):
    bw.ie4?document.all[obj]:bw.ns4?eval(nest+"document.layers." +obj):0;   
   if(!this.evnt) return show_message('The layer does not exist ('+obj+')'
    +'- If your using Netscape please check the nesting of your tags!')
  this.css=bw.dom||bw.ie4?this.evnt.style:this.evnt; 
  this.ref=bw.dom||bw.ie4?document:this.css.document;
  this.x=parseInt(this.css.left)||this.css.pixelLeft||this.evnt.offsetLeft||0;
  this.y=parseInt(this.css.top)||this.css.pixelTop||this.evnt.offsetTop||0
  this.w=this.evnt.offsetWidth||this.css.clip.width|| this.ref.width||this.css.pixelWidth||0; 
  this.h=this.evnt.offsetHeight||this.css.clip.height|| this.ref.height||this.css.pixelHeight||0
  this.c=0
  if((bw.dom || bw.ie4) && this.css.clip) {
  this.c=this.css.clip; this.c=this.c.slice(5,this.c.length-1); 
  this.c=this.c.split(' ');
  for(var i=0;i<4;i++){this.c[i]=parseInt(this.c[i])}
  }
  this.ct=this.css.clip.top||this.c[0]||0; 
  this.cr=this.css.clip.right||this.c[1]||this.w||0
  this.cb=this.css.clip.bottom||this.c[2]||this.h||0; 
  this.cl=this.css.clip.left||this.c[3]||0
  this.obj = obj + "Object"; eval(this.obj + "=this")
  return this
}
lib_obj.prototype.showIt = function(){this.css.visibility="visible"}
lib_obj.prototype.hideIt = function(){this.css.visibility="hidden"}
lib_obj.prototype.writeIt = function(text,startHTML,endHTML){
    if(bw.ns4){
    if(!startHTML){startHTML=""; endHTML=""} this.ref.open("text/html"); 
    this.ref.write(startHTML+text+endHTML); 
    this.ref.close()
    }else this.evnt.innerHTML=text
}
////***************(DHTMLCentral.com)****************////
/* Code taken from DynamicDrive.com (Start)-->
Gradual-Highlight Image Script II- 
By J. Mark Birenbaum (birenbau@ugrad.cs.ualberta.ca)
For full source to script, visit http://dynamicdrive.com */
nereidFadeObjects = new Object();nereidFadeTimers = new Object();
function nereidFade(object, destOp, rate, delta){
if (!document.all)return
    if (object != "[object]"){ setTimeout("nereidFade("+object+","+destOp+","+rate+","+delta+")",0); return;}
    clearTimeout(nereidFadeTimers[object.sourceIndex]); diff = destOp-object.filters.alpha.opacity;
    direction = 1; if (object.filters.alpha.opacity > destOp){direction = -1;}
    delta=Math.min(direction*diff,delta); object.filters.alpha.opacity+=direction*delta;
    if (object.filters.alpha.opacity != destOp){ nereidFadeObjects[object.sourceIndex]=object;
        nereidFadeTimers[object.sourceIndex]=setTimeout("nereidFade(nereidFadeObjects["+object.sourceIndex+"],"+destOp+","+rate+","+delta+")",rate);
	}
}
// <-- Code taken from DynamicDrive.com (End)
window.onload=new logoCurveInit();
//--> End Hide