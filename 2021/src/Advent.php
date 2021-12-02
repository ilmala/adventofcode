<?php

namespace App;

class Advent
{
    /**
     * @var int
     */
    private static int $star;

    /**
     * @param int $star
     */
    public static function day(int $star): void
    {
        self::$star = $star;
    }

    /**
     * @return int
     */
    public static function getStar(): int
    {
        return self::$star;
    }
}