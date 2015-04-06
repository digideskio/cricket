<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/Items/new.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
             <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            {{ Form::hidden('add_url', url('items/new'), array('id' => 'add_url')) }}
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', '') }}
            {{ Form::label('size', 'Item size') }}
            {{ Form::radio('size', 'L', true) }} Large
            {{ Form::radio('size', 'M') }} Medium
            {{ Form::radio('size', 'S') }} Small
            {{ Form::label('price', 'Price') }}
            {{ Form::text('price', '') }}
            {{ Form::label('starting_amount', 'Starting amount') }}
            {{ Form::text('starting_amount', '') }}
            {{ Form::button('Save', array('id' => 'Save')) }}
            {{ Form::reset('Clear') }}
        {{ Form::close() }}
    </body>
</html>