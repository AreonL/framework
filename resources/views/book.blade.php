<?php

$header = $header ?? null;
$results = $results ?? null;
$books = $books ?? null;

?>


@extends('layout.layout')

@section('content')

<h1>{{ $header }}</h1>

<form action="book/store" method="POST" class="pb-5">
    @csrf
    <label for="title">Title:</label>
    <div class="input-group">
        <input type="text" name="title">
        <div>{{ $errors->first('title') }}</div>
    </div>

    <label for="ISBN">ISBN:</label>
    <div class="input-group">
        <input type="text" name="ISBN">
        <div>{{ $errors->first('ISBN') }}</div>
    </div>

    <label for="author">Author:</label>
    <div class="input-group">
        <input type="text" name="author">
        <div>{{ $errors->first('author') }}</div>
    </div>

    <label for="picture">Picture:</label>
    <div class="input-group">
        <input type="text" name="picture">
        <div>{{ $errors->first('picture') }}</div>
    </div>


    <button type="submit">Add Book</button>
</form>


@foreach ($books as $book)
    <h3>{{ $book["title"] }}</h3>
    <p>ISBN: {{ $book["ISBN"] }}</p>
    <p>Author: {{ $book["author"] }}</p>
    <p>Picture: <a href={{ $book["url"] }}>{{ $book["url"] }}</a></p>
@endforeach

{{-- <p>{{ $books }}</p> --}}

<!-- If first visit -->

@endsection
