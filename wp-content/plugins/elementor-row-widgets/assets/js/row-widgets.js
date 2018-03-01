( function( $ ) {
	var RowWigets_ContinueReading = function( $scope, $ ) {
		var btn = $scope.find('button');
		btn.click(function(){
			$($(this).data('target')).collapse('toggle');
		});
		$scope.find('.collapse').on('hide.bs.collapse', function () {
			btn.text(btn.data('show'));
		}).on('show.bs.collapse', function () {
			btn.text(btn.data('hide'));
		})
	};


	var RowWigets_RelatedProjects = function( $scope, $ ){
		var projects_slider = $scope.find('.projects-slider');
			item_w = projects_slider.find('.item').first().outerWidth(),
			visible_slides = 0;

		var calculateSlides = function(){
			visible_slides = Math.floor($(window).width() / item_w);
		}
		calculateSlides();

		var settings = {
			variableWidth: true,
			slidesToShow: visible_slides,
			arrows: true,
			dots: false,
			infinite:false,
			swipeToSlide:true
		}

		if ($(window).width() >= 600) {
			projects_slider.slick(settings);
		}

		$(window).resize(function(){
			if ($(window).width() < 600) {
				if (projects_slider.hasClass('slick-initialized')) {
					projects_slider.slick('unslick');
				}
			} 
			else {
				var OLD_visible_slides = visible_slides;
				calculateSlides();

				if (!projects_slider.hasClass('slick-initialized')) {
					settings['slidesToShow'] = visible_slides;
					projects_slider.slick(settings);
				} 
				else if(visible_slides !== 1 && OLD_visible_slides !== visible_slides){
					projects_slider.slick('slickSetOption','slidesToShow', visible_slides, true);
				}
			}

		})
	}




	
	// Make sure you run this code under Elementor..
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/row-continue-reading.default', RowWigets_ContinueReading );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/row-projects-widget.default', RowWigets_RelatedProjects );
	} );
} )( jQuery );
