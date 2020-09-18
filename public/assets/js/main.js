 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
            BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
            iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
            Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
            Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
            any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    $(window).stellar({
        responsive: true,
        parallaxBackgrounds: true,
        parallaxElements: true,
        horizontalScrolling: false,
        hideDistantElements: false,
        scrollProperty: 'scroll'
    });

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

