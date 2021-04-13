@extends('layout')
@section('main')
    <div class='mx-auto' style='width: 90%; max-width: 800px; margin-top: 150px;'>
        <a href='{{ $app_path }}/'><i class='fa fa-arrow-left mb-5 back-arrow'></i></a>
        <div class='border rounded p-5 mb-5'>
            <h3>Imię i nazwisko: <b>{{ $employee['fn'] }} {{ $employee['ln'] }}</b></h3>
            <p>Stanowisko: <b>{{ $employee['statement'] }}</b></p>
            <p>Dział: <b>{{ $employee['section'] }}</b></p>
            <p>Bezpośredni przełożony: <b>{{ $employee['manager'] }}</b></p>
        </div>
        <h4>Harmonogram wdrożeń</h4>
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
            <h5 class='text-center mt-5'>Brak wydarzeń</h5>
        @endif
    </div>
@endsection