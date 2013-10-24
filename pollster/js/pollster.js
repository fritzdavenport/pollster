//<!--

function navFix(){
/* change #a[href=currentURL] > li to li.active
		Requires: JQuery; Input: None; Outputs: None; Changes class name
		HTML - ul a	li... 	a 	li...  etc	/ul
		CSS Usage .active {styles} */
		parts = window.location.href.split('/');//get current page and parent (prevent dupes)
		postWin = parts[(parts.length-2)]+"/"+ parts[(parts.length-1)];
		alert(postWin);
		if (postWin != "assign3/index.php"){
			$("a[href$='"+postWin+"']").find('li').addClass('active');
		}
}


function formPageInit(){
  // Ensure we're working with a relatively standards compliant user agent
  if (!document.getElementById || !document.createElement || !document.createTextNode)
    return;


$(document).ready(function(){

}); // /ready

//-->
