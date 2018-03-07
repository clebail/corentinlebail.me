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