<?php

namespace App\Support;

class Math
{
    public static function mostCommon(array $data, int $default = null): int
    {
        $results = array_count_values($data);

        if ($results[0] === $results[1] and !is_null($default)) {
            return $default;
        }

        $max = max($results);

        return array_flip($results)[$max];
    }

    public static function leastCommon(array $data, int $default = null): int
    {
        $results = array_count_values($data);

        if ($results[0] === $results[1] and !is_null($default)) {
            return $default;
        }

        $max = min($results);

        return array_flip($results)[$max];
    }

    public static function binToDecimal(string $number): int
    {
        return bindec($number);
    }
}