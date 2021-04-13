@extends('layout')
@section('main')
    <div id='cover'></div>
    <form method='POST' id='login' style='width: 90%; max-width: 800px;' class='mx-auto p-5'>
        <h1>Panel administratora</h1>
        {!! $csrf !!}
        {!! $form !!}
        <input type='submit' class='btn btn-primary my-1' style="width:100%"/>
    </form>
@endsection