<?php

namespace App;

class Input
{

    protected static $fakeData;

    public static function get(): array
    {
        if(!is_null(self::$fakeData)){
            return self::$fakeData;
        }

        $starNumber = Advent::getStar();
        $content = file_get_contents(__DIR__ . "/../inputs/star_{$starNumber}_input.txt");

        return array_filter(explode(PHP_EOL, $content));
    }

    public static function fake(array $data)
    {
        self::$fakeData = $data;
    }
}