var /*topbar, topbar1, tapbar2, topbar3, topbar4, topbar5,*/ boxes, boxes1, boxes2, boxes3, boxes4, boxes5, boxes6, boxes7, boxes8, boxes9, boxes10, yPos;
function yScroll(){
	/*topbar = document.getElementById('topbar');
	topbar1 = document.getElementById('topbar1');
	topbar2 = document.getElementById('topbar2');
	topbar3 = document.getElementById('topbar3');
	topbar4 = document.getElementById('topbar4');
	topbar5 = document.getElementById('topbar5');*/
	boxes = document.getElementById('boxes');
	boxes1 = document.getElementById('boxes1');
	boxes2 = document.getElementById('boxes2');
	boxes3 = document.getElementById('boxes3');
	boxes4 = document.getElementById('boxes4');
	boxes5 = document.getElementById('boxes5');
	boxes6 = document.getElementById('boxes6');
	boxes7 = document.getElementById('boxes7');
	boxes8 = document.getElementById('boxes8');
	boxes9 = document.getElementById('boxes9');
	boxes10 = document.getElementById('boxes10');
	yPos = window.pageYOffset;
	/*if (yPos > 100){  									//This is Edited
		topbar.style.height = "75px";
		topbar.style.paddingTop = "15px";
		topbar1.style.visibility = "visible";
		topbar1.style.opacity = "1";
		topbar3.style.opacity = "0";
	} else {
		topbar.style.height = "0px";
		topbar.style.paddingTop = "0px";
		topbar1.style.display = "hidden";
		topbar1.style.opacity = "0";
		topbar3.style.opacity = "0";
	}
	if (yPos > 600) {
		topbar.style.display = "hidden";
		topbar1.style.opacity = "0";
		topbar2.style.visibility = "visible"
		topbar3.style.opacity = "1";
	}
	if (yPos > 2100) {
		topbar.style.display = "hidden";
		topbar1.style.opacity = "0";
		topbar2.style.display = "hidden";
		topbar3.style.opacity = "0";
		topbar4.style.visibility = "visible";
		topbar5.style.opacity = "1";
	} else{
		topbar5.style.opacity = "0";
	}*/

	if (yPos > 2000) {
		boxes.style.opacity = "1";
		boxes.style.transition = "1s";
	}
	else {
		boxes.style.opacity = "0";
	}
	if (yPos > 2100) {
		boxes1.style.opacity = "1";
		boxes1.style.transition = "1s";
	}
	else {
		boxes1.style.opacity = "0";
	}
	if (yPos > 2150) {
		boxes2.style.opacity = "1";
		boxes2.style.transition = "1s";
	}
	else {
		boxes2.style.opacity = "0";
	}
	if (yPos > 2250) {
		boxes3.style.opacity = "1";
		boxes3.style.transition = "1s";
	}
	else {
		boxes3.style.opacity = "0";
	}
	if (yPos > 2300) {
		boxes4.style.opacity = "1";
		boxes4.style.transition = "1s";
	}
	else {
		boxes4.style.opacity = "0";
	}
	if (yPos > 2400) {
		boxes5.style.opacity = "1";
		boxes5.style.transition = "1s";
	}
	else {
		boxes5.style.opacity = "0";
	}
	if (yPos > 2450) {
		boxes6.style.opacity = "1";
		boxes6.style.transition = "1s";
	}
	else {
		boxes6.style.opacity = "0";
	}
	if (yPos > 2550) {
		boxes7.style.opacity = "1";
		boxes7.style.transition = "1s";
	}
	else {
		boxes7.style.opacity = "0";
	}
	if (yPos > 2600) {
		boxes8.style.opacity = "1";
		boxes8.style.transition = "1s";
	}
	else {
		boxes8.style.opacity = "0";
	}
	if (yPos > 2700) {
		boxes9.style.opacity = "1";
		boxes9.style.transition = "1s";
	}
	else {
		boxes9.style.opacity = "0";
	}
	if (yPos > 2750) {
		boxes10.style.opacity = "1";
		boxes10.style.transition = "1s";
	}
	else{
		boxes10.style.opacity = "0";
	}
}
window.addEventListener("scroll", yScroll);

	