<?php

use App\Advent;
use App\Input;
use App\Submarine\Sonar;
use App\Submarine\Submarine;


it('increases your aim by X units if down X', function () {

    $submarine = new Submarine();
    $submarine->useAim()->executeCommand('down 8');


    expect($submarine->aim)->toEqual(8);
});

it('decreases your aim by X units if up X ', function () {

    $submarine = new Submarine();
    $submarine->useAim()->executeCommand('down 8');
    $submarine->useAim()->executeCommand('up 4');


    expect($submarine->aim)->toEqual(4);
});

it('increases horizontal position by X units and increases your depth by your aim multiplied by X if forward X', function () {

    $submarine = new Submarine();
    $submarine->useAim()->executeCommand('forward 5');
    $submarine->useAim()->executeCommand('down 5');
    $submarine->useAim()->executeCommand('forward 8');


    expect($submarine->horizontal)->toEqual(13);
    expect($submarine->aim)->toEqual(5);
    expect($submarine->depth)->toEqual(40);
});

it('can move using AIM', function () {

    Input::fake([
        'forward 5',
        'down 5',
        'forward 8',
        'up 3',
        'down 8',
        'forward 2'
    ]);

    $submarine = new Submarine();
    $submarine->useAim()->moves(Input::get());


    expect($submarine->horizontal)->toEqual(15);
    expect($submarine->aim)->toEqual(10);
    expect($submarine->depth)->toEqual(60);

    expect($submarine->horizontal * $submarine->depth)->toEqual(900);
});
