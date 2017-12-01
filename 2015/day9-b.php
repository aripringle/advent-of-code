<?php
$input = <<<EOD
Faerun to Norrath = 129
Faerun to Tristram = 58
Faerun to AlphaCentauri = 13
Faerun to Arbre = 24
Faerun to Snowdin = 60
Faerun to Tambi = 71
Faerun to Straylight = 67
Norrath to Tristram = 142
Norrath to AlphaCentauri = 15
Norrath to Arbre = 135
Norrath to Snowdin = 75
Norrath to Tambi = 82
Norrath to Straylight = 54
Tristram to AlphaCentauri = 118
Tristram to Arbre = 122
Tristram to Snowdin = 103
Tristram to Tambi = 49
Tristram to Straylight = 97
AlphaCentauri to Arbre = 116
AlphaCentauri to Snowdin = 12
AlphaCentauri to Tambi = 18
AlphaCentauri to Straylight = 91
Arbre to Snowdin = 129
Arbre to Tambi = 53
Arbre to Straylight = 40
Snowdin to Tambi = 15
Snowdin to Straylight = 99
Tambi to Straylight = 70
EOD;

/*
$input = <<<EOD
London to Dublin = 464
London to Belfast = 518
Dublin to Belfast = 141
EOD;
*/

$locs = [];
foreach (preg_split('/\n/', $input) as $line) {
	preg_match('/(.*) to (.*) = (.*)/', $line, $matches);
	$source = $matches[1];
	$dest = $matches[2];

	if (!in_array($source, $locs)) {
		$locs[] = $source;
	}
	if (!in_array($dest, $locs)) {
		$locs[] = $dest;
	}

	$dist[$source][$dest] = $matches[3];
	$dist[$dest][$source] = $matches[3];
}

foreach ($locs as $loc) {
	arsort($dist[$loc]);
}

function processLoc($loc, $distance, $path, $processed) {
	global $dist;
	global $paths;
	foreach ($dist[$loc] as $dest => $val) {
		if (in_array($dest, $processed)) { continue; }
		$mypath = "$path->$dest";
		$mydistance = $val;
		$distance += $val;
		$paths[$mypath] = 1;
		//echo "$distance: $path\n";
		$myprocessed = $processed;
		$myprocessed[] = $dest;
		$mydistance += processLoc($dest, $distance, $mypath, $myprocessed);
	}

	return $mydistance;
}

foreach ($locs as $loc) {
	$processedLocs = [];
	$path = "$loc";
	$processedLocs[] = $loc;
	processLoc($loc, 0, $path, $processedLocs) . ": $loc Longest" . "\n";
}

foreach (array_keys($paths) as $path) {
	$prev = '';
	$pathdist = 0;
	foreach (explode('->', $path) as $loc) {
		if ($prev) {
			$pathdist += $dist[$prev][$loc];
//echo "adding path for $prev->$loc: " . $dist[$prev][$loc] . "\n";
		}
		$prev = $loc;
	}
	echo "$pathdist: $path\n";
}

//var_dump($paths);
