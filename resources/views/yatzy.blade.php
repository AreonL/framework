<?php

$header = "Yatzy";
$message = "A game of Yatzy";
$end = $session["end"] ?? null;
$action = $action ?? url("/yatzy/game");
$yatzy = $yatzy ?? null;
$dh = $dh ?? null;
$roll = $roll ?? null;
$select1 = $session["select1"] ?? null;
$select2 = $session["select2"] ?? null;
$select3 = $session["select3"] ?? null;
$select4 = $session["select4"] ?? null;
$select5 = $session["select5"] ?? null;
$select6 = $session["select6"] ?? null;
$summa = $session["summa"] ?? 0;
$bonus = $session["bonus"] ?? 0;

?>

@extends('layout.layout')

@section('content')

<h1>{{ $header }}</h1>

<!-- If first visit -->
@if($end)
    <p>The end</p>
    <p>Total sum: {{ $bonus + $summa }}</p>
    <form method="post" action="highscore/store">
        @csrf
        <p>
            <label for="name">Namn:</label>
        </p>
        <p>
            <input type="text" name="name">
            <div>{{ $errors->first('name') }}</div>
        </p>
        <p>
            <input type="hidden" name="score" value={{ $bonus + $summa }}>
            <input type="submit" value="Submit score!">
        </p>        
    </form>
@elseif($yatzy)
    <p>{{ $message }}</p>
    <form method="post" action="{{ $action }}">
        @csrf
        <p>
            <input type="hidden" name="firstRoll" value="firstRoll">
            <input type="submit" value="Play">
        </p>
    </form>
<!-- If pressed play -->
@elseif ($roll)
    <p class="dices">{{ $dh }}</p>
    <form method="post" action="{{ $action }}">
        @csrf
        <p>
            <input type="hidden" name="roll" value="roll">
            @if ($session["rollCounter"] < 3)
            <input class="checkbox" type="checkbox" name="check[]" value="0" checked="checked">
            <input class="checkbox" type="checkbox" name="check[]" value="1" checked="checked">
            <input class="checkbox" type="checkbox" name="check[]" value="2" checked="checked">
            <input class="checkbox" type="checkbox" name="check[]" value="3" checked="checked">
            <input class="checkbox" type="checkbox" name="check[]" value="4" checked="checked">
            <br>
            <br>
            <input type="submit" value="Roll selected">
            <br>
            @endif
            <p>
                <label>1:or</label>
                @if (is_null($select1))
                <input type="checkbox" name="selection[]" value="1">
                @else
                    = {{ $select1 }}
                @endif
            </p>
            <p>
                <label>2:or</label>
                @if (is_null($select2))
                <input type="checkbox" name="selection[]" value="2">
                @else
                    = {{ $select2 }}
                @endif
            </p>
            <p>
                <label>3:or</label>
                @if (is_null($select3))
                <input type="checkbox" name="selection[]" value="3">
                @else
                    = {{ $select3 }}
                @endif
            </p>
            <p>
            <label>4:or</label>
                @if (is_null($select4))
                <input type="checkbox" name="selection[]" value="4">
                @else
                    = {{ $select4 }}
                @endif
            </p>
            <p>
            <label>5:or</label>
                @if (is_null($select5))
                <input type="checkbox" name="selection[]" value="5">
                @else
                    = {{ $select5 }}
                @endif
            </p>
            <p>
            <label>6:or</label>
                @if (is_null($select6))
                <input type="checkbox" name="selection[]" value="6">
                @else
                    = {{ $select6 }}
                @endif
            </p>
            <p>Summa: {{ $summa }}</p>
            <p>Bonus: {{ $bonus }}</p>
            <p>Total: {{ $bonus + $summa }}</p>
            <input type="submit" value="Select">
        </p>
    </form>
@endif

{{-- end of page --}}
@endsection
