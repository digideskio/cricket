function Events () {
    var self = this;

    this.constructor = function() {
        self.bind();
    };
    this.bind = function() {
        $('#Save').on('click', function(event) {
            event.preventDefault();
            self.saveClicked(event);
            return false;
        });
    },
    this.saveClicked = function(event) {
        $.ajax({
            type: 'POST',
            url: $('#data_form').attr('action'),
            data: $('#data_form').serialize(),
            success: function (data) {
                if (data.success == 'yes') {
                    self.saveSuccess();
                } else {
                    self.saveError();
                }
            }
        });
    },
    this.saveSuccess = function() {
        window.location = '../';
    },
    this.saveError = function() {
        alert('nay');
    }
}

$(document).ready( function() {
    event = new Events();
    event.constructor();
})