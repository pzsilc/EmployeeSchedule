@extends('layout')
@section('main')
<div class='pt-5'>
    <h3>Jesteś zalogowany jako: <b>{{ $admin['name'] }}</b></h3>
    <section class='mt-5'>
        <h4 class='ml-2'>Pracownicy:</h4>
        <div class='container'>
            <div class='row'>
                @foreach($people as $key => $person)
                    <a class='s-list col-12 col-md-5' href="{{ $app_path }}/admin/employees?id={{ $person['id'] }}">{{ $key + 1 }}. {{ $person['last_name'] }} {{ $person['first_name'] }}</a>
                    <br/>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection