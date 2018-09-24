/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/***************************************************************
	 * Site title and description.
	 *************************************************************/
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );


	/***************************************************************
	 * Header text color.
	 *************************************************************/
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	

	/***************************************************************
	 * Top Header Enable Options Options
	 *************************************************************/
	wp.customize( 'relic_fashion_store_top_header_enable', function( value ) {
		value.bind( function( enable ) {
			if( enable == true ){
				$("#relic_fashion_store_top_header_enable").fadeIn('slow');
			}else{
				$("#relic_fashion_store_top_header_enable").fadeOut('slow');
			}
		})
	});
	

	
	/***************************************************************
	 * Main Header Section enable disable
	 *************************************************************/
	wp.customize( 'relic_fashion_store_search_box_enable', function( value ) {
		value.bind( function( enable ) {
			if( enable == true ){
				$("#relic_fashion_store_search_box_enable").fadeIn('slow');
			}else{
				$("#relic_fashion_store_search_box_enable").fadeOut('slow');
			}
		})
	});


	/***************************************************************
	 * main header wishlist
	 *************************************************************/
	wp.customize( 'relic_fashion_store_main_header_wishlist_enable', function( value ) {
		value.bind( function( enable ) {
			if( enable == true ){
				$("li.main-header-wishlist").fadeIn('slow');
			}else{
				$("li.main-header-wishlist").fadeOut('slow');
			}
		})
	});



	/***************************************************************
	 * main header cart
	 *************************************************************/ 
	wp.customize( 'relic_fashion_store_main_header_add_cart_enable', function( value ) {
		value.bind( function( enable ) {
			if( enable == true ){
				$("li.main-header-cart").fadeIn('slow');
			}else{
				$("li.main-header-cart").fadeOut('slow');
			}
		})
	});


	/************************************************
	 * Relic Fashion Store Products Tabs 
	 ***********************************************/
	wp.customize( 'products_tabs_title', function( value ) {
		value.bind( function( newval ) {
			$( 'h6#products_tabs_title' ).html( newval );
		} );
	} );

    
} )( jQuery );


