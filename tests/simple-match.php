<?php

include_once('./BruteForcer.php');

$bf = new BruteForcer();

$d1 = microtime(1);

if($bf->match('hello')) {
    $diff = (int) (microtime(1) - $d1) * 1000;
    echo "Successfully matched 'hello' in ".$bf->roundcount." rounds (".$diff."ms)\n";
}
