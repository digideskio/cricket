<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/Vendors/assigned.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            <?php $count = 0; ?>
            @foreach ($vendors as $vendor)
                <?php $count++; ?>
                <br>{{ $vendor->aka }} <a class="vendor-add-item" href="{{ url('events/vendors/items/add') }}/{{ $vendor->id }}">Add item</a>
            @endforeach
            <?php if ($count === 0) { echo 'No assigned vendors'; } ?>
        {{ Form::close() }}
    </body>
</html>