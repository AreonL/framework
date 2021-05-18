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
    public function index()
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
            'dh' => $data['dh'] ?? null,
            'roll' => $data['roll'] ?? null,
            'yatzy' => $data['yatzy'] ?? null,
            'session' => session()->all(),
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

    public function firstRoll(): array
    {
        // Checking so Session has everything needed
        session(['diceHand' => session('diceHand') ?? new DiceHand()]);
        session(['summa' => session('summa') ?? 0]);
        $data = [
            "roll" => true,
        ];
        // $this->diceHand = new DiceHand();
        // Get 5 dices, roll and put into dh (dicehand) variable
        for ($i = 0; $i < 5; $i++) {
            session("diceHand")->addDice(new DiceGraphic());
        }
        session("diceHand")->roll();
        $data["dh"] = session("diceHand")->getHand();

        // Save roll counter to session
        session(["rollCounter" => 1]);
        return $data;
    }

    public function roll(): array
    {
        // Checking so Session has everything needed
        session(['diceHand' => session('diceHand') ?? new DiceHand()]);
        session(['summa' => session('summa') ?? 0]);
        session(['sum' => session('sum') ?? 0]);
        session(['check' => session('check') ?? null]);
        session(['rollCounter' => session('rollCounter') ?? 1]);

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
            session("diceHand")->rollTrue($trueRoll);
        }
        $data["dh"] = session("diceHand")->getHand();
        session()->increment("sum", (int)session("diceHand")->getSum());

        // add player rolls
        session()->increment("rollCounter", 1);
        $data["summa"] = session("summa");
        return $data;
    }

    public function trueRoll(): array
    {
        $trueRoll = [false, false, false, false, false];
        $check = session("check");
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
        session(['summa' => session('summa') ?? 0]);
        session(['diceHand' => session('diceHand') ?? new DiceHand()]);

        $selection = session('selection')[0] ?? null;
        $sumNumber = session('diceHand')->getSumNumber((int)$selection) ?? 0;

        if ($selection) {
            session([('select' . $selection) => $sumNumber]);
            session(['rollCounter' => 0]);
            session(['check' => ["0", "1", "2", "3", "4"]]);
            session()->increment('summa', $sumNumber);
            session(['end' => $this->checkAllBoxes()]);
            session(['selection' => null]);
        }
    }

    public function bonus(): void
    {
        $summa = session('summa');
        if ($summa >= 63) {
            session(['bonus' => 50]);
        }
    }

    public function checkAllBoxes(): bool
    {
        $select = array();
        $select[] = session('select1') ?? null;
        $select[] = session('select2') ?? null;
        $select[] = session('select3') ?? null;
        $select[] = session('select4') ?? null;
        $select[] = session('select5') ?? null;
        $select[] = session('select6') ?? null;

        $count = 0;

        foreach ($select as $key) {
            if ($key != null) {
                $count += 1;
            }
        }

        if ($count == 6) {
            return true;
        }
        return false;
    }
}
