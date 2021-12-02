<?php

use App\Advent;
use App\Submarine\Sonar;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(1);

$sonar = new Sonar();
$sonar->performSweep();

echo "How many measurements are larger than the previous measurement?".PHP_EOL;
echo "Response is ";
echo $sonar->countIncreases();
echo PHP_EOL;