//This is the original script of br.js
//Comments and unused features has been removed from br.js

var d, dom, ie, ienu, ie4, ie5, ie5x, ie6, moz, moznu, mac, win, old, lin, ie5mac, ie5xwin, op, opnu, op4, op5, op6, op7, konq, saf, saf_num;
var navg, nav4, nav5, nav6, nav7;
l='<LINK rel="stylesheet" type="text/css" href="styles/';
c='.css">';

//variable initialization

d = document;
n = navigator;
nav = n.appVersion;
nan = n.appName;
nua = n.userAgent;
win = ( nav.indexOf( 'Win' ) != -1 );
mac = ( nav.indexOf( 'Mac' ) != -1 );
lin = ( nav.indexOf( 'Linux' ) != -1 );
/* 
d.layers is preferred method to test for NS 4.x over placing a boolean value into a 
ns4 variable as we do with the other browsers due to netscape 4x bugs 
*/

if ( !d.layers ){
	dom = ( d.getElementById ); // useful for other functions often, for method testing
	old = ( nav.substring( 0, 1 ) < 4 );
	op = ( nua.indexOf( 'Opera' ) != -1 );
	moz = ( nua.indexOf( 'Gecko' ) != -1 );
	ie = ( d.all && !op );
	konq = ( nua.indexOf( 'Konqueror' ) != -1 );
	saf = ( nua.indexOf( 'Safari' ) != -1 );
	navg = ( nua.indexOf( 'Netscape' ) != -1 );
	
	
	//test for opera first, that way the detector won't get caught on false identifying operas

	if ( op ){
		op_pos = nua.indexOf( 'Opera' );
		opnu = nua.substr( ( op_pos + 6 ), 3 );
		op5 = ( opnu.substring( 0, 1 ) == 5 );
		op6 = ( opnu.substring( 0, 1 ) == 6 );
		op7 = ( opnu.substring( 0, 1 ) == 7 );
		if(op5){
			document.write(l+'op5'+c);
		}if(op6){
			document.write(l+'op6'+c);
		}if(op7){
			document.write(l+'op7'+c);
		}else{
			document.write(l+'basic'+c);
		}
	}
	//must test for safari before mozilla because safari nua string has 'gecko' in it.
	else if ( saf ){
		saf_pos = nua.indexOf( 'Safari' );
		saf_nu = nua.substr( ( saf_pos + 7 ), 2 );
		//note, as of 6-21-03 safari is still in beta, saf_nu was around 70, 60 for early releases
	}
	else if ( navg ){
		if ( nua.indexOf('Netscape/5')!= -1 ){
			document.write(l+'nn5'+c);
		}else if ( nua.indexOf('Netscape/6')!= -1 ){
			document.write(l+'nn6'+c);
		}else if ( nua.indexOf('Netscape/7')!= -1 ){
			document.write(l+'nn7'+c);
		}
		else{
			document.write(l+'basic'+c);
		}
	}
	else if ( moz ){
		/* 
		note: mozilla browsers can be id'ed by rv number, but if you are trying to id
		the actual Netscape 6 or greater browsers safely, you will need to use the build date.
		We will have that code up shortly. Netscape 7 uses a rv number of about 1.0.1, so 
		this technique won't work accurately for all gecko id'ing 
		*/

		rv_pos = nua.indexOf( 'rv' );
		moz_rv = nua.substr( ( rv_pos + 3 ), 3 ); // use this for main version, like 0.9, 1.0, 1.1, 1.2
		moz_rv_sub = nua.substr( ( rv_pos + 7 ), 1 );
		moz_rv_sub = moz_rv + moz_rv_sub; // use this if exact version is required, like 0.9.4, ie netscape 6.2
		document.write(l+'moz'+c);
	}
	else if ( ie ){
		ie_pos = nua.indexOf( 'MSIE' );
		ienu = nua.substr( ( ie_pos + 5 ), 3 );
		ie4 = ( !dom ); /* remember, IE 4 does not have much DOM support, if any, but it's a very small part of the market */
		ie5 = ( ienu.substring( 0, 1 ) == 5 );
		ie6 = ( ienu.substring( 0, 1 ) == 6 );
		if(ie4){
			document.write(l+'ie4'+c);
		}if(ie5){
			document.write(l+'ie5'+c);
		}if(ie6){
			document.write(l+'ie6'+c);
		}else{
			document.write(l+'basic'+c);
		}
	}
	else{} 

	/* 
	we have had reports of some browsers having problems if you don't close out the if/else if with an else, better safe than sorry 
	*/
	
	/*
	ie5x tests only for functionavlity. dom or ie5x would be default settings. 
	Opera will register true in this test if set to identify as IE 5
	*/

	ie5x = ( d.all && dom );
	
	/* 
	mac opera registers false here. Remember, IE for Mac has nothing to do with IE for windows, it's a different
	code base completely, functionally it's closest to Opera 5 or 6. Having javascript run on this correctly is a 
	hit and miss proposition; never assume your code will work on IE Mac, always test it on a Mac, both OS 9 and OS X
	*/
	ie5mac = ( mac && ie5 );
	ie5xwin = ( win && ie5x );
}else{
	if ( nua.indexOf('Mozilla/4')!= -1 ){
		document.write(l+'nn4'+c);
	}
}