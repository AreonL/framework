<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};
use Illuminate\Http\Request;

class YatzyController extends Controller
{
    /**
     * Display a message.
     *
     * @param  string  $message
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $request->session()->flush();
        $roll = session("roll", null);
        $firstRoll = session("firstRoll", null);
        if ($firstRoll) {
            $data = $this->firstRoll();
        } elseif ($roll) {
            $data = $this->roll();
        } else { // Setup will run if I remove this
            $data = $this->setup();
        }
        return view('yatzy', [
            'yatzy' => $data['yatzy'] ?? null,
            'session' => $request->session()->all(),
        ]);
    }

    public function game()
    {
        session(["roll" => $_POST["roll"] ?? null]);
        session(["firstRoll" => $_POST["firstRoll"] ?? null]);
        session(["end" => $_POST["end"] ?? null]);
        session(["check" => $_POST["check"] ?? null]);
        session(["selection" => $_POST["selection"] ?? null]);
        return redirect("/yatzy");
    }

    public function setup(): array
    {
        $data = [
            "yatzy" => true,
        ];
        session(["sum" => 0]);
        session(["diceHand" => new DiceHand()]);
        session(["select1" => null]);
        session(["select2" => null]);
        session(["select3" => null]);
        session(["select4" => null]);
        session(["select5" => null]);
        session(["select6" => null]);
        session(["summa" => 0]);
        session(["bonus" => null]);
        return $data;
    }
}
