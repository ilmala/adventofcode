<?php

namespace App\Submarine;

use App\Support\Math;

class Diagnostic
{

    public static function report(array $numbers)
    {
        $data = [];

        $matrix = array_map('str_split', $numbers);

        //transposing - flip array cols and rows
        $transposedMatrix = array_map(null, ...$matrix);

        $gammaRate = implode('', array_map(function ($rows) {
            return Math::mostCommon($rows);
        }, $transposedMatrix));

        $epsilonRate = implode('', array_map(function ($rows) {
            return Math::leastCommon($rows);
        }, $transposedMatrix));

        //oxygen generator
        $oxygenGenerator = self::oxygenGenerator($matrix);
        $CO2ScrubberRating = self::CO2ScrubberRating($matrix);

        return [
            'gamma' => Math::binToDecimal($gammaRate),
            'epsilon' => Math::binToDecimal($epsilonRate),
            'power_consumption' => Math::binToDecimal($gammaRate) * Math::binToDecimal($epsilonRate),
            'oxygen_generator' => $oxygenGenerator,
            'CO2_scrubber_rating' => $CO2ScrubberRating,
            'life_support_rating' => $oxygenGenerator * $CO2ScrubberRating,
        ];
    }

    /**
     * @param array $matrix
     * @return int
     */
    public static function oxygenGenerator(array $matrix): int
    {
        $result = $matrix;

        for ($i = 0; $i < count($matrix[0]); $i++) {
            //transposing - flip array cols and rows
            $transposedMatrix = array_map(null, ...$result);

            $mostCommonBit = Math::mostCommon($transposedMatrix[$i], 1);

            $result = array_values(array_filter($result, function ($row) use ($mostCommonBit, $i) {
                return $row[$i] == $mostCommonBit;
            }));

            if (count($result) === 1) {
                break;
            }
        }

        return intval(bindec(implode('', $result[0])));
    }

    public static function CO2ScrubberRating(array $matrix): int
    {
        $result = $matrix;

        for ($i = 0; $i < count($matrix[0]); $i++) {
            //transposing - flip array cols and rows
            $transposedMatrix = array_map(null, ...$result);

            $leastCommonBit = Math::leastCommon($transposedMatrix[$i], 0);

            $result = array_values(array_filter($result, function ($row) use ($leastCommonBit, $i) {
                return $row[$i] == $leastCommonBit;
            }));

            if (count($result) === 1) {
                break;
            }
        }

        return intval(bindec(implode('', $result[0])));
    }
}