<?php

$header = "Game 21";
$action = $action ?? url("/game21/roll");
$message = $message ?? null;
$dices = session('dices') ?? null;
$diceHand = $diceHand ?? null;
$output = $output ?? null;
$gh = $gh ?? null;
$graphic = $graphic ?? null;

$end = session("output") ?? null;

$pScore = session("pScore") ?? null;
$cScore = session("cScore") ?? null;
$getComputer = $getComputer ?? null;
$computerSum = $computerSum ?? null;

$cWin = session("cWin") ?? null;
$cLose = session("cLose") ?? null;
$lose = session("checkLose") ?? null;
$win = session("checkWin") ?? null;
?>

@extends('layout.layout')

@section('content')

<h1>{{ $header }}</h1>

{{-- @foreach ($alldata as $data)
<p>{{$data}}</p>
@endforeach --}}

@if ($win or $cLose)
    <!-- Winning -->
    <h2>You won!</h2>
    <p>You got: {{ session('sum') }}</p>
    @if ($cLose)
        <p>Computer got: {{ $getComputer }} = {{ $computerSum }}</p>
    @endif
    <form method="post" action="{{ $action }}">
        @csrf
        <p>
            <input type="hidden" name="redo" value="redo">
            <input type="submit" value="Continue">
        </p>
    </form>
@elseif ($lose or $cWin)
    <!-- Losing -->
    <h2>You lost</h2>
    <p>You got: {{ session('sum') }}</p>
    @if ($cWin)
        <p>Computer got: {{ $getComputer }} = {{ $computerSum }}</p>
    @endif
    <form method="post" action="{{ $action }}">
        @csrf
        <p>
            <input type="hidden" name="redo" value="redo">
            <input type="submit" value="Continue">
        </p>
    </form>
@elseif (!$dices)
    <!-- Setup / New pick of dices -->
    <p>Kör tills du vill eller får 21, över så förlorar du!</p>

    <form method="post" action="{{ $action }}">
        @csrf
        <p>Hur många täningar?</p>
        <p>
            <input type="radio" id="1" name="dices" value="1" checked>
            <label for="1">1</label>
        </p>
        <p>
            <input type="radio" id="2" name="dices" value="2">
            <label for="2">2</label>
        </p>
        <p>
            <input type="submit" value="Play">
        </p>
    </form>

    @if ($pScore or $cScore > 0)
        <p>Player score: {{ $pScore }}</p>
        <p>Computer score: {{ $cScore }}</p>
        <p>Reset score?</p>
        <form method="post" action="{{ $action }}">
            @csrf
            <p>
                <input type="hidden" name="reset" value="reset">
                <input type="submit" value="Reset">
            </p>
        </form>
    @endif

@elseif ($end !== "end")
    <!-- Playgame -->
    <p>Tärningar: {{ $dices }}</p>
    <p>{{ $dh }}</p>
    <p>Player summa: {{ session('sum') }}</p>
    <form method="post" action="{{ $action }}">
        @csrf
        <p>Continue?</p>
        <p>
            <input type="radio" id="roll" name="content" value="roll" checked>
            <label for="roll">Roll!</label>
        </p>
        <p>
            <input type="radio" id="end" name="content" value="end">
            <label for="end">Stop</label>
        </p>
        <p>
            <input type="submit" value="Submit">
        </p>
    </form>
@else
    <!-- End turn -->
    <p>End turn</p>
@endif
{{-- end of page --}}
@endsection
