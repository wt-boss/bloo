 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";


	// loader
	var loader = function() {
		setTimeout(function() {
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

})(jQuery);

