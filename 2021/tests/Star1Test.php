<?php

use App\Advent;
use App\Input;
use App\Submarine\Sonar;

it('can het sonar sweep measurement', function () {

    Advent::day(1);

    $sonar = new Sonar();
    $sonar->performSweep();

    expect($sonar->measurement())->toBeArray();
});

it('can count the number of times a depth measurement increases', function () {

    Input::fake([199, 200, 208, 210, 200, 207, 240, 269, 260, 263]);

    $sonar = new Sonar();
    $sonar->performSweep();

    expect($sonar->countIncreases())->toEqual(7);
});
