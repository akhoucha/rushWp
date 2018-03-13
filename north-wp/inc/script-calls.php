<?php
/* De-register Contact Form 7 styles */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles
function thb_main_styles() {
	global $post;
	// Enqueue
	wp_enqueue_style("thb-fa", 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, null);
	wp_enqueue_style("thb-app", Thb_Theme_Admin::$thb_theme_directory_uri .  "assets/css/app.css", null, esc_attr(Thb_Theme_Admin::$thb_theme_version));
	
	if ( wp_unslash($_SERVER['HTTP_HOST']) !== 'newnorth.fuelthemes.net') {
		wp_enqueue_style('thb-style', get_stylesheet_uri(), null, null);	
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), array(), null );
	wp_add_inline_style( 'thb-app', thb_selection() );
	
	if ( $post ) {
		if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action('wp_enqueue_scripts', 'thb_main_styles');

// Main Scripts
function thb_register_js() {
	
	if (!is_admin()) {
		global $post;
		$thb_api_key = ot_get_option('map_api_key');
		// Register 
		wp_enqueue_script('thb-vendor', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/vendor.min.js', array('jquery'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);
		wp_enqueue_script('underscore');
		wp_enqueue_script('thb-app', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/app.min.js', array('jquery', 'thb-vendor', 'underscore'), esc_attr(Thb_Theme_Admin::$thb_theme_version), TRUE);
		
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ) {
			wp_enqueue_script('comment-reply');
		}
		
		// Typekit 
		if ($typekit_id = ot_get_option('typekit_id')) {
			wp_enqueue_script('thb-typekit', 'https://use.typekit.net/'.$typekit_id.'.js', array(), NULL, FALSE );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}
		
		// Enqueue
		if ( $post ) {
			if ( has_shortcode($post->post_content, 'thb_map_parent') ) {
				wp_enqueue_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.esc_attr($thb_api_key).'', false, null, false);
			}
			
			if ( has_shortcode($post->post_content, 'contact-form-7') && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}
		wp_localize_script( 'thb-app', 'themeajax', array( 
			'url' => admin_url( 'admin-ajax.php' ),
			'l10n' => array (
				'loadmore' => esc_html__("Load More", 'north'),
				'loading' => esc_html__("Loading ...", 'north'),
				'nomore' => esc_html__("All Posts Loaded", 'north'),
				'nomore_products' => esc_html__("All Products Loaded", 'north'),
				'results_found' => esc_html__("results found.", 'north')
			),
			'settings' => array (
				'shop_product_listing_pagination' => ot_get_option('shop_product_listing_pagination', 'style1'),
				'posts_per_page' => get_option('posts_per_page'),
				'newsletter' => Thb_Theme_Admin::$thb_theme_directory_uri . 'inc/subscribe_save.php',
				'newsletter_length' => thb_get_cookie_length(),
				'cookie_path' => COOKIEPATH,
				'is_cart'  => thb_wc_supported() ? is_cart() : false,
				'is_checkout' => thb_wc_supported() ? is_checkout() : false
			),
			'icons' => array(
				'close' => thb_load_template_part('assets/img/svg/close.svg')	
			)
		) );
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );