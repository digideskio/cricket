<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/events.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
            {{ Form::hidden('items_add', url('events/vendors/items/add'), array('id' => 'items_add')) }}
            <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            <?php $count = 0; ?>
            @foreach ($vendors as $vendor)
                <?php $count++; ?>
                <br>{{ $vendor->aka }} <a class="vendor-add-item" href="" data-id="{{ $vendor->id }}">Add item</a>
            @endforeach
            <?php if ($count === 0) { echo 'No assigned vendors'; } ?>
        {{ Form::close() }}
    </body>
</html>