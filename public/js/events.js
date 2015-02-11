function Events () {
    var Base;
    var self = this;

    this.constructor = function(base) {
        Base = base;
        self.bindSave();
        self.bindEventSelectAnchors();
        self.bindVendorAssignAnchors();
    },
    this.bindSave = function() {
        $('#Save').on('click', function(event) {
            event.preventDefault();
            Base.call(
                $('#add_url').val(),
                $('#data_form').serialize(),
                function() { window.location = $('#success_url').val() },
                function() { alert('nay') }
            );
            return false;
        });
    },
    this.bindEventSelectAnchors = function() {
        $('a.event-select').on('click', function(event) {
            event.preventDefault();
            anchor = event.currentTarget;
            Base.call(
                $('#select_url').val(),
                'event_id=' + $(anchor).data('id'),
                function() { window.location = $('#success_url').val() },
                function(msg) { Base.showFailMessage(msg); }
            );
            return false;
        });
    },
    this.bindVendorAssignAnchors = function() {
        $('a.vendor-select').on('click', function(event) {
            event.preventDefault();
            anchor = event.currentTarget;
            Base.call(
                $('#assign_url').val(),
                'vendor_id=' + $(anchor).data('id'),
                function() { Base.showSuccessMessage('Vendor assigned'); },
                function(msg) { Base.showFailMessage(msg); }
            );
            return false;
        });
    }
}

$(document).ready( function() {
    event = new Events();
    event.constructor(new Base());
})