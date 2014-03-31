	var NoOffFirstLineMenus=3;			// Number of main menu  items
	var LowBgColor="#FFFFFF";			// Background color when mouse is not over
	var HighBgColor="";			// Background color when mouse is over
	var FontLowColor="#00206E";			// Font color when mouse is not over
	var FontHighColor="#EE5924";			// Font color when mouse is over
	var BorderColor="#004B97";			// Border color
	var BorderWidthMain=0;			// Border width main items
	var BorderWidthSub=1;			// Border width sub items
 	var BorderBtwnMain=0;			// Border between elements main items 1 or 0
	var BorderBtwnSub=1;			// Border between elements sub items 1 or 0
	var FontFamily="arial";			// Font family menu items
	var FontSize=80;			// % Font size menu items (resizes on browser changes)
	var FontBold=1;				// Bold menu items 1 or 0
	var FontItalic=0;				// Italic menu items 1 or 0
	var MenuTextCentered="left";		// Item text position left, center or right
	var MenuCentered="left";			// Menu horizontal position can be: left, center, right, justify,
						//  leftjustify, centerjustify or rightjustify. PartOfWindow determines part of window to use
	var MenuVerticalCentered="top";		// Menu vertical position top, middle,bottom or static
	var ChildOverlap=.2;			// horizontal overlap child/ parent
	var ChildVerticalOverlap=.2;			// vertical overlap child/ parent
	var StartTop=0;				// Menu offset x coordinate. If StartTop is between 0 and 1 StartTop is calculated as part of windowheight
	var StartLeft=0;				// Menu offset y coordinate. If StartLeft is between 0 and 1 StartLeft is calculated as part of windowheight
	var VerCorrect=0;				// Multiple frames y correction
	var HorCorrect=0;				// Multiple frames x correction
	var LeftPaddng=3;				// Left padding
	var TopPaddng=2;				// Top padding
	var FirstLineHorizontal=0;			// First level items layout horizontal 1 or 0
	var MenuFramesVertical=1;			// Frames in cols or rows 1 or 0
	var DissapearDelay=1000;			// delay before menu folds in
	var UnfoldDelay=100;			// delay before sub unfolds	
	var TakeOverBgColor=1;			// Menu frame takes over background color subitem frame
	var FirstLineFrame="self";		// Frame where first level appears
	var SecLineFrame="self";		// Frame where sub levels appear
	var DocTargetFrame="self";		// Frame where target documents appear
	var TargetLoc="MenuPos";		// span id for relative positioning
	var MenuWrap=1;				// enables/ disables menu wrap 1 or 0
	var RightToLeft=0;			// enables/ disables right to left unfold 1 or 0
	var BottomUp=0;				// enables/ disables Bottom up unfold 1 or 0
	var UnfoldsOnClick=0;			// Level 1 unfolds onclick/ onmouseover
	var BaseHref="";			// BaseHref lets you specify the root directory for relative links. 
						// The script precedes your relative links with BaseHref
						// For instance: 
						// when your BaseHref= "http://www.MyDomain/" and a link in the menu is "subdir/MyFile.htm",
						// the script renders to: "http://www.MyDomain/subdir/MyFile.htm"
						// Can also be used when you use images in the textfields of the menu
						// "MenuX=new Array("<img src=\""+BaseHref+"MyImage\">"
						// For testing on your harddisk use syntax like: BaseHref="file:///C|/MyFiles/Homepage/"

	//var Arrws=[BaseHref+"tri.gif",5,10,BaseHref+"tridown.gif",10,5,BaseHref+"trileft.gif",5,10,BaseHref+"triup.gif",10,5];
	var Arrws=[BaseHref+"",5,10,BaseHref+"",10,5,BaseHref+"",5,10,BaseHref+"",10,5];	
						// Arrow source, width and height.
						// If arrow images are not needed keep source ""

	var MenuUsesFrames=0;			// MenuUsesFrames is only 0 when Main menu, submenus,
						// document targets and script are in the same frame.
						// In all other cases it must be 1

	var RememberStatus=0;			// RememberStatus: When set to 1, menu unfolds to the presetted menu item. 
						// When set to 2 only the relevant main item stays highligthed
						// The preset is done by setting a variable in the head section of the target document.
						// <head>
						//	<script type="text/javascript">var SetMenu="2_2_1";</script>
						// </head>
						// 2_2_1 represents the menu item Menu2_2_1=new Array(.......
	var PartOfWindow=.8;			// PartOfWindow: When MenuCentered is justify, sets part of window width to stretch to

						// Below some pretty useless effects, since only IE6+ supports them
						// I provided 3 effects: MenuSlide, MenuShadow and MenuOpacity
						// If you don't need MenuSlide just leave in the line var MenuSlide="";
						// delete the other MenuSlide statements
						// In general leave the MenuSlide you need in and delete the others.
						// Above is also valid for MenuShadow and MenuOpacity
						// You can also use other effects by specifying another filter for MenuShadow and MenuOpacity.
						// You can add more filters by concanating the strings
	var BuildOnDemand=0;

	var MenuSlide="";
	//var MenuSlide="progid:DXImageTransform.Microsoft.RevealTrans(duration=.5, transition=19)";
	//var MenuSlide="progid:DXImageTransform.Microsoft.GradientWipe(duration=.5, wipeStyle=1)";

	var MenuShadow="";
	//var MenuShadow="progid:DXImageTransform.Microsoft.DropShadow(color=#888888, offX=2, offY=2, positive=1)";
	//var MenuShadow="progid:DXImageTransform.Microsoft.Shadow(color=#888888, direction=135, strength=3)";

	var MenuOpacity="";
	//var MenuOpacity="progid:DXImageTransform.Microsoft.Alpha(opacity=85)";

	function BeforeStart(){return}
	function AfterBuild(){return}
	function BeforeFirstOpen(){return}
	function AfterCloseAll(){return}

// Menu tree:
// MenuX=new Array("ItemText","Link","background image",number of sub elements,height,width,"bgcolor","bghighcolor",
//	"fontcolor","fonthighcolor","bordercolor","fontfamily",fontsize,fontbold,fontitalic,"textalign","statustext");
// Color and font variables defined in the menu tree take precedence over the global variables
// Fontsize, fontbold and fontitalic are ignored when set to -1.
// For rollover images ItemText format is:  "rollover?"+BaseHref+"Image1.jpg?"+BaseHref+"Image2.jpg" 
Menu1=new Array("Media Files","file.htm","",2,20,100,"","","","","","",-1,-1,-1,"","Own text entered");
	Menu1_1=new Array("Example 1_1","file.htm","",0,20,100,"#FFFFFF","#FE7028","#004B97","#002851","#002851","",-1,-1,-1,"","");
	Menu1_2=new Array("Example 1_1","file.htm","",0,20,100,"#FFFFFF","#FE7028","#004B97","#002851","#002851","",-1,-1,-1,"","");
Menu2=new Array("test","file.htm","",1,20,200,"","","","","","",-1,-1,-1,"","");
	Menu2_1=new Array("Example 2.1","file.htm","",0,20,50,"red","white","yellow","blue","yellow","",-1,-1,-1,"","");	
		Menu2_1_1=new Array("Example 2.1.1","","",0,20,200,"blue","white","yellow","blue","yellow","",-1,-1,-1,"","");
		Menu2_1_2=new Array("Example 2.1.2","file.htm","",0,0,0,"purple","white","yellow","blue","yellow","",-1,-1,-1,"","");
Menu3=new Array("Example 3","file3.htm","",0,20,100,"","","","","","",-1,-1,-1,"","");