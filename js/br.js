var d, dom, ie, ienu, ie4, ie5, ie5x, ie6, moz, moznu, mac, win, old, lin, ie5mac, ie5xwin, op, opnu, op4, op5, op6, op7, konq, saf, saf_num;
var navg, nav4, nav5, nav6, nav7;
l='<LINK rel="stylesheet" type="text/css" href="styles/';
c='.css">';
menu='<LINK rel="stylesheet" type="text/css" href="includes/menu.css"';

d = document;
n = navigator;
nav = n.appVersion;
nan = n.appName;
nua = n.userAgent;
win = ( nav.indexOf( 'Win' ) != -1 );
mac = ( nav.indexOf( 'Mac' ) != -1 );
lin = ( nav.indexOf( 'Linux' ) != -1 );

if ( !d.layers ){
	
	dom = ( d.getElementById ); 
	old = ( nav.substring( 0, 1 ) < 4 );
	op = ( nua.indexOf( 'Opera' ) != -1 );
	moz = ( nua.indexOf( 'Gecko' ) != -1 );
	ie = ( d.all && !op );
	konq = ( nua.indexOf( 'Konqueror' ) != -1 );
	saf = ( nua.indexOf( 'Safari' ) != -1 );
	navg = ( nua.indexOf( 'Netscape' ) != -1 );
	
	document.write(menu);
	
	if ( ie ){
		ie_pos = nua.indexOf( 'MSIE' );
		ienu = nua.substr( ( ie_pos + 5 ), 3 );
		ie4 = ( !dom ); 
		ie5 = ( ienu.substring( 0, 1 ) == 5 );
		ie6 = ( ienu.substring( 0, 1 ) == 6 );
		if(ie6){
			document.write(l+'ie6'+c);
		}
	}
	else{} 
	
	ie5x = ( d.all && dom );
	ie5mac = ( mac && ie5 );
	ie5mac = ( mac && ie5 ); 
	if (ie5mac){ 
	  document.write(l+'macie'+c); 
	 } 
	ie5xwin = ( win && ie5x );
}else{
	if ( nua.indexOf('Mozilla/4')!= -1 ){
		document.write(l+'nn4'+c);
	}
}