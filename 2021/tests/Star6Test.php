<?php

use App\Advent;
use App\Input;
use App\Submarine\Diagnostic;
use App\Support\Math;

it('can calc the life support rating', function () {

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

    expect($result['oxygen_generator'])->toEqual(23);
    expect($result['CO2_scrubber_rating'])->toEqual(10);
    expect($result['life_support_rating'])->toEqual(230);
});
