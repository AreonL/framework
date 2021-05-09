<?php

// kmom01
declare(strict_types=1);

namespace App\Http\Dice;

use App\Http\{
    Dice,
    DiceHand,
    DiceGraphic
};
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

//
//running
//
/**
 * Class Game.
 */
// class Game
// {
//     public function setUp(): ResponseInterface
//     {
//         $data = [
//             "header" => "Game 21",
//             "message" => "Kör tills du får vill eller 21, över så förlorar du!",
//             "output" => $_SESSION["output"] ?? null,
//         ];
//         $_SESSION["sum"] = (int)0;
//         $_SESSION["win"] = null;
//         $_SESSION["lose"] = null;
//         $_SESSION["pScore"] = 0;
//         $_SESSION["cScore"] = 0;
//         $body = renderView("layout/dice.php", $data);
//         $psr17Factory = new Psr17Factory();
//         return $psr17Factory
//             ->createResponse(200)
//             ->withBody($psr17Factory->createStream($body));
//     }

//     public function playGame(): ResponseInterface
//     {
//         $_SESSION["dices"] = $_SESSION["dices"] ?? null;
//         $data = [
//             "dices" => $_SESSION["dices"],
//         ];
//         if (!$_SESSION["win"] and !$_SESSION["lose"]) :
//             $diceHand = new DiceHand();
//             for ($i = 0; $i < (int)$_SESSION["dices"]; $i++) {
//                 $diceHand->addDice(new DiceGraphic());
//             }
//             $diceHand->roll();
//             $data["dh"] = $diceHand->getHand();
//             $_SESSION["sum"] += (int)$diceHand->getSum();
//             // Check player sum after roll
//             $this->checkScore();
//         endif;
//         $body = renderView("layout/dice.php", $data);
//         $psr17Factory = new Psr17Factory();
//         return $psr17Factory
//             ->createResponse(200)
//             ->withBody($psr17Factory->createStream($body));
//     }


//     public function checkScore(): void
//     {
//         $sum = $_SESSION["sum"] ?? 0;
//         if ($sum == 21) {
//             $_SESSION["checkWin"] = "win";
//             $_SESSION["pScore"] += 1;
//         } elseif ($sum > 21) {
//             $_SESSION["checkLose"] = "lose";
//             $_SESSION["cScore"] += 1;
//         }
//     }

//     private bool $noWin;
//     private int $sum;
//     public function end(): ResponseInterface
//     {
//         $_SESSION["testSum"] = $_SESSION["testSum"] ?? 0;
//         $data = [
//             "dices" => $_SESSION["dices"] ?? null,
//         ];
//         $data["computerSum"] = (int)0;
//         $data["getComputer"] = "";
//         $this->noWin = true;
//         $this->sum = 0;
//         while ($this->noWin) :
//             $diceHand = new DiceHand();
//             for ($i = 0; $i < (int)$_SESSION["dices"]; $i++) {
//                 $diceHand->addDice(new DiceGraphic());
//             }
//             $diceHand->roll();
//             $data["getComputer"] .= $diceHand->getComputer();
//             $this->sum += (int)$diceHand->getSum();
//             $data["computerSum"] += (int)$diceHand->getSum();
//             if (
//                 ($this->sum == $_SESSION["sum"] or $this->sum == 21
//                 or ($this->sum > $_SESSION["sum"] and $this->sum < 21))
//                 and $_SESSION["testSum"] != -1
//             ) :
//                 $data["cWin"] = "cWin";
//                 $_SESSION["cScore"] += 1;
//                 $this->noWin = false;
//             elseif ($this->sum > 21) :
//                 $data["cLose"] = "cLose";
//                 $_SESSION["pScore"] += 1;
//                 $this->noWin = false;
//             endif;
//         endwhile;
//         $data["getComputer"] = substr($data["getComputer"], 0, -2);
//         $body = renderView("layout/dice.php", $data);
//         $psr17Factory = new Psr17Factory();
//         return $psr17Factory
//             ->createResponse(200)
//             ->withBody($psr17Factory->createStream($body));
//     }

//     public function redo(): ResponseInterface
//     {
//         $data = [
//             "header" => "Game 21",
//             "message" => "Kör tills du får vill eller 21, över så förlorar du!",
//             "output" => $_SESSION["output"] ?? null,
//         ];
//         $_SESSION["sum"] = (int)0;
//         $_SESSION["win"] = null;
//         $_SESSION["lose"] = null;
//         $_SESSION["redo"] = null;
//         $_SESSION["output"] = null;
//         $body = renderView("layout/dice.php", $data);
//         $psr17Factory = new Psr17Factory();
//         return $psr17Factory
//             ->createResponse(200)
//             ->withBody($psr17Factory->createStream($body));
//     }
// }
