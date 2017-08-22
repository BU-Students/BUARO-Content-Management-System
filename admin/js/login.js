var username = document.getElementById("username");
var password = document.getElementById("password");

function enableLogin() {
	var loginButton = document.getElementById("submit");

	//if username and password have values
	if(username.value && password.value)
		loginButton.disabled = false;
	else loginButton.disabled = true;
}