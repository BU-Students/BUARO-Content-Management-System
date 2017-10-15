//For the pagination arrows
var eventcurpage = 1;//Global variable to determine which page in story currently in
var storycurpage = 1;//Global variable to determine which page in event currently in
//For Stories
function incrpge(max){
	if(storycurpage>=max){
		console.log(storycurpage);
		document.getElementById("story-page-1").className="hidden";
	}
	else{
		storycurpage++;
		console.log(storycurpage);
		document.getElementById("story-cont").innerHTML = document.getElementById("story-page-"+storycurpage).innerHTML;
		document.getElementById("story-page-1").className="hidden";
	}
}
function decrpge(max){
	if(storycurpage<=1){
		console.log("ehh");
		document.getElementById("story-page-1").className="hidden";
	}
	else{
		storycurpage=storycurpage-1;
		console.log(storycurpage);
		document.getElementById("story-cont").innerHTML = document.getElementById("story-page-"+storycurpage).innerHTML;
		document.getElementById("story-page-1").className="hidden";
	}
}
//For events
function incrpge_event(max){
	if(eventcurpage>=max){
		console.log("ehh1");
		document.getElementById("event-page-1").className="hidden";
	}
	else{
		eventcurpage++;
		document.getElementById("event-cont").innerHTML = document.getElementById("event-page-"+eventcurpage).innerHTML;
		document.getElementById("event-page-1").className="hidden";
	}
}
function decrpge_event(max){
	if(eventcurpage<=1){
		console.log("ehh");
	}
	else{
		eventcurpage=eventcurpage-1;	
		document.getElementById("event-cont").innerHTML = document.getElementById("event-page-"+eventcurpage).innerHTML;
		document.getElementById("event-page-1").className="hidden";
	}
}
