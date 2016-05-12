( function( $ ) {
	$( document ).ready(function() {
		$('#cssmenu li.has-sub>a').on('click', function(){
			$(this).removeAttr('href');
			var element = $(this).parent('li');
			if (element.hasClass('open')) {
				element.removeClass('open');
				element.find('li').removeClass('open');
				element.find('ul').slideUp();
			}
			else {
				element.addClass('open');
				element.children('ul').slideDown();
				element.siblings('li').children('ul').slideUp();
				element.siblings('li').removeClass('open');
				element.siblings('li').find('li').removeClass('open');
				element.siblings('li').find('ul').slideUp();
			}
		});
	});
} )( jQuery );
(function(){
	var bodyEl = $('body'),
		navToggleBtn = bodyEl.find('.nav-toggle-btn');

	navToggleBtn.on('click', function(e){
		bodyEl.toggleClass('#cssmenu:active');
		e.preventDefault();
	});
})(jQuery);