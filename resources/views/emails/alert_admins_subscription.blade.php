<p><strong>nuova pre-iscrizione:</strong><p>

@foreach($student as $key => $value)
    @if($key !== 'id')
        @if(!($valIntReFormatted = studentFieldValue($key, $value)))
            <p>{{ studentFiledReName($key) }}: {{ $value }}</p>
        @else
            <p>{{ studentFiledReName($key) }}: {{ $valIntReFormatted }}</p>
        @endif
    @endif
@endforeach
