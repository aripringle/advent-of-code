<?php

ini_set('memory_limit', -1);
//$input = 1113222113;
$input = 1113222113;

for ($i=0; $i<40; $i++) {
	$string = '';
	$matches = [];
	preg_match_all('/((\d)\2*)/', $input, $matches);
	foreach ($matches[0] as $match) {
		$string .= strlen($match) . substr($match, 0, 1);
	}
	$input  = $string;
	//echo "input on $i: $input\n";
}

echo strlen($input) . "\n";
//echo $input;




/*
$len = strlen($input);
for ($i = 0; $i <= $len; $i++) {
        $char = substr($input, $i, 1);
	
*/
