<?php

declare(strict_types=1);

namespace App\Http\Dice;

// use function AreonL\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class Dice.
 */
class Dice implements DiceInterface, HistogramInterface
{
    use HistogramTrait;

    private int $faces;
    private ?int $lastRoll = null; // funkar utan '?int'

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        $this->lastRoll = rand(1, $this->faces);
        $this->addToHistogram($this->lastRoll);

        return $this->lastRoll;
    }

    public function getLastRoll(): int
    {
        return $this->lastRoll;
    }

    public function asString(): string
    {
        return (string) $this->lastRoll;
    }
}
