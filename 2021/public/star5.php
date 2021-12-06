<?php

use App\Advent;
use App\Input;
use App\Submarine\Diagnostic;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(3);

$result = Diagnostic::report(Input::get());

echo "Use the binary numbers in your diagnostic report to calculate the gamma rate and epsilon rate, then multiply them together. What is the power consumption of the submarine?" . PHP_EOL;
echo "Response is {$result['power_consumption']}";
echo PHP_EOL;