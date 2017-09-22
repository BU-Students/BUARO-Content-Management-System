function openCity(evt, cityName) {
	var i;
	var x = document.getElementsByClassName("city");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	var activebtn = document.getElementsByClassName("testbtn");
	for (i = 0; i < x.length; i++) {
		activebtn[i].classList.remove("w3-dark-grey");
	}
	document.getElementById(cityName).style.display = "block";
	evt.currentTarget.classList.add("w3-dark-grey");
}

//Guide to the user