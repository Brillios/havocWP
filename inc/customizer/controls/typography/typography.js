( function($) {

	$( document ).ready(function () {

		$( '.havocwp-typography-select' ).each( function() {
			$(this).append( havoc_wp_fonts_list.content );
		});

		$( '.havocwp-typography-select' ).select2();
	} );

} )( jQuery );