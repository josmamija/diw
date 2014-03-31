// JavaScript Document

$(document).ready(function(){
	//var lineNum =0;
	//var aNumber =5;
	//lineNum= aNumber-4;
	var indexNum =0;
	var imageName = ["floatingball.gif", "redball.gif","eightball.gif"];
	//var hText = $("#head1").text();
	//var text1 = "This is just some text.";
	//var text2 = text1 + hText;
	
	
	$("#picture").click(function() {
		
		//$("p").text(text2);
		//$("p").css("background-color","yellow"); 
		//$("p").eq(lineNum).css("background-color","red");
		/*
		lineNum++; 
		if (lineNum >2){
			lineNum =0;
		}
		
		
		$("#picture").attr("src",imageName[indexNum]);
		indexNum++;
		if(indexNum > 2){indexNum=0;}
		*/
		$("#picture").fadeOut(300, function(){
			$("#picture").attr("src",imageName[indexNum]);
			indexNum++;	
			if(indexNum > 2){indexNum=0;}
			$("#picture").fadeIn(500);
		});
	});
});