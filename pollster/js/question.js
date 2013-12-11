//<!-- 
//nice animations for the question. Make a prettier display. 
//fluid and no page loads. onclick submit, then ajax into next and load results. jq graph results. 

function checkPageWidth(Panels) {
	var pageWidth=$('html').outerWidth(); pageHeight=$('html').outerHeight();
	if (pageWidth > 600){
		var panelWidth= $(Panels[0]).outerWidth(); panelHeight= $(Panels[0]).outerHeight();
		var offsetx=Math.round(panelWidth*.2); offsety=Math.round(panelHeight*.2);
		var colsMax = Math.ceil((.7*(pageWidth))/(panelWidth+offsetx)); // we can fit that many panels in 70% of the page and
		var rowsMax = Math.ceil((.8*(pageHeight))/(panelHeight+offsety)); // this many rows in 80% of the page
		var rowsAct = Math.ceil(Panels.length/colsMax);
		// //this is where I would change the layout or the panel dimensions if there are more panels than there is space on the page
		var overflow = (rowsMax<rowsAct);
		if (overflow) {
			$('html').css({
				"overflow-y" : "scroll" //if we are moving things off page, pop up a scrollbar
			});
		}
		console.log("Panels "+Panels.length+". Pw*Ph:"+pageWidth+"*"+pageHeight+". PanW*PanH:"+panelWidth+"*"+panelHeight);
		for (r=0; r<rowsAct; r++){
			var colsAct = (Panels.length < colsMax) ? Panels.length : ((r*colsMax)+colsMax < Panels.length  ) ? colsMax : (Panels.length- (r*colsMax));
			//if there is only enough for one row, have it be that many, else if not last row colMax else whatever is left.
			for (c=0; c<colsAct; c++){
				index=(r*colsMax)+c;
				startX = pageWidth*.2; //min .1?
				y=(pageHeight*.2)+(r*(panelHeight+offsety));
				x=startX + (c*(panelWidth+offsetx)); //if even start pos= half pageWidth -half offset - half colAct*pageWidth+offset. 
																	//If odd  start pos =half pageWidth - half panel - (floor halfcolAct)*pageWidth+offset
				Panels[index].css({
					'left' : x,
					'top' : y
				});
			console.log("panel "+(index+1)+"/"+Panels.length+" row: "+(r+1)+"/"+rowsAct+" col "+(c+1)+"/"+colsAct);
			} // end for each col
		} // end for each row
	} // end if page width
}	


$(document).ready(function() {
		// $("body").css("display", "none");
		// pageFadeIn();
		var Panels=[];
		$('.answer').each(function(){
			console.log( $(this).text() );
			Panels.push( $(this) );
			console.log(Panels.length);
		});

		$(window).bind("resize", function(){
			checkPageWidth(Panels);
		}); 

		checkPageWidth(Panels);
		//onclick loadResults();

	});
// -->