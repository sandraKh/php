<?php

namespace Saku\Guess;

/**
* A trait implementing histogram for integers.
*/
trait HistogramTrait
{
    /**
    * @var array $serie  The numbers stored in sequence.
    */
    private $serie = [];



    /**
    * Get the serie.
    *
    * @return array with the serie.
    */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    public function getHistogramMax()
    {
        return count($this->serie);
    }

    public function getHistogramMin()
    {
        return 1;
    }
}
