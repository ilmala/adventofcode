<?php

namespace App\Submarine;

class Submarine
{
    private bool $useAim = false;

    public function __construct(
        public int $horizontal = 0,
        public int $depth = 0,
        public int $aim = 0,
    )
    {
    }

    public function moves(array $commands): void
    {
        foreach ($commands as $command) {
            $this->executeCommand($command);
        }
    }

    public function executeCommand(string $command): void
    {
        [$type, $unit] = explode(' ', $command);

        match ($type) {
            'forward' => $this->increasesHorizontal(intval($unit)),
            'down' => $this->increasesDepth(intval($unit)),
            'up' => $this->decreasesDepth(intval($unit)),
        };
    }

    public function useAim(): self
    {
        $this->useAim = true;

        return $this;
    }

    protected function increasesHorizontal(int $unit)
    {
        $this->horizontal += $unit;

        if ($this->useAim) {
            $this->depth += $unit * $this->aim;
        }
    }

    protected function increasesDepth(int $unit)
    {
        if ($this->useAim) {

            $this->aim += $unit;
        } else {
            $this->depth += $unit;
        }
    }

    protected function decreasesDepth(int $unit)
    {
        if ($this->useAim) {
            $this->aim -= $unit;
        }else{
            $this->depth -= $unit;
        }
    }
}