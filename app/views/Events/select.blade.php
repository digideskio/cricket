<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('select_url', url('events/select'), array('id' => 'select_url')) }}
            {{ Form::hidden('success_url', url('vendors/assigned'), array('id' => 'success_url')) }}
            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            @foreach ($events as $event)
                <br><a class="event-select" href="" data-id="{{ $event->id }}">{{ $event->description }}</a>
            @endforeach
        {{ Form::close() }}
        <br><a href="{{ url('events/new') }}">Create new event</a>
    </body>
</html>