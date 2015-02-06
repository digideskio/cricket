function Events () {
    var self = this;

    this.constructor = function() {
        self.bind();
    };
    this.bind = function() {
        $('#Save').on('click', function(event) {
            self.saveClicked(event);
        });
    },
    this.saveClicked = function(event) {
        event.preventDefault();
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
        return false;
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