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
 * Class DiceGraphic.
 */
class DiceGraphic extends Dice
{
    private const FACES = 6;
    private array $graphic = [
        1 => "⚀",
        2 => "⚁",
        3 => "⚂",
        4 => "⚃",
        5 => "⚄",
        6 => "⚅",
    ];

    public function __construct()
    {
        parent::__construct(self::FACES);
    }

    public function graphic(): string
    {
        return $this->graphic[$this->getLastRoll()];
    }

    public function asString(): string
    {
        return $this->graphic[$this->getLastRoll()];
    }
}
