@extends('layout')
@section('main')
    <div id='cover'></div>
    <div class='p-5' id='login'>
        <form method='POST' style='width: 90%; max-width: 800px;' class='mx-auto'>
            <h1>Zaloguj się</h1>
            {!! $csrf !!}
            <input type='text' name='token' max='8' class='form-control' placeholder='Token'/>
            <button class='btn btn-primary my-1' style='width: 100%;'>Loguj</button>
        </form>
    </div>
@endsection