<?php

namespace App;

class Input
{
    /**
     * @var array|null
     */
    protected static null|array $fakeData = null;

    /**
     * @return array
     */
    public static function get(): array
    {
        if (!is_null(self::$fakeData)) {
            return self::$fakeData;
        }

        $starNumber = Advent::getStar();
        $content = file_get_contents(__DIR__ . "/../inputs/day_{$starNumber}_input.txt");

        return array_filter(explode(PHP_EOL, $content));
    }

    /**
     * @param array $data
     */
    public static function fake(array $data)
    {
        self::$fakeData = $data;
    }
}