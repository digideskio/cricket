<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('add_url', url('events/new'), array('id' => 'add_url')) }}
            {{ Form::hidden('success_url', url('vendors/assigned'), array('id' => 'success_url')) }}

            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>

            {{ Form::label('description', 'Event description') }}
            {{ Form::text('description', '') }}
            {{ Form::button('Save', array('id' => 'Save')) }}
        {{ Form::close() }}
    </body>
</html>