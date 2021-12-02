<?php

use App\Advent;
use App\Input;
use App\Submarine\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(2);

$submarine = new Submarine();
$submarine
    ->useAim()
    ->moves(Input::get());

$multiplyResult = $submarine->horizontal * $submarine->depth;

echo "Calculate the horizontal position and depth you would have after following the planned course. What do you get if you multiply your final horizontal position by your final depth?" . PHP_EOL;
echo "Response is H: {$submarine->horizontal} - D: {$submarine->depth}. (Multiply result: {$multiplyResult} )";
echo PHP_EOL;