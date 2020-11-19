/**
 * @author Gary Hussey
 * @details an Expansion of Stéphane Roucheray's script
 * @extends jquery
 */

(function($){

	$.fn.icarousel = function(options){
		var settings = {
			'prev':'.prev',
			'next':'.next',
			'slides':'.slides',
			'port':'.port',
			'selector':this.selector,
			'interval':5000
		};
		$.extend(settings,options);

		var carousel = $(this);
		var slides = $(this).find('.slides');
		var port = $(this).find('.port');

		// set some required style
		port.css({'overflow':'hidden'});
		slides.css({'position':'relative','overflow':'hidden'});

		if (slides.length > 0) {

			var increment = function(){return $(slides).children().first().outerWidth(true)},
					elmnts = $(slides).children(),
					numElmts = elmnts.length,
					sizeFirstElmnt = function(){return increment()},
					shownInViewport = function(){return Math.round(port.width() / sizeFirstElmnt())},
					firstElementOnViewPort = 1;


			$(slides).css('width',((numElmts*increment())*2) + "px");
			elmnts.clone().appendTo(slides).each(function(index,el){
				$(el).addClass('clone');
			});


			$(window).resize(function(){
				(port.width() > increment()*numElmts) ? slides.find('.clone').hide() : slides.find('.clone').show();
				$(slides).css('width',((numElmts*increment())*2) + "px");
			});


			$(this).find(settings.prev).click(function(e){
				e.preventDefault();
				if (!carousel.data('isAnimating')) {
					if (firstElementOnViewPort == 1) {
						$(slides).css('left', "-" + ((numElmts * sizeFirstElmnt()))+"px");
						firstElementOnViewPort = numElmts;
					}else {
						firstElementOnViewPort--;
					}

					$(slides).animate({
						left: "+=" + increment(),
						y: 0,
						queue: true
					}, "swing", function(){
						carousel.trigger('slid');
						carousel.data('isAnimating',false);
						carousel.delay()
					});
					carousel.trigger('slide');
					carousel.data('isAnimating',true);
				}

			});

			$(this).find(settings.next).click(function(e){
				e.preventDefault();
				if (!carousel.data('isAnimating')) {
					if (firstElementOnViewPort > numElmts) {
						firstElementOnViewPort = 2;
						$(slides).css('left', "0px");
					}
					else {
						firstElementOnViewPort++;
					}

					$(slides).animate({
						left: "-=" + increment(),
						y: 0,
						queue: true
					}, "swing", function(){
						carousel.trigger('slid');
						carousel.data('isAnimating',false);
					});
					carousel.trigger('slide');
					carousel.data('isAnimating',true);
				}
			});
		}

		return $(this);
	};

})(jQuery);
