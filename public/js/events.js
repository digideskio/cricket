function Events () {
    var Base;
    var self = this;

    this.constructor = function(base) {
        Base = base;
        self.bindSave();
        self.bindAnchors();
    },
    this.bindSave = function() {
        $('#Save').on('click', function(event) {
            event.preventDefault();
            Base.saveClicked(
                function() { window.location = '../' },
                function() { alert('nay') }
            );
            return false;
        });
    },
    this.bindAnchors = function() {
        $('a.event-select').on('click', function(event) {
            event.preventDefault();
            anchor = event.currentTarget;
            //console.log($('#target_url').val()); return false;
            Base.ajax(
                $('#target_url').val(),
                'event_id=' + $(anchor).data('id'),
                function() { window.location = '../' },
                function() { alert('nay') }
            );
            return false;
        });
    }
}

$(document).ready( function() {
    event = new Events();
    event.constructor(new Base());
})