<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
  	'sections'        => array(
			array(
			  'title'       => esc_html__('General', 'north'),
			  'id'          => 'general'
			),
			array(
			  'title'       => esc_html__('Shop Settings', 'north'),
			  'id'          => 'shop'
			),
			array(
			  'title'       => esc_html__('Blog Settings', 'north'),
			  'id'          => 'blog'
			),
			array(
			  'title'       => esc_html__('Header Settings', 'north'),
			  'id'          => 'header'
			),
			array(
			  'title'       => esc_html__('Footer Settings', 'north'),
			  'id'          => 'footer'
			),
			array(
			  'title'       => esc_html__('Customization', 'north'),
			  'id'          => 'customization'
			),
			array(
			  'title'       => esc_html__('Misc', 'north'),
			  'id'          => 'misc'
			),
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'general_tab0',
    	  'label'       => esc_html__('General', 'north'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Custom Revolution Slider Arrows?', 'north'),
    	  'id'          => 'revslider_arrows',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This will override the revolution slider arrows to use the North color changing ones.', 'north'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Global Notification', 'north'),
    	  'id'          => 'global_notification',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This adds a global notification at the top.', 'north'),
    	  'std'         => 'off',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Global Notification Content', 'north'),
    	  'id'          => 'global_notification_content',
    	  'type'        => 'textarea',
    	  'desc'        => esc_html__('Content of the notification.', 'north'),
    	  'rows'        => '4',
    	  'section'     => 'general',
    	  'condition'   => 'global_notification:is(on)'
    	),
    	array(
    	  'id'          => 'general_tab1',
    	  'label'       => esc_html__('Newsletter', 'north'),
    	  'type'        => 'tab',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Display Newsletter Popup?', 'north'),
    	  'id'          => 'newsletter',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('Would you like to display the Newsletter Popup?', 'north'),
    	  'std'         => 'on',
    	  'section'     => 'general'
    	),
    	array(
    	  'label'       => esc_html__('Newsletter refresh interval', 'north'),
    	  'id'          => 'newsletter-interval',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('When the user closes the popup, the newsletter will not be visible on the next page. After the below period, its going to be visible again unless he closes it again', 'north'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Never - the popup will be shown every page', 'north'),
    	      'value'       => '0'
    	    ),
    	    array(
    	      'label'       => esc_html__('1 Day', 'north'),
    	      'value'       => '1'
    	    ),
    	    array(
    	      'label'       => esc_html__('2 Days', 'north'),
    	      'value'       => '2'
    	    ),
    	    array(
    	      'label'       => esc_html__('3 Days', 'north'),
    	      'value'       => '3'
    	    ),
    	    array(
    	      'label'       => esc_html__('1 Week', 'north'),
    	      'value'       => '7'
    	    ),
    	    array(
    	      'label'       => esc_html__('2 Weeks', 'north'),
    	      'value'       => '14'
    	    ),
    	    array(
    	      'label'       => esc_html__('3 Weeks', 'north'),
    	      'value'       => '21'
    	    ),
    	    array(
    	      'label'       => esc_html__('1 Month', 'north'),
    	      'value'       => '30'
    	    )
    	    
    	  ),
    	  'std'         => '1',
    	  'section'     => 'general',
    	  'condition'   => 'newsletter:is(on)'
    	),
	  	array(
        'label'       => esc_html__('Newsletter Content', 'north'),
        'id'          => 'newsletter_content',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears just above the email form.', 'north'),
        'rows'        => '4',
        'section'     => 'general',
        'condition'   => 'newsletter:is(on)'
      ),
      array(
        'label'       => esc_html__('Newsletter Image', 'north'),
        'id'          => 'newsletter_image',
        'type'        => 'upload',
        'class'       => 'ot-upload-attachment-id',
        'desc'        => esc_html__('You can add an image to your newsletter if you want. This is optional.', 'north'),
        'section'     => 'general',
        'condition'   => 'newsletter:is(on)'
      ),
	  	array(
        'label'       => esc_html__('Newsletter Background', 'north'),
        'id'          => 'newsletter_bg',
        'type'        => 'background',
        'desc'        => esc_html__('You can change the background of the newsletter from here.', 'north'),
        'section'     => 'general',
        'condition'   => 'newsletter:is(on)'
      ),
      array(
        'label'       => esc_html__('Newsletter Form', 'north'),
        'id'          => 'newsletter_form',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose to use theme form, or a shortcode.', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Theme Form', 'north'),
            'value'       => 'theme-form'
          ),
          array(
            'label'       => esc_html__('Shortcode', 'north'),
            'value'       => 'shortcode'
          )
        ),
        'std'         => 'theme-form',
        'section'     => 'general',
        'condition'   => 'newsletter:is(on)'
      ),
      array(
        'label'       => esc_html__('Newsletter Shortcode', 'north' ),
        'id'          => 'newsletter_form_shortcode',
        'type'        => 'text',
        'section'     => 'general',
        'desc'        => esc_html__('Shortcode you want to use on the newsletter', 'north'),
        'operator' 		=> 'and',
        'condition'   => 'newsletter:is(on),newsletter_form:is(shortcode)'
      ),
      array(
        'id'          => 'general_tab2',
        'label'       => esc_html__('Social Sharing', 'north'),
        'type'        => 'tab',
        'section'     => 'general'
      ),
      array(
        'label'       => esc_html__('Sharing buttons', 'north'),
        'id'          => 'sharing_buttons',
        'type'        => 'checkbox',
        'desc'        => esc_html__('You can choose which social networks to display and get counts from.', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Facebook', 'north'),
            'value'       => 'facebook'
          ),
          array(
            'label'       => esc_html__('Twitter', 'north'),
            'value'       => 'twitter'
          ),
          array(
            'label'       => esc_html__('Pinterest', 'north'),
            'value'       => 'pinterest'
          ),
          array(
            'label'       => esc_html__('Google Plus', 'north'),
            'value'       => 'google-plus'
          ),
          array(
            'label'       => esc_html__('Linkedin', 'north'),
            'value'       => 'linkedin'
          ),
          array(
            'label'       => esc_html__('WhatsApp', 'north'),
            'value'       => 'whatsapp'
          )
        ),
        'section'     => 'general'
      ),
      array(
        'id'          => 'header_tab1',
        'label'       => esc_html__('Header Settings', 'north'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Style', 'north'),
        'id'          => 'header_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which Header Style would you like to use?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2', 'north'),
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Height', 'north'),
        'id'          => 'header_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the header height from here', 'north'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Full Width', 'north'),
        'id'          => 'header_fullwidth',
        'type'        => 'on_off',
        'desc'        => esc_html__('This will make sure that the header is always full width in large screens.', 'north'),
        'section'     => 'header',
        'std'         => 'off'
      ),
			array(
			  'label'       => esc_html__('Header Search', 'north'),
			  'id'          => 'header_search',
			  'type'        => 'on_off',
			  'desc'        => esc_html__('Would you like to display the search icon in the header?', 'north'),
			  'section'     => 'header',
			  'std'         => 'on'
			),
      array(
        'label'       => esc_html__('Header Shopping Cart', 'north'),
        'id'          => 'header_cart',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the shopping cart icon in the header', 'north'),
        'section'     => 'header',
        'std'         => 'on'
      ),
      array(
        'id'          => 'header_tab3',
        'label'       => esc_html__('Logo Settings', 'north'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Height', 'north'),
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header', 'north'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Upload for Light Backgrounds', 'north'),
        'id'          => 'logo',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.', 'north'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Upload for Dark Backgrounds', 'north'),
        'id'          => 'logo_dark',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong> The image should be maximum 100 pixels in height.', 'north'),
        'section'     => 'header'
      ),
      array(
        'id'          => 'shop_tab0',
        'label'       => esc_html__('General', 'north'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Catalog Mode', 'north'),
        'id'          => 'shop_catalog_mode',
        'type'        => 'on_off',
        'desc'        => esc_html__('If enabled, this will hide add to cart buttons and prices along the site.', 'north'),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__('Product Listing Style', 'north'),
        'id'          => 'shop_product_listing',
        'type'        => 'radio',
        'desc'        => esc_html__('Which style would you like to use on listing pages?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2', 'north'),
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product Listing Layout', 'north'),
        'id'          => 'shop_product_listing_layout',
        'type'        => 'radio',
        'desc'        => esc_html__('Which layout would you like to use on listing pages?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Grid', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Alternating - 3 / 4 columns', 'north'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 5 columns', 'north'),
            'value'       => 'style3'
          ),
          array(
            'label'       => esc_html__('Alternating - 5 / 6 columns', 'north'),
            'value'       => 'style4'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 3 columns', 'north'),
            'value'       => 'style5'
          ),
          array(
            'label'       => esc_html__('Alternating - 5 / 4 columns', 'north'),
            'value'       => 'style6'
          ),
          array(
            'label'       => esc_html__('Alternating - 6 / 5 columns', 'north'),
            'value'       => 'style7'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 4 / 3 columns', 'north'),
            'value'       => 'style8'
          )
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
      	'label'       => esc_html__('Products Per Row', 'north' ),
        'id'          => 'products_per_row',
        'std'         => 'thb-5',
        'type'        => 'radio',
        'choices'     => array(
          array(
            'label'       => esc_html__('2 Columns', 'north'),
            'value'       => 'large-6'
          ),
          array(
            'label'       => esc_html__('3 Columns', 'north'),
            'value'       => 'large-4'
          ),
          array(
            'label'       => esc_html__('4 Columns', 'north'),
            'value'       => 'large-3'
          ),
          array(
            'label'       => esc_html__('5 Columns', 'north'),
            'value'       => 'thb-5'
          ),
          array(
            'label'       => esc_html__('6 Columns', 'north'),
            'value'       => 'large-2'
          )
        ),
        'section'     => 'shop',
        'condition'   => 'shop_product_listing_layout:is(style1)'
      ),
      array(
        'label'       => esc_html__('Product Pagination Style', 'north'),
        'id'          => 'shop_product_listing_pagination',
        'type'        => 'radio',
        'desc'        => esc_html__('Which pagination syle would you like to use on shop page?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Regular Pagination', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Load More Button', 'north'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Infinite Load', 'north'),
            'value'       => 'style3'
          )
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Products Per Page', 'north' ),
        'id'          => 'products_per_page',
        'type'        => 'text',
        'section'     => 'shop',
        'std' 				=> '12'
      ),
      array(
        'label'       => esc_html__('Product Hover Image', 'north'),
        'id'          => 'shop_product_hover',
        'type'        => 'on_off',
        'desc'        => esc_html__('When enabled, this shows a secondary product image on hover.', 'north'),
        'section'     => 'shop',
        'std'         => 'on'
      ),
      array(
        'id'          => 'shop_tab2',
        'label'       => esc_html__('Product Page', 'north'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product Page Style', 'north'),
        'id'          => 'shop_product_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which style would you like to use on product pages?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2', 'north'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Style 3', 'north'),
            'value'       => 'style3'
          ),
          array(
            'label'       => esc_html__('Style 4', 'north'),
            'value'       => 'style4'
          ),
          array(
            'label'       => esc_html__('Style 5', 'north'),
            'value'       => 'style5'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Use Lightbox or Zoom?', 'north'),
        'id'          => 'shop_product_lightbox',
        'type'        => 'radio',
        'desc'        => esc_html__('Would you like to use a lightbox or a mouse hover zoom?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Lightbox', 'north'),
            'value'       => 'lightbox'
          ),
          array(
            'label'       => esc_html__('Zoom', 'north'),
            'value'       => 'zoom'
          )
          
        ),
        'std'         => 'lightbox',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab3',
        'label'       => esc_html__('Quick Shop', 'north'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Display Quick Shop', 'north'),
        'id'          => 'quick_shop',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Quick Shop link?', 'north'),
        'std'         => 'on',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Display Category Filter', 'north'),
        'id'          => 'quick_shop_categories',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the category filter?', 'north'),
        'std'         => 'on',
        'section'     => 'shop',
        'condition'   => 'quick_shop:is(on)'
      ),
      array(
        'label'       => esc_html__('Number of Products', 'north' ),
        'id'          => 'quick_shop_count',
        'type'        => 'text',
        'section'     => 'shop',
        'std' 				=> '8',
        'condition'   => 'quick_shop:is(on)'
      ),
      array(
        'id'          => 'shop_tab4',
        'label'       => esc_html__('Shop Header', 'north'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Shop Page Header Style', 'north'),
        'id'          => 'shop_header_style',
        'type'        => 'radio',
        'desc'        => esc_html__('This changes the look of the header on main shop page.', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Just Text', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('With Image', 'north'),
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Shop Header Background', 'north'),
        'id'          => 'shop_header_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the shop header', 'north'),
        'section'     => 'shop',
        'condition'   => 'shop_header_style:is(style2)'
      ),
      array(
        'label'       => esc_html__('Shop Header Color', 'north'),
        'id'          => 'shop_menu_color',
        'type'        => 'radio',
        'desc'        => esc_html__('What color would you like to display for the header? <small>You can change category headers on individual Edit Category pages</small>', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'north'),
            'value'       => 'light-title'
          ),
          array(
            'label'       => esc_html__('Dark', 'north'),
            'value'       => 'dark-title'
          )
          
        ),
        'std'         => 'light-title',
        'section'     => 'shop',
        'condition'   => 'shop_header_style:is(style2)'
      ),
      array(
        'id'          => 'shop_tab5',
        'label'       => esc_html__('Misc', 'north'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product "Just Arrived" Badge time', 'north'),
        'id'          => 'shop_newness',
        'type'        => 'radio',
        'desc'        => esc_html__('Products that are added before the below time will display the new product page', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Never - "Just Arrived" Badge will never be shown', 'north'),
            'value'       => '0'
          ),
          array(
            'label'       => esc_html__('1 Day', 'north'),
            'value'       => '1'
          ),
          array(
            'label'       => esc_html__('2 Days', 'north'),
            'value'       => '2'
          ),
          array(
            'label'       => esc_html__('3 Days', 'north'),
            'value'       => '3'
          ),
          array(
            'label'       => esc_html__('1 Week', 'north'),
            'value'       => '7'
          ),
          array(
            'label'       => esc_html__('2 Weeks', 'north'),
            'value'       => '14'
          ),
          array(
            'label'       => esc_html__('3 Weeks', 'north'),
            'value'       => '21'
          ),
          array(
            'label'       => esc_html__('1 Month', 'north'),
            'value'       => '30'
          )
        ),
        'std'         => '7',
        'section'     => 'shop'
      ),
	  	array(
        'id'          => 'blog_tab1',
        'label'       => esc_html__('General Blog Settings', 'north'),
        'type'        => 'tab',
        'section'     => 'blog'
      ),
			array(
			  'label'       => esc_html__('Blog Style','north'),
			  'id'          => 'blog_style',
			  'type'        => 'radio',
			  'desc'       => esc_html__('You can choose different blog styles here','north'),
			  'choices'     => array(
			    array(
			      'label'       => esc_html__('Style 1 - Masonry','north'),
			      'value'       => 'style1'
			    ),
			    array(
			      'label'       => esc_html__('Style 2 - Vertical','north'),
			      'value'       => 'style2'
			    ),
			    array(
			      'label'       => esc_html__('Style 3 - List','north'),
			      'value'       => 'style3'
			    ),
			    array(
			      'label'       => esc_html__('Style 4 - Grid','north'),
			      'value'       => 'style4'
			    )
			  ),
			  'std'         => 'style1',
			  'section'     => 'blog'
			),
			array(
			  'label'       => esc_html__('Blog Pagination Style','north'),
			  'id'          => 'blog_pagination_style',
			  'type'        => 'radio',
			  'desc'       => esc_html__('You can choose different blog pagination styles here. The regular pagination will be used for archive pages.','north'),
			  'choices'     => array(
			    array(
			      'label'       => esc_html__('Regular Pagination','north'),
			      'value'       => 'style1'
			    ),
			    array(
			      'label'       => esc_html__('Load More Button','north'),
			      'value'       => 'style2'
			    ),
			    array(
			      'label'       => esc_html__('Infinite Scroll','north'),
			      'value'       => 'style3'
			    )
			  ),
			  'std'         => 'style1',
			  'section'     => 'blog'
			),
      array(
        'id'          => 'misc_tab1',
        'label'       => esc_html__('General', 'north'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Google Maps API Key', 'north'),
        'id'          => 'map_api_key',
        'type'        => 'text',
        'desc'        => esc_html__('Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>', 'north'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Extra CSS', 'north'),
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => esc_html__('Any CSS that you would like to add to the theme.', 'north'),
        'section'     => 'misc'
      ),
	  	array(
	  	  'id'          => 'misc_tab2',
	  	  'label'       => esc_html__('Instagram Settings', 'north'),
	  	  'type'        => 'tab',
	  	  'section'     => 'misc'
	  	),
	  	array(
	  	  'label'       => esc_html__('Instagram ID', 'north' ),
	  	  'id'          => 'instagram_id',
	  	  'type'        => 'text',
	  	  'desc'        => sprintf(esc_html__('Your Instagram ID, you can find your ID from here: %1$shttp://www.otzberg.net/iguserid/%2$s', 'north' ),
	  	  	'<a href="http://www.otzberg.net/iguserid/">',
	  	  	'</a>'
	  	  	),
	  	  'section'     => 'misc'
	  	),
	  	array(
	  	  'label'       => esc_html__('Instagram Username', 'north' ),
	  	  'id'          => 'instagram_username',
	  	  'type'        => 'text',
	  	  'desc'        => esc_html__('Your Instagram Username', 'north' ),
	  	  'section'     => 'misc'
	  	),
	  	array(
	  	  'label'       => esc_html__('Access Token', 'north' ),
	  	  'id'          => 'instagram_accesstoken',
	  	  'type'        => 'text',
	  	  'desc'        => sprintf(esc_html__('Visit %1$sthis link%2$s in a new tab, sign in with your Instagram account, click on Create a new application and create your own keys in case you dont have already. After that, you can get your Access Token using %3$shttp://instagram.pixelunion.net/%4$s', 'north' ),
	  	  	'<a href="http://instagr.am/developer/register/" target="_blank">',
	  	  	'</a>',
	  	  	'<a href="http://instagram.pixelunion.net/" target="_blank">',
	  	  	'</a>'
	  	  	),
	  	  'section'     => 'misc'
	  	),
      array(
        'id'          => 'misc_tab3',
        'label'       => esc_html__('Create Additional Sidebars', 'north'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'sidebars_text',
        'label'       => esc_html__('About the sidebars', 'north'),
        'desc'        => esc_html__('All sidebars that you create here will appear both in the Widgets Page(Appearance > Widgets), from where you will have to configure them, and in the pages, where you will be able to choose a sidebar for each page', 'north'),
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Create Sidebars', 'north'),
        'id'          => 'sidebars',
        'type'        => 'list-item',
        'desc'        => esc_html__('Please choose a unique title for each sidebar!', 'north'),
        'section'     => 'misc',
        'settings'    => array(
          array(
            'label'       => esc_html__('ID', 'north'),
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>', 'north')
          )
        )
      ),
      array(
        'id'          => 'customization_tab1',
        'label'       => esc_html__('Colors', 'north'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Just Arrived Badge Color', 'north'),
        'id'          => 'badge_justarrived',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can change the just arrived badge color from here', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('On Sale Badge Color', 'north'),
        'id'          => 'badge_sale',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can change the on sale badge color from here', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('Out of Stock Badge Color', 'north'),
        'id'          => 'badge_outofstock',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can change the out of stock badge color from here', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'id'          => 'customization_tab5',
        'label'       => esc_html__('Menu Customization', 'north'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
	  	array(
        'id'          => 'menu_margin',
        'label'       => esc_html__('Top Level Menu Item Margin', 'north'),
        'desc'        => esc_html__('If you want to fit more menu items to the given space, you can decrease the margin between them here. The default margin is 40px', 'north'),
        'type'        => 'measurement',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => esc_html__('Typography', 'north'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Font Subsets', 'north'),
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => esc_html__('You can add additional character subset specific to your language.', 'north'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('No Subset', 'north'),
        	  'value'       => 'no-subset'
        	),
        	array(
        	  'label'       => esc_html__('Latin Extended', 'north'),
        	  'value'       => 'latin-ext'
        	),
          array(
            'label'       => esc_html__('Greek', 'north'),
            'value'       => 'greek'
          ),
          array(
            'label'       => esc_html__('Cyrillic', 'north'),
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => esc_html__('Vietnamese', 'north'),
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Title Typography', 'north'),
        'id'          => 'title_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the titles', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Body Text Typography', 'north'),
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for general body font', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('Main Menu Typography', 'north'),
        'id'          => 'menu_left_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the main menu', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('Main Menu Submenu Typography', 'north'),
        'id'          => 'menu_left_submenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the submenu elements of the main menu', 'north'),
        'section'     => 'customization'
      ),
	  	array(
        'label'       => esc_html__('Secondary Menu Typography', 'north'),
        'id'          => 'menu_right_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the secondary menu on the right', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Typography', 'north'),
        'id'          => 'menu_mobile_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the mobile menu', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Submenu Typography', 'north'),
        'id'          => 'menu_mobile_submenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the submenu elements of the mobile menu', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Secondary Mobile Menu Typography', 'north'),
        'id'          => 'menu_mobile_secondary_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the secondary mobile menu', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Button Font', 'north'),
        'id'          => 'button_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the button. Uses the Body Font by default', 'north'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab6',
        'label'       => esc_html__('Typekit Support', 'north'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'typekit_text',
        'label'       => esc_html__('About Typekit Support', 'north'),
        'desc'        => esc_html__('Please make sure that you enter your Typekit ID or the fonts wont work. After adding Typekit Font Names, these names will appear on the font selection dropdown on the Typography tab.', 'north'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Typekit Kit ID', 'north'),
        'id'          => 'typekit_id',
        'type'        => 'text',
        'desc'        => esc_html__('Paste the provided Typekit Kit ID. <small>Usually 6-7 random letters</small>', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Typekit Font Names', 'north'),
        'id'          => 'typekit_fonts',
        'type'        => 'text',
        'desc'        => esc_html__('Enter your Typekit Font Name, seperated by comma. For example: futura-pt,aktiv-grotesk <strong>Do not leave spaces between commas</strong>', 'north'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab3',
        'label'       => esc_html__('Backgrounds', 'north'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Header Background', 'north'),
        'id'          => 'header_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the header', 'north'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Background', 'north'),
        'id'          => 'footer_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the footer.', 'north'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'footer_tab1',
        'label'       => esc_html__('General', 'north'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Footer', 'north'),
        'id'          => 'footer',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer?', 'north'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Full Width', 'north'),
        'id'          => 'footer_fullwidth',
        'type'        => 'on_off',
        'desc'        => esc_html__('This will make sure that the footer is always full width in large screens.', 'north'),
        'section'     => 'footer',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__('Footer Style', 'north'),
        'id'          => 'footer_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which Footer Style would you like to use?', 'north'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Simple', 'north'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Widgetized Footer', 'north'),
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab2',
        'label'       => esc_html__('Simple Footer Settings', 'north'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Copyright Text', 'north'),
        'id'          => 'copyright',
        'type'        => 'textarea',
        'rows'        => '4',
        'desc'        => esc_html__('Copyright Text at the bottom left', 'north'),
        'section'     => 'footer'
      ),
			array(
			  'label'       => esc_html__('Social Links to display', 'north' ),
			  'id'          => 'footer_social_icons',
			  'type'        => 'social-links',
			  'desc'        => esc_html__('Add your desired Social Links for the footer here', 'north' ),
			  'section'     => 'footer'
			),
			array(
			  'label'       => esc_html__('Payment Icons to display', 'north'),
			  'id'          => 'footer_payment_icons',
			  'type'        => 'list-item',
			  'desc'        => esc_html__('Add your desired Payment Icons for the footer here', 'north'),
			  'settings'    => array(
			    array(
			      'label'       => esc_html__('Payment Type', 'north'),
			      'id'          => 'payment_type',
			      'type'        => 'select',
			      'choices'     => array(
			    		array(
			    			'label'       => 'Visa',
			    			'value'       => 'payment_visa'
			    		),
			    		array(
			    			'label'       => 'MasterCard',
			    			'value'       => 'payment_mc'
			    		),
			    		array(
			    			'label'       => 'PayPal',
			    			'value'       => 'payment_pp'
			    		),
			    		array(
			    			'label'       => 'Discover',
			    			'value'       => 'payment_discover'
			    		),
			    		array(
			    			'label'       => 'Amazon Payments',
			    			'value'       => 'payment_amazon'
			    		),
			    		array(
			    			'label'       => 'Stripe',
			    			'value'       => 'payment_stripe'
			    		),
			    		array(
			    			'label'       => 'American Express',
			    			'value'       => 'payment_amex'
			    		),
			    		array(
			    			'label'       => 'Diners Club',
			    			'value'       => 'payment_diners'
			    		),
			    		array(
			    			'label'       => 'Google Wallet',
			    			'value'       => 'payment_wallet'
			    		)
			      )
			    )
			  ),
			  'section'     => 'footer'
			),
			array(
			  'id'          => 'footer_tab3',
			  'label'        => esc_html__('Widgetized Footer Settings', 'north'),
			  'type'        => 'tab',
			  'section'     => 'footer'
			),
			array(
			  'label'       => esc_html__('Footer Columns', 'north'),
			  'id'          => 'footer_columns',
			  'type'        => 'radio-image',
			  'desc'        => esc_html__('You can change the layout of footer columns here', 'north'),
			  'std'         => 'fourcolumns',
			  'section'     => 'footer'
			),
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }

  
  // Add Revolution Slider select option
  function add_revslider_select_type( $array ) {

    $array['revslider-select'] = 'Revolution Slider Select';
    return $array;

  }
  add_filter( 'ot_option_types_array', 'add_revslider_select_type' ); 

  // Show RevolutionSlider select option
  function ot_type_revslider_select( $args = array() ) {
    extract( $args );
    $has_desc = $field_desc ? true : false;
    echo '<div class="format-setting type-revslider-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      echo '<div class="format-setting-inner">';
      // Add This only if RevSlider is Activated
      if ( class_exists( 'RevSliderAdmin' ) ) {
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

        /* get revolution array */
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSlidersShort();

        /* has slides */
        if ( ! empty( $arrSliders ) ) {
          echo '<option value="">-- ' . esc_html__( 'Choose One', 'north' ) . ' --</option>';
          foreach ( $arrSliders as $rev_id => $rev_slider ) {
            echo '<option value="' . esc_attr( $rev_id ) . '"' . selected( $field_value, $rev_id, false ) . '>' . esc_attr( $rev_slider ) . '</option>';
          }
        } else {
          echo '<option value="">' . esc_html__( 'No Sliders Found', 'north' ) . '</option>';
        }
        echo '</select>';
      } else {
          echo '<span style="color: red;">' . esc_html__( 'Sorry! Revolution Slider is not Installed or Activated', 'north' ). '</span>';
      }
      echo '</div>';
    echo '</div>';
  }
}

/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {
  
  function ot_type_menu_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $menus = get_terms( 'nav_menu');
        
        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . esc_html__( 'Choose One', 'north' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . esc_html__( 'No Menus Found', 'north' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}

/**
 * Product Category Checkbox option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_product_category_checkbox' ) ) {
  
  function ot_type_product_category_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        
        /* get category array */

		$args = array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => '0'
		);

		$categories = get_terms( apply_filters( 'ot_type_category_checkbox_query', 'product_cat', $args, $field_id ) );
        
        /* build categories */
        if ( ! empty( $categories ) ) {
          foreach ( $categories as $category ) {
            echo '<p>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $category->term_id ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $field_value[$category->term_id] ) ? checked( $field_value[$category->term_id], $category->term_id, false ) : '' ) . ' class="option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $category->term_id ) . '">' . esc_attr( $category->name ) . '</label>';
            echo '</p>';
          } 
        } else {
          echo '<p>' . esc_html__( 'No Product Categories Found', 'north' ) . '</p>';
        }
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}