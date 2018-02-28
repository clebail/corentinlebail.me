$(function()
{
	/**
	 * HEADER
	 * --------------------------------------------------------------------------
	 */
	$(window).on('resize', function ()
	{
		if ($(window).width() < 768)
		{
			$('#quicklinks-box dt a').unbind('click').on('click', function(event)
			{
				event.preventDefault();

				$(this).toggleClass('hover');
				$(this).next('ul').toggleClass('show');
				$('#quicklinks-box dt li input[type=text]').focus();
			});

		} else {

			$('#quicklinks-box dt a').unbind('click');

		}
	}).resize();


	/**
	 * NAVIGATION
	 * --------------------------------------------------------------------------
	 */
	$(window).on('resize', function ()
	{
		if ($(window).width() < 768)
		{
			// Add mobile class
			$('nav').addClass('mobile');

			// Menu launcher icon
			$('nav.mobile li.toggle-menu').unbind('click').on('click', function(event)
			{
				event.preventDefault();
				$(this).siblings().toggleClass('show');
			});

			// Others
			$('nav.mobile li:has(ul)').find('a').unbind('click').on('click', function()
			{
			   	var parent = $(this).parent();
			   	parent.siblings().find('li.show').removeClass('show');
			   	parent.find('ul:first > li').toggleClass('show');
			});

			// Homepage content padding-top
			$('#main.homepage').css('padding-top', 20);

		} else {

			// Remove mobile class
			$('nav').removeClass('mobile');

			// First Level, no timeout
			$('nav > ul >li')
				.on('mouseenter', function() {
					$(this).stop(true, false).addClass('hover');
				})
				.on('mouseleave', function() {
					$(this).stop(true, false).removeClass('hover');
				});

			// Second & third level, need timeout to display menu
			$('nav li li')
				.on('mouseenter', function() {
					$(this).stop(true, false).delay(400).queue(function() {
					    $(this).addClass('hover');
					});
				})
				.on('mouseleave', function() {
					$(this).stop(true, false).removeClass('hover');
				});

			// Homepage content padding-top
			var navHeight = $('nav .menu').height() + 40;
			$('#main.homepage').css('padding-top', navHeight);

		}
	}).resize();

	
	$('html').click(function() {
		$('.navigation').removeClass('hover');
		$('#navigation').slideUp('fast');
	});
	$('#navigation').click(function(e) {
		e.stopPropagation();
	});
	$('.navigation').click(function(e) {
		e.stopPropagation();
		$('.navigation').toggleClass('hover');
		$('#navigation').slideToggle('fast');
		e.preventDefault();
	});

	/**
	 * FOOTER
	 * --------------------------------------------------------------------------
	 */
	$(window).on('resize', function ()
	{
		if ($(window).width() < 768)
		{
			$('footer h4').unbind('click').on('click', function(event)
			{
				event.preventDefault();
		
				$(this).closest('section').toggleClass('active');
				$(this).next().slideToggle()
			});

		} else {

			$('footer h4').unbind('click');

		}
	}).resize();


	/**
	 * GO TO TOP
	 * --------------------------------------------------------------------------
	 */
	$('#gototop').hide();

	$(window).scroll(function()
	{
		if ($(document).scrollTop() > 100)
		{
			$('#gototop').fadeIn('slow');
		} else {
			$('#gototop').fadeOut('slow');
		}
	});

	$('#gototop').on('click', function()
	{
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});


	/**
	 * LEFT MENU
	 * --------------------------------------------------------------------------
	 */
	$(window).on('resize', function ()
	{
		if ($(window).width() < 768)
		{
			$('.left-menu h3, .left-menu h4').unbind('click').on('click', function(event)
			{
				event.preventDefault();

				$(this).parent().toggleClass('active');
				$(this).next().slideToggle();
			});

		} else {

			$('.left-menu h4').parent().addClass('active');
			$('.left-menu h3').unbind('click');
			$('.left-menu h4').unbind('click').on('click', function(event) {
				event.preventDefault();

				$(this).parent().toggleClass('active');
				$(this).next().slideToggle();
			});

		}
	}).resize();

	/**
	 * GLOBAL
	 * -------------------------------------------------------
	 */	
	$.fn.gotoElement = function(offset) {
		offset = offset || 0;
		
		$('html, body').animate({
            scrollTop: $(this).offset().top - offset
        }, 500);
	};
	
	$(document).on("click", "a.openpopup", function(e) {
		var a = $(this);
		var popup = $(a.attr("href"));
		
		popup.find("input[type='hidden'].id").val(a.attr("data-id"));
		
		e.preventDefault;
		
		$.magnificPopup.open({
			items: {
				src: a.attr("href"),
			},
			modal: true,
			type: 'inline',
			midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			mainClass: 'my-mfp-zoom-in',
			focus: 'input',
			removalDelay: 300,
		});
	});

    $(document).on("click", ".mfp-actions a.cancel", function(e) {
		e.preventDefault();

		$.magnificPopup.instance.close();
	});
});

function showMessage(message) {
	$("#popupMessage").html(message);
	$("#popupMessage").fadeIn();
	setTimeout(function() { $("#popupMessage").fadeOut(); }, 2000);
}