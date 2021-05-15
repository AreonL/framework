<?php

namespace App\Http\Controllers;

use App\Models\Highscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighscoreController extends Controller
{
    public function index()
    {
        $highscore = Highscore::all();

        $arr = array();

        foreach ($highscore as $key) {
            $arr[] = array($key['name'], $key['score']);
        }

        usort($arr, function($a, $b) {
            return $b[1] <=> $a[1];
        });

        return view('highscore', [
            'header' => 'Highscore!',
            'highscore' => $arr,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
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