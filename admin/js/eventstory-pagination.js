//For the pagination arrows
var eventcurpage = 1;//Global variable to determine which page in story currently in
var storycurpage = 1;//Global variable to determine which page in event currently in
//For Stories
function incrpge(max){
	if(storycurpage>=max){
		console.log(storycurpage);
	}
	else{
		storycurpage++;
		console.log(storycurpage);
		document.getElementById("story-cont").innerHTML = document.getElementById("story-page-"+storycurpage).innerHTML;
	}
}
function decrpge(max){
	if(storycurpage<=1){
		console.log("ehh");
	}
	else{
		storycurpage=storycurpage-1;
		console.log(storycurpage);
		document.getElementById("story-cont").innerHTML = document.getElementById("story-page-"+storycurpage).innerHTML;
	}
}
//For events
function incrpge_event(max){
	if(eventcurpage>=max){
		console.log("ehh1");
	}
	else{
		eventcurpage++;
		
		document.getElementById("event-cont").innerHTML = document.getElementById("event-page-"+eventcurpage).innerHTML;
	}
}
function decrpge_event(max){
	if(eventcurpage<=1){
		console.log("ehh");
	}
	else{
		eventcurpage=eventcurpage-1;
		
		document.getElementById("event-cont").innerHTML = document.getElementById("event-page-"+eventcurpage).innerHTML;
	}
}
function txtchange(val){
				if(document.getElementById("readmore-"+val).innerHTML=="Click to read more..."){
					document.getElementById("readmore-"+val).innerHTML="Click to read less";
					console.log(val);
				}
				else
					document.getElementById("readmore-"+val).innerHTML="Click to read more...";
			}
