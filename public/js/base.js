function Base () {
    this.call = function(target, data, success, fail) {
        $.ajax({
            type: 'POST',
            url: target,
            data: data,
            success: function (returned) {
                if (returned.success == 'yes') {
                    return success();
                } else {
                    msg = returned.message == undefined ? '' : returned.message;
                    return fail(msg);
                }
            }
        });
    },
    this.showSuccessMessage = function (text) {
        $('#feedback').text(text);
        $('#feedback').show();
        setTimeout(function() {
            $('#feedback').hide();
        }, 5000);
    },
    this.showFailMessage = function (text) {
        $('#feedback').text(text);
        $('#feedback').show();
        setTimeout(function() {
            $('#feedback').hide();
        }, 5000);
    }
}