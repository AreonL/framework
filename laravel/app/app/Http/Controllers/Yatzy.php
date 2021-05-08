<?php

declare(strict_types=1);

namespace Mos\Controller;

use Psr\Http\Message\ResponseInterface;
use AreonL\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the yatzy routes.
 */
class Yatzy
{
    use ControllerTrait;

    // public $diceHand;

    public function index(): ResponseInterface
    {
        $roll = $_SESSION["roll"] ?? null;
        $firstRoll = $_SESSION["firstRoll"] ?? null;
        if ($firstRoll) {
            $data = $this->firstRoll();
        } elseif ($roll) {
            $data = $this->roll();
        } else { // Setup will run if I remove this
            $data = $this->setup();
        }
        $body = renderView("layout/yatzy.php", $data);
        return $this->response($body);
    }

    public function checkAllBoxes(): bool
    {
        $select1 = $_SESSION["select1"] ?? null;
        $select2 = $_SESSION["select2"] ?? null;
        $select3 = $_SESSION["select3"] ?? null;
        $select4 = $_SESSION["select4"] ?? null;
        $select5 = $_SESSION["select5"] ?? null;
        $select6 = $_SESSION["select6"] ?? null;
        if (
            !is_null($select1) &&
            !is_null($select2) &&
            !is_null($select3) &&
            !is_null($select4) &&
            !is_null($select5) &&
            !is_null($select6)
        ) {
            return true;
        }
        return false;
    }

    public function game(): ResponseInterface
    {
        $_SESSION["roll"] = $_POST["roll"] ?? null;
        $_SESSION["firstRoll"] = $_POST["firstRoll"] ?? null;
        $_SESSION["end"] = $_POST["end"] ?? null;
        $_SESSION["check"] = $_POST["check"] ?? null;
        $_SESSION["selection"] = $_POST["selection"] ?? null;
        return $this->redirect(url("/yatzy"));
    }

    public function setup(): array
    {
        $data = [
            "yatzy" => true,
            "message" => "This is a simple game of Yatzy",
        ];
        $_SESSION["sum"] = 0;
        $_SESSION["diceHand"] = new DiceHand();
        $_SESSION["select1"] = null;
        $_SESSION["select2"] = null;
        $_SESSION["select3"] = null;
        $_SESSION["select4"] = null;
        $_SESSION["select5"] = null;
        $_SESSION["select6"] = null;
        $_SESSION["summa"] = 0;
        $_SESSION["bonus"] = null;
        return $data;
    }

    public function firstRoll(): array
    {
        // Checking so Session has everything needed
        $_SESSION["diceHand"] = $_SESSION["diceHand"] ?? new DiceHand();
        $_SESSION["summa"] = $_SESSION["summa"] ?? 0;
        $data = [
            "roll" => true,
        ];
        // $this->diceHand = new DiceHand();
        // Get 5 dices, roll and put into dh (dicehand) variable
        for ($i = 0; $i < 5; $i++) {
            $_SESSION["diceHand"]->addDice(new DiceGraphic());
        }
        $_SESSION["diceHand"]->roll();
        $data["dh"] = $_SESSION["diceHand"]->getHand();

        // Save roll counter to session
        $_SESSION["rollCounter"] = 1;
        return $data;
    }

    public function roll(): array
    {
        // Checking so Session has everything needed
        $_SESSION["diceHand"] = $_SESSION["diceHand"] ?? new DiceHand();
        $_SESSION["summa"] = $_SESSION["summa"] ?? 0;
        $_SESSION["sum"] = $_SESSION["sum"] ?? 0;
        $_SESSION["check"] = $_SESSION["check"] ?? null;
        $_SESSION["rollCounter"] = $_SESSION["rollCounter"] ?? 1;

        // Set roll to true for view
        $data = [
            "roll" => true,
        ];

        // Check if selected
        $this->selection();

        // Check if bonus
        $this->bonus();

        // Checkbox array to see what needs to be rolled
        $trueRoll = $this->trueRoll();
        if (in_array(true, $trueRoll)) {
            $_SESSION["diceHand"]->rollTrue($trueRoll);
        }
        $data["dh"] = $_SESSION["diceHand"]->getHand();
        $_SESSION["sum"] += (int)$_SESSION["diceHand"]->getSum();

        // add player rolls
        $_SESSION["rollCounter"] += 1;
        $data["summa"] = $_SESSION["summa"];
        return $data;
    }

    public function trueRoll(): array
    {
        $trueRoll = [false, false, false, false, false];
        $check = $_SESSION["check"];
        if ($check) {
            $len = sizeof($check);
            for ($i = 0; $i < $len; $i++) {
                $trueRoll[$check[$i]] = true;
            }
        }

        return $trueRoll;
    }

    public function selection(): void
    {
        // Add session if not exsists
        $_SESSION["summa"] = $_SESSION["summa"] ?? 0;
        $_SESSION["diceHand"] = $_SESSION["diceHand"] ?? new DiceHand();

        $selection = $_SESSION["selection"][0] ?? null;
        $sumNumber = $_SESSION["diceHand"]->getSumNumber((int)$selection) ?? 0;
        if ($selection == "1") {
            $_SESSION["select1"] = $sumNumber;
        }
        if ($selection == "2") {
            $_SESSION["select2"] = $sumNumber;
        }
        if ($selection == "3") {
            $_SESSION["select3"] = $sumNumber;
        }
        if ($selection == "4") {
            $_SESSION["select4"] = $sumNumber;
        }
        if ($selection == "5") {
            $_SESSION["select5"] = $sumNumber;
        }
        if ($selection == "6") {
            $_SESSION["select6"] = $sumNumber;
        }
        if ($selection) {
            $_SESSION["rollCounter"] = 0;
            $_SESSION["check"] = ["0", "1", "2", "3", "4"];
            $_SESSION["summa"] += $sumNumber;
            $_SESSION["end"] = $this->checkAllBoxes();
        }
    }

    public function bonus(): void
    {
        $summa = $_SESSION["summa"];
        if ($summa >= 63) {
            $_SESSION["bonus"] = 50;
        }
    }
}
