<?php

use App\Advent;
use App\Submarine\Sonar;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(1);

$sonar = new Sonar();
$sonar->performSweep();

echo "Consider sums of a three-measurement sliding window. How many sums are larger than the previous sum?".PHP_EOL;
echo "Response is ";
echo $sonar->countIncreasesByThree();
echo PHP_EOL;