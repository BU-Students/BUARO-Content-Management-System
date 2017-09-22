<?php 

function shift($ch, $key) {
	if (!ctype_alpha($ch))
		return $ch;

	$offset = ord(ctype_upper($ch) ? 'A' : 'a');
	return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
}

function ceasarian_cipher($input, $key) {
	$output = "";
	$inputArr = str_split($input);
	foreach ($inputArr as $ch)
		$output .= shift($ch, $key);

	return $output;
}

function encrypt($password) {
	$c_pass = ceasarian_cipher($password, 1);
	$salt = md5($c_pass);
	$sha = sha1($salt.$c_pass.$salt);
	$encrypted_password = md5($sha.$salt);
	return $encrypted_password;
}

?>