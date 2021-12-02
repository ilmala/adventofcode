<?php

use App\Advent;
use App\Input;
use App\Submarine\Sonar;
use App\Submarine\Submarine;


it('submarine can go forward', function () {

    $submarine = new Submarine();
    $submarine->executeCommand('forward 5');


    expect($submarine->horizontal)->toEqual(5);
    expect($submarine->depth)->toEqual(0);
});

it('submarine can go down', function () {

    $submarine = new Submarine();
    $submarine->executeCommand('down 3');

    expect($submarine->horizontal)->toEqual(0);
    expect($submarine->depth)->toEqual(3);
});

it('submarine can go up', function () {

    $submarine = new Submarine();
    $submarine->executeCommand('down 5');
    $submarine->executeCommand('up 3');

    expect($submarine->horizontal)->toEqual(0);
    expect($submarine->depth)->toEqual(2);
});

it('can execute multiple commands', function () {

    Input::fake([
        "forward 5",
        "down 5",
        "forward 8",
        "up 3",
        "down 8",
        "forward 2",
    ]);

    $submarine = new Submarine();
    $submarine->moves(Input::get(3));

    expect($submarine->horizontal)->toEqual(15);
    expect($submarine->depth)->toEqual(10);
});