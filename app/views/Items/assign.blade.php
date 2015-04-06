<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ url('js/base.js') }}"></script>
        <script src="{{ url('js/Items/assign.js') }}"></script>
    </head>
    <body>
        {{ Form::open(array('id' => 'data_form')) }}
             <p style="<?php echo empty($message) === true ? 'display:none' : ''; ?>" id="feedback">{{ $message or '' }}</p>
            {{ Form::hidden('save_url', url('items/assign/' . $vendor_id), array('id' => 'save_url')) }}
            @foreach ($items as $item)
                {{ Form::hidden('item_ids[]', $item->id, array('id' => 'item_ids[]')) }}
                {{ $item->description }}
                ({{ $item->size }})
                {{ Form::label('item_count_' . $item->id, 'Amount') }}
                {{ Form::text('item_count_' . $item->id, $item->starting_amount) }}
            @endforeach
            {{ Form::button('Save', array('id' => 'Save')) }}
            {{ Form::reset('Clear') }}
        {{ Form::close() }}
    </body>
</html>