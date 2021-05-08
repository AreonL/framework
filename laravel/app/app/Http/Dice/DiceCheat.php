<?php

declare(strict_types=1);

namespace App\Http\Dice;

/**
 * Class DiceCheat.
 */
class DiceCheat implements DiceInterface
{
    public function roll(): int
    {
        return 6;
    }
    public function getLastRoll(): ?int
    {
        return 6;
    }
    public function asString(): string
    {
        return "6 (cheating)";
    }
}
