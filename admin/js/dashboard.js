function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		///handle error
	}
}

function showPosition(position) {
	//https://blog.darksky.net/forecast-embeds/
	document.getElementById("forecast_embed").src = "//forecast.io/embed/#lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&name=Bagumbayan%2C%20Daraga%2C%20Albay";
}

getLocation();