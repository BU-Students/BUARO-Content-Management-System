<?php

function encode($input) {
	return htmlspecialchars($input, ENT_HTML5 | ENT_QUOTES);
}

function decode($string) {
	return htmlspecialchars_decode($string, ENT_HTML5 | ENT_QUOTES);
}

?>