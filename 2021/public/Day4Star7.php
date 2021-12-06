<?php

use App\Advent;
use App\Input;
use App\Submarine\Bingo;
use App\Submarine\Diagnostic;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(4);

$bingo = new Bingo();
$bingo->generate();
$score = $bingo->winBoardScore();

echo "To guarantee victory against the giant squid, figure out which board will win first. What will your final score be if you choose that board?" . PHP_EOL;
echo "Response is {$score}";
echo PHP_EOL;