jQuery( document ).ready( function( $ ) {

	// Toggle mobile-menu
	$( ".nav-toggle" ).on( "click", function() {
		$( this ).toggleClass( "active" );
		$( ".mobile-menu" ).slideToggle();
		if ( $( ".search-toggle" ).hasClass( "active" ) ) {
			$( ".search-toggle" ).removeClass( "active" );
			$( ".mobile-search" ).slideToggle();
		}
		return false;
	} );

	// Toggle mobile-search
	$( ".search-toggle" ).on( "click", function() {
		$( this ).toggleClass( "active" );
		$( ".mobile-search" ).slideToggle();
		if ( $( ".nav-toggle" ).hasClass( "active" ) ) {
			$( ".nav-toggle" ).removeClass( "active" );
			$( ".mobile-menu" ).slideToggle();
		}
		return false;
	} );

	// Hide/show mobile menu/search block > 900
	$( window ).resize( function() {
		if ( $( window ).width() > 1000 ) {
			$( ".toggle" ).removeClass( "active" );
			$( ".mobile-menu" ).hide();
			$( ".mobile-search" ).hide();
		}
	} );

	// Dropdown menus on touch devices
	$( '.main-menu li.menu-item-has-children' ).doubleTapToGo();

	// Display dropdown menus on focus.
	$( '.main-menu a' ).on( 'blur focus', function( e ) {
		$( this ).parents( 'li.menu-item-has-children' ).toggleClass( 'focus' );
	} );

	// Resize videos after container
	var vidSelector = ".post iframe, .post object, .post video, .widget-content iframe, .widget-content object, .widget-content iframe";
	var resizeVideo = function( sSel ) {
		$( sSel ).each( function() {
			var $video = $( this ),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( ! $video.attr( "data-origwidth" ) ) {
				$video.attr( "data-origwidth", $video.attr( "width" ) );
				$video.attr( "data-origheight", $video.attr( "height" ) );
			}

			var ratio = iTargetWidth / $video.attr( "data-origwidth" );

			$video.css( "width", iTargetWidth + "px" );
			$video.css( "height", ( $video.attr( "data-origheight" ) * ratio ) + "px" );
		});
	};

	resizeVideo( vidSelector );

	$( window ).resize( function() {
		resizeVideo( vidSelector );
	} );

	// When Jetpack Infinite scroll posts have loaded
	$( document.body ).on( 'post-load', function() {

		var $container = $( '.posts' );
		$container.masonry( 'reloadItems' );

		$blocks.imagesLoaded( function() {
			$blocks.masonry({
				itemSelector: '.post-container'
			} );

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$( ".post-container" ).fadeIn();
		} );

		// Rerun video resizing
		resizeVideo( vidSelector );

		$container.masonry( 'reloadItems' );

		// Load Flexslider
		$( ".flexslider" ).flexslider( {
			animation: 		"slide",
			controlNav: 	false,
			nextText: 		"Next",
			prevText: 		"Previous",
			smoothHeight: 	true
		} );

		$( document ).ready( function() {
			setTimeout( function() {
				$blocks.masonry();
			}, 500 );
		} );

	} );

} );
