<?php

namespace Saku\Guess;

/**
* Generating histogram data.
*/
class Histogram
{
    /**
    * @var array $serie  The numbers stored in sequence.
    * @var int   $min    The lowest possible number.
    * @var int   $max    The highest possible number.
    */
    private $serie = [];
    private $min;
    private $max;

    /**
    * Get the serie.
    *
    * @return array with the serie.
    */
    public function getSerie()
    {
        return $this->serie;
    }

    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }


    public function getAsText()
    {
        $one = 0;
        $two = 0;
        $three = 0;
        $four = 0;
        $five = 0;
        $six = 0;
        for ($i = 0; $i < 5; $i++) {
            if ($this->serie[$i] === 1) {
                $one  ++;
            } elseif ($this->serie[$i] === 2) {
                $two  ++;
            } elseif ($this->serie[$i] === 3) {
                $three  ++;
            } elseif ($this->serie[$i] === 4) {
                $four  ++;
            } elseif ($this->serie[$i] === 5) {
                $five ++;
            } elseif ($this->serie[$i] === 6) {
                $six ++;
            }
        }
        $arr = array($one, $two, $three, $four, $five, $six);
        return $arr;
    }
}
