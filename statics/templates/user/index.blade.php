@extends('layout')
@section('main')
    <div class='pt-5'>
        <section class='col-6 border rounded p-4'>
            <h3>Imię i nazwisko: <b>{{ $user['fname'] }} {{ $user['lname'] }}</b></h3>
            <p>Stanowisko: <b>{{ $user['statement'] ? $user['statement'] : "BRAK" }}</b></p>
            <p>Dział: <b>{{ $user['section'] }}</b></p>
            <p>Bezpośredni przełożony: <b>{{ $user['manager'] ? $user['manager'] : "BRAK" }}</b></p>
        </section>
        @if($employees)
            <section class='my-5 py-5'>
                <h5 class='mb-3'>Twoi pracownicy:<h5>
                <div class='container'>
                    <div class='row'>
                        @foreach($employees as $emp)
                            <a class='col-6 manager-emp-list-sample' href="{{ $app_path }}/employees/view?id={{ $emp['id'] }}">{{ $emp['first_name'] }} {{ $emp['last_name'] }}</a><br/>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <section class='mt-5 pt-5'>
            <h4 class='text-center'>Harmonogram wdrożeń</h4>
            <br/>
            @if($events)
                <table class='table table'>
                    <tr>
                        <th>Lp.</th>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Temat</th>
                        <th>Osoba prowadząca</th>
                    </tr>
                    @foreach($events as $key => $event)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $event->get_date() }}</td>
                            <td>{{ $event->get_time() }}</td>
                            <td>{{ $event->subject }}</td>
                            <td>{{ $event->get_leader() }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h5 class='mt-5 text-center'>Brak wydarzeń</h5>
            @endif
        </section>    
    </div>
@endsection