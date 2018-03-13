<?php
require get_template_directory() .'/inc/admin/plugins/class-tgm-plugin-activation.php';

function thb_register_required_plugins() {
	$data = thb_Theme_Admin()->thb_check_for_update_plugins();
	
	if (isset($data->plugins)) {
		foreach ($data->plugins as $plugin) {
			switch ($plugin->plugin_name) {
				case 'WPBakery Visual Composer':
				case 'WPBakery Page Builder':
					$slug = 'js_composer';
					break;
				case 'Slider Revolution':
					$slug = 'revslider';
					break;
				case 'WooCommerce Product Filter':
					$slug = 'prdctfltr';
					break;
				case 'WooCommerce PDF Invoice':
					$slug = 'woocommerce-pdf-invoice';
					break;
				case 'WooCommerce Table Rate Shipping':
					$slug = 'woocommerce-table-rate-shipping';
					break;
				case 'WooCommerce Dynamic Pricing & Discounts':
					$slug = 'wc-dynamic-pricing-and-discounts';
					break;
			}
			$plugins[] = array(
				'name'	=> $plugin->plugin_name,
				'slug'		=> $slug,
				'source' => $plugin->download_url,
				'force_activation' => false,
				'force_deactivation' => false,
				'version' => $plugin->version,
				'required' => true,
				'external_url'	 => '',
				'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/'.esc_attr($slug).'.png'
			);
		}
	} else {
		$plugins[] = array(
			'name'			=> 'WPBakery Visual Composer', // The plugin name
			'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
			'source'			=> Thb_Theme_Admin::$thb_theme_directory_uri . 'inc/admin/plugins/plugins/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', 
			'version'				=> '5.1.1',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' 	=> '',
			'required'			=> true, // If false, the plugin is only 'recommended' instead of required
			'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/js_composer.png'
		);
	}
	$plugins[] = array(
		'name'     				=> esc_html__('WooCommerce', 'north'), // The plugin name
		'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
		'required'			=> true,
		'force_activation'		=> false,
		'force_deactivation'	=> false,
		'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/woo.png'
	);
	$plugins[] = array(
		'name'     				=> esc_html__('YITH WooCommerce Wishlist', 'north'), // The plugin name
		'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
		'required'			=> true,
		'force_activation'		=> false,
		'force_deactivation'	=> false,
		'image_url' => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/wishlist.png'
	);
	$plugins[] = array(
		'name'     				=> esc_html__('Contact Form 7', 'north'), // The plugin name
		'slug'     				=> 'contact-form-7', // The plugin source
		'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation' 	=> false // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	);
	$config = array(
		'id'              => 'thb',
		'domain'       		=> 'north',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_slug'     => 'themes.php',
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'     => true,                       	// Show admin notices or not
		'is_automatic'    => true,					   	// Automatically activate plugins after installation or not
		'message' 				=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'return' 				=> esc_html__( 'Return to Theme Plugins', 'north' )
		)
	);
	tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'thb_register_required_plugins');