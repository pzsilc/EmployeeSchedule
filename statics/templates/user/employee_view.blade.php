@extends('layout')
@section('main')
<div class='pt-5'>
    <section>
        <a href='{{ $app_path }}/'><i class='fa fa-arrow-left back-arrow mb-5'></i></a>
        <div>
            <h4>Imię i nazwisko: <b>{{ $employee['first_name'] }} {{ $employee['last_name'] }}</b></h4>
            @if(!$employee['statement'])
                <form method="POST" action="{{ $app_path }}/employees/statements/set?id={{ $employee['id'] }}">
                    {!! $csrf !!}
                    <div class="input-group mb-3">
                        <h5 style="margin-top: 3px;">Stanowisko:</h5>
                        <input 
                            type="text" 
                            name="statement"
                            class="form-control ml-2" 
                            required 
                            placeholder="Uzupełnij" 
                            aria-label="Recipient's username" 
                            aria-describedby="basic-addon2"
                        >
                        <div class="input-group-append">
                            <input type='submit' class='btn btn-dark'/>
                        </div>
                    </div>
                </form>
            @else
                <h5>Stanowisko: <b>{{ $employee['statement'] }}</b></h5>
            @endif
            <h5>Dział: <b>{{ $employee['section'] }}</b></h5>
            <h5>Bezpośredni przełożony: <b>Ty</b></h5>
        </div>
    </section>
    <section class='mt-5 pt-5'>
        <h4 class='text-center'>Harmonogram wdrożenia</h4>
        @if($events)
            <table class='table table'>
                <tr>
                    <th>Data</th>
                    <th>Godzina</th>
                    <th>Temat</th>
                    <th>Osoba prowadząca</th>
                    <th></th>
                </tr>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->get_date() }}</td>
                        <td>{{ $event->get_time() }}</td>
                        <td>{{ $event->subject }}</td>
                        <td>{{ $event->get_leader() }}</td>
                        <td>
                            <form method="POST" action="{{ $app_path }}/employees/view/events/delete?employee_id={{ $employee['id'] }}&event_id={{ $event->id }}">
                                {!! $csrf !!}
                                <button type='submit' class='btn btn-danger'>Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h5 class='mt-5 text-center'>Brak wydarzeń</h5>
        @endif
        <form 
            method='POST' 
            action="{{ $app_path }}/employees/view/events/add?employee_id={{ $employee['id'] }}"
            class='mt-5 pt-5 mx-auto'
            style='width: 90%; max-width: 600px;'
        >
            {!! $csrf !!}
            <h5>Dodaj wydarzenie</h5>
            <label for="subject">Temat</label>
            <input id='subject' type='text' name='subject' class='form-control' required/>
            <label for="leader_id">Prowadzący</label>
            <select id='leader_id' name='leader_id' class='form-control mt-1' required>
                @foreach($all_employees as $e)
                    <option value="{{ $e['id'] }}">{{ $e['first_name'] }} {{ $e['last_name'] }}</otpion>
                @endforeach
            </select>
            <label for="datetime">Data i godzina</label>
            <input id='datetime' type='datetime-local' name='datetime' class='form-control mt-1' required/>
            <input type='submit' class='btn btn-dark mt-2' style='width: 100%;'/>
        </form>
    </section>
</div>
@endsection