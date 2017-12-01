<?php

$input = 'hijklmmn';
$input = 'abbcegjk';
$input = 'abbceffg';
$input = 'abcdffaa';

while (true) {
    if (validate($input)) {
        echo $input . ' is valid' . "\n";
        exit;
    } else {
        echo $input . ' is not valid' . "\n";
        ++$input;
    }
}

/*
function increment($in) {
    return ++$in;
}
*/

function validate($in) {
    // $ord = preg_replace_callback('/./', function($i) {
    //     return ord($i[0]) . '|';
    // }, $in);

    // if (!preg_match('/(\d+)\|(\1~)\|(\2~)/', $ord, $matches)) {
    //     echo 'no incrementing things' . "\n";
    //     return false;
    // }
    //     var_dump($matches);
    //     exit;

    if (preg_match('/i|o|l/', $in)) {
        echo 'i|o|l' . "\n";
        return false;
    }

    if (!preg_match('/(\w)\1.*(\w)\2/', $in)) {
        echo 'no dual letter matches' . "\n";
        return false;
    }

    $len = strlen($in);
    $seq = 1;
    for ($i = 0; $i <= $len; $i++) {
        $char = ord(substr($v, $i, 1));
        echo $seq . "\n";
        if ($char == $prev+1) {
            $seq++;
        } else {
            $seq = 1;
        }
        if ($seq == 3) {
            return true;
        }
        $prev = $char;
    }
    echo 'no seq' . "\n";
    return false;
}