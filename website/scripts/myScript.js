
//desktop

var clicked = false;
var tempScrollTop; 

if ( $(window).width() > 739) {
	$(function() {
		
		$('.paint').on('click', function () {
			if(clicked == false) {
				tempScrollTop = $(window).scrollTop();
			}
			$(this).toggleClass('clicked');
			$(this).siblings('.caption').toggleClass('captionClicked');
			$('.paint').not(this).closest('.myPanel').toggle();
			$('.paintWide').not(this).closest('.myPanel').toggle();
			$('#galPages').toggle();
			if (clicked == true) {
				$(window).scrollTop(tempScrollTop);
			}
			if(clicked == false) {
				clicked = true;
			}
			else {
				clicked = false;
			}	
		});

		$('.paintWide').on('click', function () {
			if(clicked == false) {
				tempScrollTop = $(window).scrollTop();
			}
			$(this).toggleClass('clicked_paintWide');
			$(this).siblings('.caption').toggleClass('captionClicked');	
			$('.paint').not(this).closest('.myPanel').toggle();	
			$('.paintWide').not(this).closest('.myPanel').toggle();	
			$('#galPages').toggle();
			if (clicked == true) {
				$(window).scrollTop(tempScrollTop);
			}
			if(clicked == false) {
				clicked = true;
			}
			else {
				clicked = false;
			}				
		});

		$('.backGallery').on('click', function () {
			if(clicked == false) {
				tempScrollTop = $(window).scrollTop();
			}
			$(this).parent().siblings('.paint').toggleClass('clicked');
			$(this).parent().siblings('.paintWide').toggleClass('clicked_paintWide');
			$(this).parent().toggleClass('captionClicked');
			$('.backGallery').not(this).closest('.myPanel').toggle();
			$('#galPages').toggle();
			if (clicked == true) {
				$(window).scrollTop(tempScrollTop);
			}
			if(clicked == false) {
				clicked = true;
			}
			else {
				clicked = false;
			}			
		});

	});

	(function($) {
	    $(document).ready(function(){
	 
	        //When distance from top = 250px fade button in/out
	        $(window).scroll(function(){
	            if ($(this).scrollTop() > 250) {
	                $('#scrollup').fadeIn(300);
	            } else {
	                $('#scrollup').fadeOut(300);
	            }
	        });
	 
	        //On click scroll to top of page t = 1000ms
	        $('#scrollup').click(function(){
	            $("html, body").animate({ scrollTop: 0 }, 1000);
	            return false;
	        });
	 
	    });
	})(jQuery);
}


//mobile
else {
	(function($) {
	    $(document).ready(function(){
	 
	        //When distance from top = 250px fade button in/out
	        $(window).scroll(function(){
	            if ($(this).scrollTop() > 250) {
	                $('#scrollup').fadeIn(300);
	            } else {
	                $('#scrollup').fadeOut(300);
	            }
	        });
	 
	        //On click scroll to top of page t = 1000ms
	        $('#scrollup').click(function(){
	            $("html, body").animate({ scrollTop: 0 }, 1000);
	            return false;
	        });
	 
	    });
	})(jQuery);
}


// $('link[rel=stylesheet] [href="styles/mobile.css"]').remove();

// $('link[rel=stylesheet] [href="styles/main.css"]').remove();