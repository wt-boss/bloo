function scroll_to_class(chosen_class) {
	var nav_height = $('nav').outerHeight();
	var scroll_to = $(chosen_class).offset().top - nav_height;

	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}

const msf_prev_step = function (callback) {
    const steppers = $('.msf-form form fieldset');
    var active_step = steppers.index('.__current__');
    active_step = active_step ? active_step : 0;

    if (callback){
        if(window[callback].call()){
            msf_go_to_step(--active_step);
        }
    }else {
        msf_go_to_step(--active_step);
    }
};

const msf_next_step = function (callback, continueWith) {
    const steppers = $('.msf-form form fieldset');
    var active_step = steppers.index('.__current__');
    active_step = (active_step || active_step == 0) ? active_step : -1;

    if (callback){
        if(window[callback].call()){
            msf_go_to_step(++active_step);
        }
    }else {
        msf_go_to_step(++active_step);
    }

    const nextStepChecked = continueWith ? window[continueWith].call() : true;

    steppers.parents('form').find('button[type=submit]').prop('disabled', active_step > 0 && !nextStepChecked);
};

const msf_go_to_step = function(idx){
    if (typeof idx != 'number') {
        return;
    }
    const steppers = $('.msf-form form fieldset');

    steppers.filter('.__current__').removeClass('__current__').hide();
    steppers.eq(idx).addClass('__current__').fadeIn('slow');

    scroll_to_class('.msf-form');
};

const msf_init_form_step = function(){
    $('.msf-form form fieldset').eq(0).addClass('__current__').fadeIn('slow');
};

jQuery(document).ready(function() {

	/*
	    Multi Step Form initialization
	*/
    msf_init_form_step();

    //Binding nav events
    $('button[data-step-nav="next"]').on('click', function () {
        msf_next_step($(this).attr("data-action"));
        // old remove by michael
        // msf_next_step($(this).attr("data-action"), $(this).attr("data-continue-with"));
    });

    $('button[data-step-nav="prev"]').on('click', function () {
        msf_prev_step($(this).attr("data-action"));
    });

});
