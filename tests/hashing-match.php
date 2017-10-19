<?php

include_once('./BruteForcer.php');

$bf = new BruteForcer();

$d1 = microtime(1);

$hasher = function($str) {
  $arr = str_split($str);
  $out = 1;
  foreach($arr as $char) {
    $out += $out * ord($char);
  }
  return $out;
};

if($bf->match(14251497120, $hasher)) {
    $diff = (int) (microtime(1) - $d1) * 1000;
    echo "Successfully matched 'hello' with hashing function in ".$bf->roundcount." rounds (".$diff."ms)\n";
}