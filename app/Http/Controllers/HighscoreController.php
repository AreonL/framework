<?php

namespace App\Http\Controllers;

use App\Models\Highscore;

class HighscoreController extends Controller
{
    public function index()
    {
        $highscore = Highscore::all();

        $arr = array();

        foreach ($highscore as $key) {
            $arr[] = array($key['name'], $key['score']);
        }

        usort($arr, function ($number1, $number2) {
            return $number2[1] <=> $number1[1];
        });

        return view('highscore', [
            'header' => 'Highscore!',
            'highscore' => $arr,
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);


        $highscore = new Highscore();
        $highscore->name = request('name');
        $highscore->score = request('score');
        $highscore->save();

        session()->flush();

        return redirect("/yatzy");
    }
}
