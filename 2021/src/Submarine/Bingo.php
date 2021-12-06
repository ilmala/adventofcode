<?php

namespace App\Submarine;

use App\Input;
use JetBrains\PhpStorm\Pure;

class Bingo
{
    public array $draws;

    public array $boards;

    public function generate(): void
    {
        $data = array_filter(Input::get());

        $drawNumbersString = array_shift($data);
        $this->draws = array_map('intval', explode(',', $drawNumbersString));

        $data = array_map(function ($row) {
            return array_map('intval', str_split($row, 3));
        }, $data);

        $this->boards = array_chunk($data, 5);
    }

    public function winBoardScore(): int
    {
        $drawNumbers = [];
        $winBoard = null;
        $lastDrawNumber = null;

        foreach ($this->draws as $index => $draw) {
            $lastDrawNumber = $draw;
            array_push($drawNumbers, $draw);

            foreach ($this->boards as $board) {
                if ($this->isWinBoard($board, $drawNumbers)) {
                    $winBoard = $board;
                    break;
                }
            }

            if (!is_null($winBoard)) {
                break;
            }

        }

        $sumUnmarked = $this->sumUnmarkedNumber($winBoard, $drawNumbers);

        return intval($sumUnmarked * $lastDrawNumber);
    }

    public function winLastBoardScore()
    {
        $drawNumbers = [];
        $winBoard = [];
        $lastDrawNumber = null;

        foreach ($this->draws as $index => $draw) {
            $lastDrawNumber = $draw;
            array_push($drawNumbers, $draw);

            foreach ($this->boards as $index2=>$board) {
                if(in_array($index2, $winBoard)){
                    continue;
                }
                if ($this->isWinBoard($board, $drawNumbers)) {
                    $winBoard[] = $index2;
                }
            }

            if(count($winBoard)===count($this->boards)){
                break;
            }
        }

        $lastWinBoardIndex = $winBoard[array_key_last($winBoard)];
        $lastWinBoard = $this->boards[$lastWinBoardIndex];

        $sumUnmarked = $this->sumUnmarkedNumber($lastWinBoard, $drawNumbers);

        return intval($sumUnmarked * $lastDrawNumber);
    }

    #[Pure] public function isWinBoard(array $board, array $drawNumbers): bool
    {
        foreach ($board as $row) {
            if ($this->isWinRow($row, $drawNumbers)) {
                return true;
            }
        }

        $transposedBoard = array_map(null, ...$board);

        foreach ($transposedBoard as $row) {
            if ($this->isWinRow($row, $drawNumbers)) {
                return true;
            }
        }

        return false;
    }

    #[Pure] public function isWinRow(array $row, array $drawNumbers): bool
    {
        foreach ($row as $number) {
            if (!$this->numberIsDraw($number, $drawNumbers)) {
                return false;
            }
        }

        return true;
    }

    public function numberIsDraw(int $number, array $drawNumbers): bool
    {
        return in_array($number, $drawNumbers);
    }

    /**
     * @param $winBoard
     * @param array $drawNumbers
     * @return int
     */
    protected function sumUnmarkedNumber($winBoard, array $drawNumbers): int
    {
        $sum= array_sum(array_filter(array_merge(...$winBoard), function ($number) use ($drawNumbers) {
            return !$this->numberIsDraw($number, $drawNumbers);
        }));

        return intval($sum);
    }
}