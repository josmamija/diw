   window.onload = nouCarto;    
  function nouCarto()   
  {  
  	 var casilla = Array(25);
	 var j;
	 var i;
	 var nouNum;
	 for (var i = 0; i < 24; ++i) {
		nouNum = Math.floor(Math.random() * 75) + 1;
		for (j = 0; j < i; ++j){
			if (casilla[j]==nouNum) { 
			  nouNum = Math.floor(Math.random() * 75) + 1;
			  j=0;
			}	
		}
		casilla[i]=nouNum;
	 }
	 for (var i=0; i<24; i++)   
     {            
        document.getElementById("s"  + i).innerHTML = casilla[i];     } 
}   