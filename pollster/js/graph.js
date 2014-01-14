$.fn.textWidth = function(text, font) { //original credit goes to http://jsfiddle.net/philfreo/MqM76/
	//this is a $=jQuery   fn=prototype extension method.
	//when used on a JQuery object, determines the width of text inside the element. 
	//Can also be used by passing static text (specified font optional) in.
	$.fn.textWidth.fakeEl;
	if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span id="remove" style="display:inline-block">').hide().appendTo(document.body);
	$.fn.textWidth.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
	var width = $.fn.textWidth.fakeEl.width();
	delete $.fn.textWidth.fakeEl; //cleaning up
	$('#remove').remove(); //cleaning up
	return width;
}; 

$.fn.textHeight = function(text, font) { //original credit goes to http://jsfiddle.net/philfreo/MqM76/
	//this is a $=jQuery   fn=prototype extension method.
	//when used on a JQuery object, determines the width of text inside the element. 
	//Can also be used by passing static text (specified font optional) in.
	$.fn.textHeight.fakeEl;
	if (!$.fn.textHeight.fakeEl) $.fn.textHeight.fakeEl = $('<span id="remove" style="display:inline-block">').hide().appendTo(document.body);
	$.fn.textHeight.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
	var width = $.fn.textHeight.fakeEl.height();
	delete $.fn.textHeight.fakeEl; //cleaning up
	$('#remove').remove(); //cleaning up
	return width;
}; 
// -----------------------------------------------------------------------------------------------
function Bar(){ //bar object for the table. holds relevant data
	this.barObject;
	this.number;
	this.labelText;
	this.labelTextWidth;
	this.labelLeft;
	this.labelObject;
	this.abbrText;
	this.abbrWidth;
	this.left;
	this.barHeight;
}

function textShorten(str, width){ 
	//shortens a given string to below a given width, rounding down
	// and adding ... at the end
	//takes a string to shorten, and a width to shorten to
	//returns an object containing {abbrText: the shortened string, and abbrWidth: the shortened strings Width}
	var conc="...";
	var concWidth=$.fn.textWidth(conc);
	//console.log("cW "+concWidth);
	var trueWidth=width-concWidth;
	var initialSize=$.fn.textWidth(str);
	//console.log("initPx"+initialSize);
	if (initialSize>trueWidth) { 
		var ratio = trueWidth/initialSize // ratio of size, used to convert str length to pixels
		//console.log("ratio "+ratio);
		//console.log("len "+str.length)
		var shortLen = Math.floor(str.length*(ratio) ); //shortened length in letters
		//console.log("newLen "+shortLen);
		var newStr = str.slice(0,shortLen-1).trim()+conc; //final shortened string
		//console.log("newStr "+newStr);
		var newStrSize= $.fn.textWidth(newStr);
		//console.log("newStrSize "+newStrSize);
		//console.log(newStr+" "+newStrSize);
return {"abbrText":newStr, "abbrWidth":newStrSize}; 
	} else { //bump out and return what was given
		return {"abbrText":str, "abbrWidth":initialSize};
	}
}

function setAbbr(){
	// shortens each of the labels to a size that fits under the bars 
	// using the textShorten function
	var data=$('body').data();		 
	var self;
	for (var i = 0; i < data.bars.length; i++) {
		self=data.bars[i];
		returnVar = textShorten(self.labelText, data.barWidth*1.4);
		self.abbrText = returnVar.abbrText;
		self.abbrWidth = returnVar.abbrWidth;
	}
}

function getData(){
	//determines relevant data from a supplied html Table for conversion to a bar graph. 
	
	var data=$('body').data();
	if (!data.bars.length){ //this step is to initiate the bars from the given table, only done once.
		//extracts 'labels' from table headers
		//extracts 'numbers' from table cells

		var h=0;// index counter, this 'each' goes through every table header cell and extracts relevant information
		console.log('hello');
		data.table.find('th').each(function(){
			//console.log( $(this ));
			data.bars.push(new Bar); 
			data.bars[h].labelText= String( $.trim(this.textContent) );
			thisTextWidth=$(this).textWidth();
			data.bars[h].labelTextWidth=thisTextWidth;
			if(thisTextWidth > data.longestTextWidth){
				data.longestTextWidth=thisTextWidth;
				data.longestTextIndex=h;
			}
			data.totalTextWidth+=thisTextWidth;
			//console.log(h);
			h++;
		});
	
		var t=0; // index counter, this 'each' goes through every table cell and extracts relevant information
		data.table.find('td').each(function(){
			thisNumber = Number( $.trim(this.textContent) ); //error here
			data.bars[t].number=thisNumber;
			if(thisNumber > data.highestNumber){
				//console.log("true");
				data.highestNumber=thisNumber;
				data.highestNumberIndex=t;
			}
			data.totalNum+=thisNumber;
			//console.log("index:"+t+" tN "+thisNumber+" hN"+data.highestNumber+" hNi "+data.highestNumberIndex);
			t++;
		});

	// Now we can calculate various metrics about the data itself. 
	// do these on the first run, don't need to be calculated again	
	data.avgTextWidth=data.totalTextWidth/data.bars.length;

	}

	data.min=$.fn.textHeight('M');

	//set the max pixel value depending on how it's configured in the admin console. NOTE: if it can't find #classSize, it defaults to relative
	if ( !isNaN( $("#classSize").textContent ) ){ // if it is set to 'val'
		data.max=Number( $("#classSize").textContent )+1; //##### fix classSize ratio
	} else { // if the max value is a number (ie class size = 10 )
		data.max=(Number(data.highestNumber)*1.2)+1; 
	} 
	//And we can get some more data about the page itself
	data.pageWidth=$('html').outerWidth();
	data.graphHeight=( $('html').outerHeight()-$('header h1').outerHeight(true) )*.6;
	data.graphIndentY=Number( $('header h1').outerHeight(true) );
	if (data.totalTextWidth<=data.pageWidth*.4){ // either we don't have much label text or we have a huge page.
		data.graphWidth=data.pageWidth*.4;
		data.graphIndentX=data.pageWidth*.3;
	} else {//lots of text for the labels or the page is small, lets use what we've got
		data.graphWidth=data.pageWidth*.8;
		data.graphIndentX=data.pageWidth*.1;
	}
	data.barWidth=Number(data.graphWidth/(data.bars.length*2)); 

	data.barStep=data.graphWidth/(data.bars.length+1);

	setAbbr();

	var self,high;
	for (var i = 0; i < data.bars.length; i++) {
		self=data.bars[i];
		if (	( Number(self.number)==0 )		||		( data.graphHeight*( (self.number+1)/data.max ) < data.min ) ){
			high=String(data.min);
		} else {
			high=String(data.graphHeight*((self.number+1)/data.max) );
		}
		self.left=String( (data.graphWidth/(data.bars.length+1)*(i+1))-(data.barWidth/2) ); //step x index, minus half a bar. 
		self.barHeight=high;
		self.labelLeft = String(Number(self.left)+Number(data.barWidth)/2-Number(self.abbrWidth)/2);
	};
};

function updatePositions(){
	//function used to update positions and size of various elements drawn via drawGraph()

	var data=$('body').data();
	data.graphObject.css({ // position the graph
		"width":String(data.graphWidth)+"px",
		"height":String(data.graphHeight)+"px",
		"left":String(data.graphIndentX)+"px",
		"top:":String(data.graphIndentY)+"px"
	});
	var self,bar,label, labelPadding;
	for (var i = 0; i < data.bars.length; i++) { //position the individual bars and labels
		self=data.bars[i];
		bar=self.barObject; //bars
		bar.css({
			"width":String(data.barWidth)+'px',
			"left":self.left+'px'
		});
		bar.delay(100).animate({"height":String(self.barHeight), "opacity":1}, {queue:false}, 900).delay(100);

		label=self.labelObject; //labels
		labelPadding = label.height() /3;
		//console.log("ll "+self.labelLeft+" lP"+labelPadding + " lh"+label.height());
		label.css({
			"left":String(Number(self.labelLeft)-(Number(labelPadding)*2))+"px",
			"padding":String(labelPadding)+'px',
			"bottom":'-'+String(label.height()*2)+'px',
		})
			.text(self.abbrText);
		if ( label.next().hasClass('full') ){ // there is an extended text for this
			label.next().css({
							"width":data.graphWidth+'px',
							//"left":String( Number(data.graphWidth/2) )+'px', //-(Number(self.labelTextWidth)/2)+data.graphIndentX)
							"bottom":'-'+String(label.height()*4)+'px'
							})
		}
	};

	//##### 
	//draw a loading gif in the top right to signify state.
	//AJAX call to page with new JSON
		//sucess
			//for each if a bar number is different, grow it.
			//kill the loading gif. set a recursive timer or just break?
		//fail
			//show a X in the top right to signify failure.

}

function drawGraph() { 
	//primary look and feel of graph is done via CSS using #Graph, .bar, and .label selectors
	//this function inserts the appropriate DOM onto the page, saving each pointer in the data object

	var data=$('body').data();
	data.graphObject= $('<div id="Graph" style="position:absolute;"></div>' );
	$(data.table).after(data.graphObject);
	var str,barElement,labelElement,labelFullElement="";
	for (var i = 0; i < data.bars.length; i++) {
		self=data.bars[i];
		barElement='<figure id="bar'+String(i)+'" class="bar '+String(i)+'"' //this is the bar itself, 
					+'style="position:absolute;text-align:center;margin:0;vertical-align:middle;bottom:0;height:auto;opacity:0"'
					+'">'+self.number
				+'</figure>';
		labelElement='<p class="label '+String(i)+'" id="label'+String(i)+'" style="position:absolute;margin:0;" >'+self.abbrText+'</p>';
	
		self.barObject=$(barElement);
		self.barObject.appendTo('#Graph');

		if (self.abbrWidth != self.labelTextWidth) { // if this one is abbreviated, lets create a hover effect to elongate the text
			labelFullElement='<p class="full label '+String(i)+'" id="full'+String(i)+'" style="position:absolute;margin:0;opacity:0;text-align:center;">'+self.labelText+'</p>';
			console.log(self.labelFullElement);
			self.labelObject=$(labelElement);
			self.labelObject.hover( 
								function(){ //$(this).stop().animate({ width: "200px" });
									$( this ).animate({ opacity:0 }, {queue: false}); //nextAll().not('.bar')
									$( this ).next().animate({ opacity:1 }, {queue: false});
								},
								function (){
									$( this ).animate({ opacity:1 }, {queue: false}); //nextAll().not('.bar')
									$( this ).next().animate({ opacity:0 }, {queue: false});
								})
							.appendTo('#Graph');
			self.labelFullObject=$(labelFullElement);
			self.labelFullObject.appendTo('#Graph');
		} else {
			self.labelObject=$(labelElement);
			self.labelObject.appendTo('#Graph');
		}
	};
} 

function Graph(JQTableObj) { 
	/*	requires JQuery, initialize this function with var graph = new Graph( $("#table") );
		expects table in the format: 
				table 	thead 	tr	th LABEL1 /th 		th LABEL2 /th 	/tr 	/thead
						tbody	tr 	td CONTENT /td 		td CONTENT /td  /tr 	/tbody
				/table
	*/
	var dataObj= { //data to be determined
		"table":JQTableObj,
		"bars":[],
		"longestTextIndex":0, //array index
		"longestTextWidth":0,//px
		"totalTextWidth":0,//px
		"avgTextWidth":0, //px, not including the longest
		"highestNumberIndex":0,//array index
		"highestNumber":0, //int
		"totalNum":0, //int
		"oldData":0
	}
	$('body').data(dataObj);
	var data=$('body').data();

	getData(); //initialize data from the table, modifies data object stores on the HTML body tag, includes setAbbr
	data.table.hide(); //hide the table

	drawGraph(); //draws out the graph

	updatePositions(); //positions and sizes out everything inside (and including) the graph
	//console.clear(); 
	console.dir(data);

	$(window).resize(function() {
		getData();
		updatePositions(); //positions and sizes out everything inside (and including) the graph
		//console.clear(); console.dir(data);
	});
}

function ajaxUpdate(){
	var data=$('body').data();

	$.get( "show/update", function( newData ) {
		if (newData==data.lastData) {//nothing new
			 console.log( "nothing new" );
		} else { //new data!
			 console.log( "Data recieved: "+newData );
			dObj = JSON.parse(newData);
			for (var i = 0; i < data.bars.length; i++) {
				var self=data.bars[i];
				self.number=dObj[self.labelText];
				if(self.number > data.highestNumber){
					//console.log("true");
					data.highestNumber=self.number;
					data.highestNumberIndex=i;
				}
				self.barObject.text(self.number);
				getData();
				updatePositions();
			};
			// console.dir(dObj);
		}
		data.lastData=newData;
	});

}

$(document).ready(function() { //once the page has loaded and JQuery is ready!
	if ( $('#tblAnswers').length != 0 ) { //test if we are locally on the 'show' page
		var graph = new Graph( $("#tblAnswers") );
	} else { throw ''; } //die without an error, we aren't on the right page if we can't find the graph
	
	setInterval(function() {
		ajaxUpdate();
	}, 3000); // default two seconds, increases 2x each iteration
});