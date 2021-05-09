<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $output = session("output") ?? null;
        $dices = session("dices") ?? null;
        $redo = session("redo") ?? null;
        $reset = session("reset") ?? null;

        // $callable = new Game();

        if ($reset) :
            session(['reset' => null]);
            $this->setUp();
        elseif ($redo) :
            $data = $this->redo();
        elseif ($output == "end") :
            // end
            $data = $this->end();
        elseif ($dices !== null) :
            $data = $this->playGame();
        elseif ($redo == null) :
            $this->setUp();
        endif;
        return view('game', [
            'dices' => $data['dices'] ?? null,
            'computerSum' => $data['computerSum'] ?? null,
            'getComputer' => $data['getComputer'] ?? null,
            'dh' => $data['dh'] ?? null,
            'alldata' => $data ?? null,
            'output' => session('output') ?? null,
            'session' => $request->session()->all(),
        ]);
    }

    public function roll()
    {
        session(["redo" => $_POST['redo'] ?? null]);
        session(["reset" => $_POST['reset'] ?? null]);
        $content = $_POST["content"] ?? null;
        $dices = $_POST["dices"] ?? null;
        if ($content == "roll" or $content == "end") :
            session(["output" => $content ?? null]);
        endif;
        if (!session("dices") or (session("dices") !== $dices and $dices !== null)) :
            session(["dices" => $dices ?? null]);
        endif;
        return redirect("/game21");
    }

    public function setUp()
    {
        session(['sum' => 0]);
        session(['win' => null]);
        session(['lose' => null]);
        session(['pScore' => 0]);
        session(['cScore' => 0]);
        return;
    }

    public function playGame()
    {
        session(['dices' => session('dices') ?? null]);
        $data = [
            "dices" => session("dices"),
        ];
        if (!session("win") and !session("lose")) :
            $diceHand = new DiceHand();
            for ($i = 0; $i < (int)session("dices"); $i++) {
                $diceHand->addDice(new DiceGraphic());
            }
            $diceHand->roll();
            $data["dh"] = $diceHand->getHand();
            session()->increment('sum', (int)$diceHand->getSum());
            // Check player sum after roll
            $this->checkScore();
        endif;
        return $data;
    }

    public function checkScore(): void
    {
        $sum = session('sum') ?? 0;
        if ($sum == 21) {
            session(['checkWin' => 'win']);
            session()->increment('pScore', 1);
        } elseif ($sum > 21) {
            session(['checkLose' => 'lose']);
            session()->increment('cScore', 1);
        }
    }

    private bool $noWin;
    private int $sum;
    public function end()
    {
        session(["testSum" => session('testSum') ?? 0]);
        $data = [
            "dices" => session('dices') ?? null,
            'computerSum' => 0,
            'getComputer' => ""
        ];
        $this->noWin = true;
        $this->sum = 0;
        while ($this->noWin) :
            $diceHand = new DiceHand();
            for ($i = 0; $i < (int)session("dices"); $i++) {
                $diceHand->addDice(new DiceGraphic());
            }
            $diceHand->roll();
            $data["getComputer"] .= $diceHand->getComputer();
            $this->sum += (int)$diceHand->getSum();
            $data["computerSum"] += (int)$diceHand->getSum();
            if (
                ($this->sum == session("sum") or $this->sum == 21
                or ($this->sum > session("sum") and $this->sum < 21))
                and session("testSum") != -1
            ) :
                session(['cWin' => 'cWin']);
                session()->increment("cScore", 1);
                $this->noWin = false;
            elseif ($this->sum > 21) :
                session(['cLose' => 'cLose']);
                session()->increment("pScore", 1);
                $this->noWin = false;
            endif;
        endwhile;
        $data["getComputer"] = substr($data["getComputer"], 0, -2);
        return $data;
    }

    public function redo()
    {
        $data = [
            "output" => session("output") ?? null,
        ];
        session(['sum'       => 0]);
        session(['dices'     => null]);
        session(['redo'      => null]);
        session(['win'       => null]);
        session(['lose'      => null]);
        session(['output'    => null]);
        session(['checkWin'  => null]);
        session(['checkLose' => null]);
        session(['cWin'      => null]);
        session(['cLose'     => null]);
        return $data;
    }
}
