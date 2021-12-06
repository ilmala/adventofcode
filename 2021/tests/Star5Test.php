<?php

use App\Advent;
use App\Input;
use App\Submarine\Diagnostic;
use App\Support\Math;

it('can calc the power consumption', function () {

    Advent::day(3);

    Input::fake([
        '00100',
        '11110',
        '10110',
        '10111',
        '10101',
        '01111',
        '00111',
        '11100',
        '10000',
        '11001',
        '00010',
        '01010',
    ]);

    $result = Diagnostic::report(Input::get());

    expect($result['gamma'])->toEqual(22);
    expect($result['epsilon'])->toEqual(9);
    expect($result['power_consumption'])->toEqual(198);
});
