<?php

use App\Advent;
use App\Input;
use App\Submarine\Sonar;
use App\Support\Math;

it('can calculate the most common number', function () {

    $mostCommon = Math::mostCommon([
        0,1,1,1,1
    ]);

    expect($mostCommon)->toEqual(1);

    $mostCommon = Math::mostCommon([
        0,0,0,1,0
    ]);

    expect($mostCommon)->toEqual(0);
});