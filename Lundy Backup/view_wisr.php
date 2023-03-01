<?php
$filename = "Expanded WISR (34124) 2017-09-26.html";

$input = @file_get_contents("uploads/". $filename) or die("Could not access file: $address");
$line = preg_replace('/\s+/',preg_replace('/(&nbsp;|<br>)+/', ' ',$input),' ');

if(preg_match('/<td valign="top">.*<\/td>/', $line, $first_match)) {
	
	$Pattern	= "/([0-9]*(oz))?[a-z]+([0-9]*\s*oz|[\s\'\.\-\/]*)?([a-z]+)?\s*(Drink\s*[0-9])?(kg|ct|l)(\s*[0-9]*\.[0-9]{0,2}){5}/i";
	
	if(preg_match_all($Pattern, $first_match[0], $second_match)) {
		foreach($second_match[0] as $v) {
			echo $v . "<br />";
		}
	}

}

?>