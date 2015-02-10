<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('target_url', url('events/select'), array('id' => 'target_url')) }}
            @foreach ($events as $event)
                <a class="event-select" href="" data-id="{{ $event->id }}">{{ $event->description }}</a>
            @endforeach
        {{ Form::close() }}
    </body>
</html>