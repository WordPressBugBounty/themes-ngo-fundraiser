(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-ngo_fundraiser_options-';
		
		// Label
		function ngo_fundraiser_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Global Color Setting

			if ( id === 'ngo_fundraiser_global_color' || id === 'ngo_fundraiser_heading_color' || id === 'ngo_fundraiser_paragraph_color') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'ngo_fundraiser_scroll_hide' || id === 'ngo_fundraiser_preloader_hide' || id === 'ngo_fundraiser_sticky_header' || id === 'ngo_fundraiser_products_per_row' || id === 'ngo_fundraiser_width_option')  {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'ngo_fundraiser_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'ngo_fundraiser_facebook_icon' || id === 'ngo_fundraiser_twitter_icon' || id === 'ngo_fundraiser_intagram_icon'|| id === 'ngo_fundraiser_linkedin_icon'|| id === 'ngo_fundraiser_pintrest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header

			if ( id === 'ngo_fundraiser_topbar_phone_text' || id === 'ngo_fundraiser_search_setting' || id === 'ngo_fundraiser_topbar_mail_text' || id === 'ngo_fundraiser_header_button_text' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'ngo_fundraiser_slider_short_heading' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Popular Causes

			if ( id === 'ngo_fundraiser_about_us_heading' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'ngo_fundraiser_footer_bg_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'ngo_fundraiser_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'ngo_fundraiser_single_post_page_image_border_radius' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-ngo_fundraiser_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

	    // Site Identity
		ngo_fundraiser_customizer_label( 'custom_logo', 'Logo Setup' );
		ngo_fundraiser_customizer_label( 'site_icon', 'Favicon' );

		// Global Color Setting
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_global_color', 'Global Color' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_heading_color', 'Heading Typography' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_paragraph_color', 'Paragraph Typography' );

		// General Setting
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_preloader_hide', 'Preloader' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_scroll_hide', 'Scroll To Top' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_products_per_row', 'woocommerce Setting' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_width_option', 'Site Width Layouts' );

		// Colors
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_theme_color', 'Theme Color' );
		ngo_fundraiser_customizer_label( 'background_color', 'Colors' );
		ngo_fundraiser_customizer_label( 'background_image', 'Image' );

		//Header Image
		ngo_fundraiser_customizer_label( 'header_image', 'Header Image' );

		// Social Icon
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_facebook_icon', 'Facebook' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_twitter_icon', 'Twitter' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_intagram_icon', 'Intagram' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_linkedin_icon', 'Linkedin' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_pintrest_icon', 'Pintrest' );

		// Header
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_topbar_text', 'Topbar Text' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_search_setting', 'Header Search' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_topbar_mail_text', 'Email Address' );
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_header_button_text', 'Header Button' );

		//Slider
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_slider_short_heading', 'Slider' );

		//Popular Causes
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_about_us_heading', 'Popular Causes' );

		//Footer
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_footer_bg_image', 'Footer' );

		// Post Setting
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_post_page_title', 'Post Setting' );

		//Single Post Setting
		ngo_fundraiser_customizer_label( 'ngo_fundraiser_single_post_page_image_border_radius', 'Single Post Setting' );
	
	});

})( jQuery );
