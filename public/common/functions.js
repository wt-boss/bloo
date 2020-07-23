const is_valid_email = function(input){
    return (typeof(input) == 'string') && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(input);
};

const is_null_or_whithe_space = function(input) {
    return !input || !(typeof(input) == 'string') || input.replace(/\s/g, '').length < 1;
};

const date_part_only = function () {
    var d = new Date(this);
    d.setHours(0, 0, 0, 0);
    return d;
};




Date.prototype.datePart = date_part_only;

