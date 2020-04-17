<?php


namespace Saku\Guess;

class Dice
{
    private $sum;
    private $throws;
    private $random;

    public function __construct(int $sum = 0, $throws = 5)
    {
        $this->sum = $sum;
        $this->throws = $throws;
        $this->random = [];
    }

    public function throw()
    {
        $number = 0;
        while ($number < $this->throws) {
            array_push($this->random, rand(1, 6));
            $this->sum += $this->random[$number];
            $number += 1;
        }
        return $this->random;
    }
}
