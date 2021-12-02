<?php

namespace App\Submarine;

use App\Input;

class Sonar
{
    /**
     * @param array|null $measurement
     */
    public function __construct(
        protected ?array $measurement = null
    )
    {
    }

    /**
     * @return $this
     */
    public function performSweep(): self
    {
        $this->measurement = Input::get(1);

        return $this;
    }

    /**
     * @return array
     */
    public function measurement(): array
    {
        return $this->measurement;
    }

    /**
     * @return int
     */
    public function countIncreases(): int
    {
        $increases = 0;

        for ($i = 1; $i < count($this->measurement); $i++) {
            if ($this->measurement[$i] > $this->measurement[$i - 1]) {
                $increases++;
            }
        }

        return $increases;
    }

    /**
     * @return int
     */
    public function countIncreasesByThree(): int
    {
        $increases = 0;

        for ($i = 0; $i < count($this->measurement) - 3; $i++) {
            $firstWindowSum = array_sum(array_slice($this->measurement, $i, 3));
            $secondWindowSum = array_sum(array_slice($this->measurement, $i + 1, 3));

            if ($secondWindowSum > $firstWindowSum) {
                $increases++;
            }
        }

        return $increases;
    }
}