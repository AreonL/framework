<?php

$session = $session ?? null;


?>

@extends('layout.layout')

@section('content')

<h1>Session hour</h1>

<p>Current session:</p>

<?php echo json_encode($session) ?>
{{-- @foreach($session as $s)
    {{ $s }}
@endforeach --}}

<form method="post" action="session/destroy">
    @csrf
    <p>
        <input type="submit" value="Destroy session">
    </p>
</form>

@endsection
