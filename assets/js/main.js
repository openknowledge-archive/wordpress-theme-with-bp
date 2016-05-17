/**
 * Theme presentational javascript
 */
$(document).ready(function() {
	
	// Navigation dropdowns
	$('.nav .menu-item-has-children').on('mouseenter', function() {
		$(this).children('.sub-menu').addClass('visible');
	}).on('mouseleave', function() {
		$(this).children('.sub-menu').removeClass('visible');
	});


});