<?php

$input = 'abcdef';
//$input = 'pqrstuv';

$input = 'ckczppom';

$i=0;
while (true) {
	if (substr(md5($input . ++$i), 0, 6) === '000000') {
		echo "Final: $i " . md5($input.$i) . "\n";
		exit;
	}
}
