function Vendors () {
    var Base;
    var self = this;

    this.constructor = function (base) {
        Base = base;
        self.bind();
    },
    this.bind = function () {
        $('#Save').on('click', function (event) {
            event.preventDefault();
            Base.call(
                $('#add_url').val(),
                $('#data_form').serialize(),
                function() { Base.showSuccessMessage('Vendor saved'); },
                function(msg) { Base.showFailMessage(msg); }
            );
            return false;
        });
    }
}

$(document).ready( function() {
    vendor = new Vendors();
    vendor.constructor(new Base());
})