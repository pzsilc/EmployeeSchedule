@foreach($messages as $message)
    @if($message['type'] == 'success')
        <div class="btn btn-success mess">{{ $message['text'] }}</div>
    @elseif($message['type'] == 'error') 
        <div class="btn btn-danger mess">{{ $message['text'] }}</div>
    @elseif($message['type'] == 'info')
        <div class="btn btn-info mess">{{ $message['text'] }}</div>
    @endif
@endforeach