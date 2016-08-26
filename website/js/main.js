jQuery(function($){
	var isotope = function (){
	    if($('#links').length > 0) {  
	        var container = $('#links');

            container.isotope({
                itemSelector: '.item-thumbs',
                animationEngine: 'best-available',
                transitionDuration: '0.7s',
                masonry: {
                	isFitWidth: true
                }
            });

	        // filter items when filter link is clicked
	        var optionSets = $('.galleryPageLinks');
	        var optionLinks = optionSets.find('a');


	        optionLinks.click(function () {
	            var link = $(this);
	            // don't proceed if already selected
	            if ( link.hasClass('active') ) {
	              return false;
	            }
	            optionSets.find('.active').removeClass('active');
	            link.addClass('active');
	            var filterValue = link.attr('data-filter')

	            container.isotope({ filter: filterValue });
	        });

	        return false;

	    }
	}

	$(document).ready(function(){
		isotope();
	});
});