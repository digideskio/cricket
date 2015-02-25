<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/vendors.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
             <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            {{ Form::hidden('add_url', url('vendors/new'), array('id' => 'add_url')) }}
            {{ Form::label('aka', 'Vendor AKA') }}
            {{ Form::text('aka', '') }}
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '') }}
            {{ Form::label('surname', 'Surname') }}
            {{ Form::text('surname', '') }}
            {{ Form::label('id_number', 'ID Number') }}
            {{ Form::text('id_number', '') }}
            {{ Form::button('Save', array('id' => 'Save')) }}
            {{ Form::reset('Clear') }}
        {{ Form::close() }}
    </body>
</html>