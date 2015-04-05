<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('assign_url', url('vendors/assign'), array('id' => 'assign_url')) }}
            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            <?php $count = 0; ?>
            @foreach ($vendors as $vendor)
                <?php $count++; ?>
                <br><a class="vendor-select" href="" data-id="{{ $vendor->id }}">{{ $vendor->aka }}</a>
            @endforeach
            <?php if ($count === 0) { echo 'No unassigned vendors'; } ?>
        {{ Form::close() }}
        <br><a href="{{ url('vendors/new') }}">Create new vendor</a>
    </body>
</html>