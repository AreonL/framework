<?php

declare(strict_types=1);

namespace App\Http\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private int $numberDices = 0;
    private int $sum;
    private string $text;
    private int $diceNumber;
    // private array $trueDice;

    public function addDice(DiceInterface $dice)
    {
        $this->numberDices++;
        $this->dices[] = $dice;
    }

    public function roll(): void
    {
        $this->sum = 0;
        $this->text = "";
        for ($i = 0; $i < $this->numberDices; $i++) {
            $this->sum += $this->dices[$i]->roll();
            $this->text .= $this->dices[$i]->getLastRoll() . ", ";
        }
    }

    public function rollTrue($trueDice): void
    {
        // echo json_encode($trueDice);
        $this->sum = 0;
        $this->text = "";
        for ($i = 0; $i < $this->numberDices; $i++) {
            if ($trueDice[$i]) :
                $this->dices[$i]->roll();
                $this->text .= $this->dices[$i]->getLastRoll() . ", ";
            endif;
            $this->sum += $this->dices[$i]->getLastRoll();
        }
    }

    public function getHand(): string
    {
        // $res = "";
        $result = "";

        for ($i = 0; $i < $this->numberDices; $i++) {
            // $res .= $this->dices[$i]->getLastRoll() . ", ";
            $result .= $this->dices[$i]->asString() . " ";
        }
        // $res = substr($res, 0, -2);
        $result = $result . " = " . $this->sum;
        return $result;
    }

    public function getComputer(): string
    {
        return $this->text;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function getSumNumber($number): int
    {
        $this->sum = 0;
        $this->diceNumber = 0;
        for ($i = 0; $i < $this->numberDices; $i++) {
            $this->diceNumber = $this->dices[$i]->getLastRoll();
            if ($this->diceNumber == $number) :
                $this->sum += $this->diceNumber;
            endif;
        }
        return $this->sum;
    }
}
