<?php

//I went to https://timesofindia.indiatimes.com/toireporter/author-Abhinav-Garg-17359.cms
//Then I used $('#authorlist a').each(function(i,v){console.log(v.innerHTML)})
//That gave me a nice list of names over which I can iterate.

$namesString = file_get_contents('names.txt');

$namesArray = explode(',', $namesString);
$emails = [];

foreach($namesArray as $name){
	//Yes, the spec says email names should be case-insensitive. 
	//But all mentions of the TOI format I've seen online show it as lowercase.
	//So it's probably best not to take any chances.
	$name = trim(strtolower($name));
	$nameParts = explode(' ', $name);
	//We don't want three-part names, since I don't know the pattern for those.
	if (count($nameParts) !== 2) {
		continue;	
	}
	//We also don't want single-letter first names for the same reason.
	if (strlen($nameParts[0]) === 1) {
		continue;
	}

	$emails[] = "$nameParts[0].$nameParts[1]@timesgroup.com";

}

file_put_contents('emails.md', implode(", ", $emails));
