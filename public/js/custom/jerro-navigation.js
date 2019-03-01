$(document).ready(function() {

	$('#main-menu > li:has(ul.sub-menu)').addClass('parent');
	$('ul.sub-menu > li:has(ul.sub-menu) > a').addClass('parent');

	$('#menu-toggle').click(function() {
		$('#main-menu').animate({
				height: "toggle"
			}, {
				duration: 1000,
				specialEasing: {
				width: "easeInOutCubic",
				height: "easeInOutCubic"
			}

	});
		return false;
	});

$(window).resize(function() {
		if ($(window).width() > 750) {
			$('#main-menu').removeAttr('style');
		}
	});

});