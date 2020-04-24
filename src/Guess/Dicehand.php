<?php

namespace Saku\Guess;

class Dicehand implements HistogramInterface
{
    use HistogramTrait;

    private $hand;
    private $throw;

    public function __construct(int $throw = 0)
    {
        $this->$throw = 0;
        $this->hand = new \Saku\Guess\Dice();
    }

    public function roll()
    {
        return $this->hand = $this->hand->throw();
    }

    public function ifOne()
    {
        $found = false;
        foreach ($this->hand as $value) {
            if ($value == 1) {
                $found = true;
            }
        }
        return $found;
    }

    public function sum()
    {
        return array_sum($this->hand);
    }

    public function totalsum()
    {
        $this->throw += array_sum($this->hand);
        return $this->throw;
    }

    public function roller()
    {
        $this->hand = $this->hand->throw();
        return $this->serie;
    }
}
