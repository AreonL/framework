<?php

$header = $header ?? null;


?>


@extends('layout.layout')

@section('content')

<h1>{{ $header }}</h1>

@if (empty($highscore[0]))
    <p>Highscore is empty!</p>
@endif

<ol>
@foreach ($highscore as $hs)
    {{-- [0] == name, [1] == score --}}
    <li>
        {{ $hs[0] }}: {{ $hs[1] }}
    </li>
@endforeach
</ol>
@endsection
