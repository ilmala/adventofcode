<?php

namespace App\Submarine;

class Submarine
{
    /**
     * @var bool
     */
    private bool $useAim = false;

    /**
     * @param int $horizontal
     * @param int $depth
     * @param int $aim
     */
    public function __construct(
        public int $horizontal = 0,
        public int $depth = 0,
        public int $aim = 0,
    )
    {
    }

    /**
     * @param array $commands
     */
    public function moves(array $commands): void
    {
        foreach ($commands as $command) {
            $this->executeCommand($command);
        }
    }

    /**
     * @param string $command
     */
    public function executeCommand(string $command): void
    {
        [$type, $unit] = explode(' ', $command);

        match ($type) {
            'forward' => $this->increasesHorizontal(intval($unit)),
            'down' => $this->increasesDepth(intval($unit)),
            'up' => $this->decreasesDepth(intval($unit)),
        };
    }

    /**
     * @return $this
     */
    public function useAim(): self
    {
        $this->useAim = true;

        return $this;
    }

    /**
     * @param int $unit
     */
    protected function increasesHorizontal(int $unit): void
    {
        $this->horizontal += $unit;

        if ($this->useAim) {
            $this->depth += $unit * $this->aim;
        }
    }

    /**
     * @param int $unit
     */
    protected function increasesDepth(int $unit): void
    {
        if ($this->useAim) {
            $this->aim += $unit;
        } else {
            $this->depth += $unit;
        }
    }

    /**
     * @param int $unit
     */
    protected function decreasesDepth(int $unit): void
    {
        if ($this->useAim) {
            $this->aim -= $unit;
        } else {
            $this->depth -= $unit;
        }
    }
}