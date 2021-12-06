<?php

use App\Advent;
use App\Input;
use App\Submarine\Bingo;
use App\Submarine\Diagnostic;

require_once __DIR__ . '/../vendor/autoload.php';

Advent::day(4);

$bingo = new Bingo();
$bingo->generate();
$score = $bingo->winLastBoardScore();

echo "Figure out which board will win last. Once it wins, what would its final score be?" . PHP_EOL;
echo "Response is {$score}";
echo PHP_EOL;