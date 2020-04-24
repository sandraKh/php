<?php

namespace Saku\Guess;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram2 extends Dice implements HistogramInterface
{
    use HistogramTrait;



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    // public function getHistogramMax()
    // {
    //     return $this->throws;
    // }

    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->serie = parent::throw();
        return $this->serie;
    }

    public function ifOne()
    {
        $found = false;
        foreach ($this->serie as $value) {
            if ($value == 1) {
                $found = true;
            }
        }
        return $found;
    }

    public function sum()
    {
        return array_sum($this->serie);
    }

    public function totalsum()
    {
        // $this->throws += array_sum($this->serie);
        // return $this->throws;
        return array_sum($this->serie);
    }
}
