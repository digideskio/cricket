<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('url' => '/events/add', 'id' => 'data_form')) }}
            {{ Form::label('description', 'Event description') }}
            {{ Form::text('description', '') }}
            {{ Form::button('Save', array('id' => 'Save')) }}
        {{ Form::close() }}
    </body>
</html>