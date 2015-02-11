<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('assign_url', url('events/vendors/assign'), array('id' => 'assign_url')) }}
            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            @foreach ($vendors as $vendor)
                <br><a class="vendor-select" href="" data-id="{{ $vendor->id }}">{{ $vendor->aka }}</a>
            @endforeach
        {{ Form::close() }}
    </body>
</html>