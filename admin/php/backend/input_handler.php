<?php

//before inserting input to the database
//Any newlines will be converted into break rules before inserting to the database
function encode($string) {
	return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
// 	return htmlspecialchars(str_replace("\n", "<br/>", $string), ENT_HTML5 | ENT_QUOTES); //backup
}

//after retrieving encoded data from database
function decode($string) {
	return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
}

?>