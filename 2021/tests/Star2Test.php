<?php

use App\Advent;
use App\Input;
use App\Submarine\Sonar;


it('can count increases using three-measurement sliding window', function () {

    Input::fake([199, 200, 208, 210, 200, 207, 240, 269, 260, 263]);

    $sonar = new Sonar();
    $sonar->performSweep();

    expect($sonar->countIncreasesByThree())->toEqual(5);
});
