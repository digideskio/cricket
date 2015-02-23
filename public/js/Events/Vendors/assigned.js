function Assigned () {
    var Base;
    var self = this;

    this.constructor = function(base) {
        Base = base;
    }
}

$(document).ready( function() {
    assigned = new Assigned();
    assigned.constructor(new Base());
})