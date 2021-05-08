<?php

declare(strict_types=1);

namespace App\Http\Dice;

/**
 * Class HistogramTrait.
 */
trait HistogramTrait
{
    protected array $histogramValues = [];

    protected function addToHistogram(int $value): void
    {
        $this->histogramValues[] = $value;
    }

    public function printHistogram(): string
    {
        // print the histogram from the
        // $this->histogramValues[]
        return "Yes";
    }
}
