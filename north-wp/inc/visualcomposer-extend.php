<?php

$thb_animation_array = array(
	"type" => "dropdown",
	"heading" => esc_html__("Animation", "north"),
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"Left" => "animation right-to-left",
		"Right" => "animation left-to-right",
		"Left - Long" => "animation right-to-left-long",
		"Right - Long" => "animation left-to-right-long",
		"Top" => "animation bottom-to-top",
		"Bottom" => "animation top-to-bottom",
		"Scale" => "animation scale",
		"Fade" => "animation fade-in"
	)
);
$thb_column_array = array(
	'2 Columns' => "large-6",
	'3 Columns' => "large-4",
	'4 Columns' => "large-3",
	'5 Columns' => "thb-5",
	'6 Columns' => "large-2"
);
$thb_button_style_array = array(
	'Standard' => '',
	'Border' => "alt",
	'Pill - Standard' => "pill",
	'Pill - Border' => "pill alt"
);
// Shortcodes 
$shortcodes = Thb_Theme_Admin::$thb_theme_directory.'vc_templates/';
$files = glob($shortcodes.'/thb_?*.php');
foreach ($files as $filename) {
	require get_template_directory().'/vc_templates/'.basename($filename);
}

/* Visual Composer Mappings */

// Adding animation to columns
vc_add_param("vc_column", array(
	"type" => "dropdown",
	"heading" => esc_html__("Column Content Color", 'north'),
	"param_name" => "thb_color",
	"value" => array(
		"Dark" => "thb-dark-column",
		"Light" => "thb-light-column"
	),
	'weight' => 1,
	"description" => esc_html__("If you white-colored contents for this column, select Light.", 'north')
));
vc_add_param("vc_column_inner", array(
	"type" => "dropdown",
	"heading" => esc_html__("Column Content Color", 'north'),
	"param_name" => "thb_color",
	"value" => array(
		"Dark" => "thb-dark-column",
		"Light" => "thb-light-column"
	),
	'weight' => 1,
	"description" => esc_html__("If you white-colored contents for this column, select Light.", 'north')
));

vc_remove_param( "vc_column", "css_animation" );
vc_remove_param( "vc_column_inner", "css_animation" );
vc_add_param("vc_column", $thb_animation_array);
vc_add_param("vc_column_inner", $thb_animation_array);

// Text Area
vc_remove_param("vc_column_text", "css_animation");
vc_add_param("vc_column_text", $thb_animation_array);

// Inner Row
vc_remove_param( "vc_row_inner", "gap" );
vc_remove_param( "vc_row_inner", "equal_height" );
vc_remove_param( "vc_row_inner", "css_animation" );

vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__("Enable Max Width", 'north'),
	"param_name" => "thb_max_width",
	"value" => array(
		"Yes" => "max_width"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, the row won't exceed the max width, especially inside a full-width parent row.", 'north')
));

vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__("Disable Padding", 'north'),
	"param_name" => "thb_row_padding",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, the columns inside won't leave padding on the sides", 'north')
));

// Row
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_param( "vc_row", "css_animation" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "parallax_speed_video" );

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Enable Full Width", 'north'),
	"param_name" => "thb_full_width",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row will fill the screen", 'north')
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Disable Padding", 'north'),
	"param_name" => "thb_row_padding",
	"value" => array(
		"Yes" => "true"
	),
	'weight' => 1,
	"description" => esc_html__("If you enable this, this row won't leave padding on the sides", 'north')
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Full Height Row", 'north'),
	"param_name" => "full_height",
	"value" => array(
		"Yes" => "true"
	),
	"description" => esc_html__("If enabled, this will cause this row to always fill the height of the window.", 'north' )
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => esc_html__("Video Background", 'north'),
	"param_name" => "thb_video_bg",
	'weight' => 1,
	"description" => esc_html__("You can specify a video background file here (mp4)", 'north')
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"heading" => esc_html__("Video Overlay Color", 'north'),
	"param_name" => "thb_video_overlay_color",
	'weight' => 1,
	"description" => esc_html__("If you want, you can select an overlay color.", 'north')
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__("Disable AutoPlay", 'north'),
	"param_name" => "thb_video_play_button",
	'weight' => 1,
	"value" => array(
		"Yes" => "thb_video_play_button_enabled"
	),
	"description" => esc_html__("If enabled, the video won't start automatically and can be toggled using the Play Button Element.", 'north')
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"heading" => esc_html__("Header Logo Color", 'north'),
	"param_name" => "thb_color",
	"value" => array(
		"Dark" => "dark-title",
		"Light" => "light-title"
	),
	"std" => "dark-title",
	'weight' => 1,
	"description" => esc_html__("This setting affects the color of the logo when snap to scroll template is being used.", 'north')
));

// Add to Cart Button
vc_map(array(
   "name"			=> __("Add to Cart Button", 'north'),
   "base" => "thb_add_to_cart",
   "icon" => "thb_vc_ico_add_to_cart",
   "class" => "thb_vc_sc_add_to_cart",
   "category" => esc_html__("by Fuel Themes", 'north'),
   "params" 	=> array( 
		array(
			"type"			=> "textfield",
			"admin_label" 	=> true,
			"heading"		=> esc_html__("Product ID", 'north'),
			"param_name"	=> "id",
			"description" => esc_html__("Only enter 1 Product ID", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Product Title?", 'north'),
			"param_name" => "title",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If you want to show the product title, enable this", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Product Excerpt?", 'north'),
			"param_name" => "excerpt",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If you want to show the product excerpt, enable this", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Product Price?", 'north'),
			"param_name" => "price",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If you want to show the price, enable this", 'north')
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Button Style", 'north'),
		  "param_name" => "btn_style",
		  "value" => $thb_button_style_array,
		  "description" => esc_html__("This changes the look of the button", 'north')
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Button Color", 'north'),
		  "param_name" => "btn_color",
		  "value" => array(
		  	"Black" => "",
		  	"White" => "white"
		  ),
		  "description" => esc_html__("This changes the color of the button", 'north')
		),
		array(
			"type"				=> "dropdown",
			"heading"			=> esc_html__("Alignment", 'north'),
			"param_name"	=> "align",
			"value"				=> array(
				"Left"			=> "text-left",
				"Center"		=> "text-center",
				"Right"			=> "text-right",
			),
		),
   ),
   "description" => esc_html__("Single Add-to-Cart button", 'north')
));

// Button shortcode
vc_map( array(
	"name" => esc_html__( "Button", 'north'),
	"base" => "thb_button",
	"icon" => "thb_vc_ico_button",
	"class" => "thb_vc_sc_button",
	"category" => esc_html__('by Fuel Themes', 'north'),
	"params" => array(
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__("Link", 'north'),
		  "param_name" => "link",
		  "description" => esc_html__("Enter url for link", 'north'),
		  "admin_label" => true,
		),
		array(
	    "type" => "dropdown",
	    "heading" => esc_html__("Style", 'north'),
	    "param_name" => "style",
	    "value" => $thb_button_style_array,
	    "description" => esc_html__("This changes the look of the button", 'north')
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Color", 'north'),
		  "param_name" => "color",
		  "value" => array(
		  	"Black" => "",
		  	"White" => "white"
		  ),
		  "description" => esc_html__("This changes the color of the button", 'north')
		),
		$thb_animation_array,
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Full Width", 'north'),
			"param_name" => "full_width",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If enabled, this will make the button fill it's container", 'north'),
		),
	),
	"description" => esc_html__("Add an animated button", 'north')
) );

// Google Map
vc_map( array(
	"name" => esc_html__("Contact Map Parent", 'north'),
	"base" => "thb_map_parent",
	"icon" => "thb_vc_ico_contactmap",
	"class" => "thb_vc_sc_contactmap",
	"content_element"	=> true,
	"category" => esc_html__("by Fuel Themes", 'north'),
	"as_parent" => array('only' => 'thb_map'),
	"params" => array(
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Map Height", 'north'),
		  "param_name" => "height",
		  "admin_label" => true,
		  "value" => 50,
		  "description" => esc_html__("Enter height of the map in vh (0-100). For example, 50 will be 50% of viewport height and 100 will be full height. <small>Make sure you have filled in your Google Maps API inside Appearance > Theme Options.</small>", 'north')
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Map Zoom', 'north' ),
			'param_name'     => 'zoom',
			'value'			 => '0',
			'description'    => esc_html__( 'Set map zoom level. Leave 0 to automatically fit to bounds.', 'north' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Map Controls', 'north' ),
			'param_name'     => 'map_controls',
			'std'            => 'panControl, zoomControl, mapTypeControl, scaleControl',
			'value'          => array(
				__('Pan Control', 'north')             => 'panControl',
				__('Zoom Control', 'north')            => 'zoomControl',
				__('Map Type Control', 'north')        => 'mapTypeControl',
				__('Scale Control', 'north')           => 'scaleControl',
				__('Street View Control', 'north')     => 'streetViewControl'
			),
			'description'    => esc_html__( 'Toggle map options.', 'north' )
		),
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'Map Type', 'north' ),
			'param_name'     => 'map_type',
			'std'            => 'roadmap',
			'value'          => array(
				__('Roadmap', 'north')   => 'roadmap',
				__('Satellite', 'north') => 'satellite',
				__('Hybrid', 'north')    => 'hybrid',
			),
			'description' => esc_html__( 'Choose map style.', 'north' )
		),
		array(
			'type' => 'textarea_raw_html',
			'heading' => esc_html__( 'Map Style', 'north' ),
			'param_name' => 'map_style',
			'description' => esc_html__( 'Paste the style code here. Browse map styles in <a href="https://snazzymaps.com/" target="_blank">SnazzyMaps</a>', 'north' )
		),
	),
	"description" => esc_html__("Insert your Contact Map", 'north' ),
	"js_view" => 'VcColumnView'
) );

vc_map( array(
	"name" => esc_html__("Contact Map Location", 'north'),
	"base" => "thb_map",
	"icon" => "thb_vc_ico_contactmap",
	"class" => "thb_vc_sc_contactmap",
	"category" => esc_html__("by Fuel Themes", 'north'),
	"as_child"         => array('only' => 'thb_map_parent'),
	"params"           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Marker Image', 'north' ),
			'param_name'     => 'marker_image',
			'description'    => esc_html__( 'Add your Custom marker image or use default one.', 'north' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Retina Marker', 'north' ),
			'param_name'     => 'retina_marker',
			'value'          => array(
				__('Yes', 'north') => 'yes',
			),
			'description'    => esc_html__( 'Enabling this option will reduce the size of marker for 50%, example if marker is 32x32 it will be 16x16.', 'north' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Latitude', 'north' ),
			'admin_label' 	 => true,
			'param_name'     => 'latitude',
			'description'    => esc_html__( 'Enter latitude coordinate. To select map coordinates <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">click here</a>.', 'north' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Longitude', 'north' ),
			'admin_label' 	 => true,
			'param_name'     => 'longitude',
			'description'    => esc_html__( 'Enter longitude coordinate.', 'north' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Marker Title', 'north' ),
			'param_name'     => 'marker_title',
		),
		array(
			'type'           => 'textarea',
			'heading'        => esc_html__( 'Marker Description', 'north' ),
			'param_name'     => 'marker_description',
		)
	)
) );

class WPBakeryShortCode_thb_map_parent extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_thb_map extends WPBakeryShortCode {}

// Iconbox shortcode
vc_map( array(
	"name" => esc_html__("Iconbox", 'north'),
	"base" => "thb_iconbox",
	"icon" => "thb_vc_ico_iconbox",
	"class" => "thb_vc_sc_iconbox",
	"category" => esc_html__("by Fuel Themes", 'north'),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Type", 'north'),
			"param_name" => "type",
			"value" => array(
				"Top Icon - Style 1" => "top type1",
				"Top Icon - Style 2" => "top type2",
				"Top Icon - Style 3" => "top type3",
				"Left Icon - Style 1" => "left type1",
				"Right Icon - Style 1" => "right type1"
			)
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Alignment", 'north'),
			"param_name" => "alignment",
			"value" => array(
				"Left" => "text-left",
				"Center" => "text-center",
				"Right" => "text-right"
			),
			"std" => "text-center",
			"dependency" => Array('element' => "type", 'value' => array('top type1'))
			
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Add Background Image', 'north' ),
			'param_name'     => 'bg_image',
			"dependency" => Array('element' => "type", 'value' => array('top type3'))
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Icon", 'north'),
			"param_name" => "icon",
			"value" => thb_getIconArray()
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__("SVG Icon Color", 'north'),
			"param_name" => "thb_icon_color"
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Image As Icon', 'north' ),
			'param_name'     => 'icon_image',
			'description'    => esc_html__( 'You can set an image instead of an icon.', 'north' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Image Width", 'north'),
			"param_name" => "icon_image_width",
			'description'    => esc_html__( 'If you are using an image, you can set custom width here. Default is 64 (pixels).', 'north' )
		),
		array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Link', 'north' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Add a link to the iconbox if desired.', 'north' ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Heading", 'north'),
			"param_name" => "heading",
			"admin_label" => true
		),
		array(
			"type" => "textarea_safe",
			"heading" => esc_html__("Content", 'north'),
			"param_name" => "description",
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Animation", 'north'),
			"param_name" => "animation",
			"value" => array(
				"Yes" => "true"
			),
			'weight' => 1,
			'std' => 'true',
			"description" => esc_html__("You can disable animation if you like.", 'north')
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Animation Speed", 'north'),
			"param_name" => "animation_speed",
			"value" => "1.5",
			'description'    => esc_html__( 'Speed of the animation in seconds', 'north' ),
			"dependency" => Array('element' => "animation", 'value' => array('true')),
		),
	),
	"description" => esc_html__("Iconboxes with different animations", 'north')
) );

// Image shortcode
vc_map( array(
	"name" => "Image",
	"base" => "thb_image",
	"icon" => "thb_vc_ico_image",
	"class" => "thb_vc_sc_image",
	"category" => esc_html__('by Fuel Themes', 'north'),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__("Select Image", 'north'),
			"param_name" => "image"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Display Caption?", 'north'),
			"param_name" => "caption",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If selected, the image caption will be displayed.", 'north')
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Caption Style", 'north'),
		  "param_name" => "caption_style",
		  "value" => array(
		  	"Style1" => "style1", 
		  	"Style2" => "style2"
		  ),
		  "description" => esc_html__("Select caption style.", 'north'),
		  "dependency" => Array('element' => "caption", 'value' => array('true'))
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Text Below Image', 'north' ),
			'param_name'     => 'content'
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Retina Size?", 'north'),
			"param_name" => "retina",
			"value" => array(
				"Yes" => "retina_size"
			),
			"description" => esc_html__("If selected, the image will be display half-size, so it looks crisps on retina screens. Full Width setting will override this.", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Full Width?", 'north'),
			"param_name" => "full_width",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If selected, the image will always fill its container", 'north')
		),
		$thb_animation_array,
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Image size", 'north'),
		  "param_name" => "img_size",
		  "description" => esc_html__("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", 'north')
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Image alignment", 'north'),
		  "param_name" => "alignment",
		  "value" => array("Align left" => "alignleft", "Align right" => "alignright", "Align center" => "aligncenter"),
		  "description" => esc_html__("Select image alignment.", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Link to Full-Width Image?", 'north'),
			"param_name" => "lightbox",
			"value" => array(
				"Yes" => "true"
			)
		),
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__("Image link", 'north'),
		  "param_name" => "img_link",
		  "description" => esc_html__("Enter url if you want this image to have link.", 'north'),
		  "dependency" => Array('element' => "lightbox", 'is_empty' => true)
		)
	),
	"description" => esc_html__("Add an animated image", 'north')
) );

// Image Slider
vc_map( array(
	"name" => esc_html__("Image Slider", 'north'),
	"base" => "thb_slider",
	"icon" => "thb_vc_ico_slider",
	"class" => "thb_vc_sc_slider",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params" => array(
		array(
			"type" => "attach_images", //attach_images
			"heading" => esc_html__("Select Images", "north"),
			"param_name" => "images",
			"admin_label" => true
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Width", "north"),
		  "param_name" => "width",
		  "description" => esc_html__("Enter the width of the images. The slider will fill the width of the container, so make sure you size the columns accordingly.", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Height", "north"),
		  "param_name" => "height",
		  "description" => esc_html__("Enter the height of the images.", "north")
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Navigation Arrows", "north"),
			"param_name" => "navigation",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("Check this if you want to show navigation arrows.", "north")
		)
	),
	"description" => esc_html__("Add an image slider", "north")
) );

// Instagram
vc_map( array(
	"name" => esc_html__("Instagram", 'north'),
	"base" => "thb_instagram",
	"icon" => "thb_vc_ico_instagram",
	"class" => "thb_vc_sc_instagram",
	"category" => esc_html__("by Fuel Themes", 'north'),
	"params"	=> array(
	  array(
      "type" => "textfield",
      "heading" => esc_html__("Number of Photos", 'north'),
      "param_name" => "number",
      "description" => esc_html__("Number of Instagram Photos to retrieve.", 'north')
	  ),
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Columns", 'north'),
			"param_name" => "columns",
			"admin_label" => true,
			"value" => $thb_column_array,
		),
		array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Add Padding between photos?", 'north'),
	    "param_name" => "padding",
	    "value" => array(
				"Yes" => "true"
			),
	    "description" => esc_html__("You can add spaces between photos", 'north')
		),
	  array(
      "type" => "checkbox",
      "heading" => esc_html__("Link Photos to Instagram?", 'north'),
      "param_name" => "link",
      "value" => array(
				"Yes" => "true"
			),
      "description" => esc_html__("Do you want to link the Instagram photos to instagram.com website?", 'north')
	  )
	),
	"description" => esc_html__("Add Instagram Photos", 'north')
) );

// Image shortcode
vc_map( array(
	"name" => "Look Book",
	"base" => "thb_lookbook",
	"icon" => "thb_vc_ico_lookbook",
	"class" => "thb_vc_sc_lookbook",
	"category" => esc_html__('by Fuel Themes', 'north'),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__("Select Image", 'north'),
			"param_name" => "image"
		),
		array(
	    "type" => "loop",
	    "heading" => esc_html__("Select Products", 'north'),
	    "param_name" => "source",
	    "description" => esc_html__("Set your products to show on hover", 'north')
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__("Full Width?", 'north'),
			"param_name" => "full_width",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__("If selected, the image will always fill its container", 'north')
		),
		$thb_animation_array
	),
	"description" => esc_html__("Add a Look Book element", 'north')
) );

// Play Button
vc_map( array(
	"name" => esc_html__("Play Button", 'north'),
	"base" => "thb_play",
	"icon" => "thb_vc_ico_play",
	"class" => "thb_vc_sc_play",
	"category" => esc_html__("by Fuel Themes", 'north'),
	"show_settings_on_create" => false,
	"description" => esc_html__("For Row Video Backgrounds", 'north')
) );

// Products
vc_map( array(
	"name" => esc_html__("Products", 'north'),
	"base" => "thb_product",
	"icon" => "thb_vc_ico_product",
	"class" => "thb_vc_sc_product",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Product Sort", "north"),
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
					'Featured Products' => "featured-products",
	      	'Sale Products' => "sale-products",
	      	'By Category' => "by-category",
	      	'By Product ID' => "by-id",
	      	),
	      "description" => esc_html__("Select the order of the products you'd like to show.", "north")
	  ),
	  array(
	      "type" => "checkbox",
	      "heading" => esc_html__("Product Category", "north"),
	      "param_name" => "cat",
	      "value" => thb_productCategories(),
	      "description" => esc_html__("Select the order of the products you'd like to show.", "north"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product IDs", "north"),
	      "param_name" => "product_ids",
	      "description" => esc_html__("Enter the products IDs you would like to display seperated by comma", "north"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Carousel", "north"),
	      "param_name" => "carousel",
	      "value" => array(
	      	'Yes' => "yes",
	      	'No' => "no"
	      ),
	      "description" => esc_html__("Select yes to display the products in a carousel.", "north")
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Number of Items", "north"),
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => esc_html__("The number of products to show.", "north"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Columns", "north"),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => esc_html__("Select the layout of the products.", "north")
	  ),
	),
	"description" => esc_html__("Add WooCommerce products", "north")
) );

// Product List
vc_map( array(
	"name" => esc_html__("Product List", 'north'),
	"base" => "thb_product_list",
	"icon" => "thb_vc_ico_product_list",
	"class" => "thb_vc_sc_product_list",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params"	=> array(
		array(
		    "type" => "textfield",
		    "heading" => esc_html__("Title", "north"),
		    "param_name" => "title",
		    "admin_label" => true,
		    "description" => esc_html__("Title of the widget", "north")
		),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Product Sort", "north"),
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
	      	'Sale Products' => "sale-products",
	      	'By Product ID' => "by-id"
	      ),
	      "admin_label" => true,
	      "description" => esc_html__("Select the order of the products you'd like to show.", "north")
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Product IDs", "north"),
	      "param_name" => "product_ids",
	      "description" => esc_html__("Enter the products IDs you would like to display seperated by comma", "north"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__("Number of Items", "north"),
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => esc_html__("The number of products to show.", "north"),
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers'))
	  )
	),
	"description" => esc_html__("Add WooCommerce products in a list", "north")
) );

// Shop Grid
vc_map( array(
	"name" => esc_html__("Product Category Grid", 'north'),
	"base" => "thb_product_category_grid",
	"icon" => "thb_vc_ico_grid",
	"class" => "thb_vc_sc_grid",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params"	=> array(
		array(
		  "type" => "checkbox",
		  "heading" => esc_html__("Product Category", "north"),
		  "param_name" => "cat",
		  "value" => thb_productCategories(),
		  "description" => esc_html__("Select the categories you would like to display", "north")
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__("Style", "north"),
		  "param_name" => "style",
		  "admin_label" => true,
		  "value" => array(
				'Style 1' => "style1",
				'Style 2' => "style2",
				'Style 3' => "style3"
		  ),
		  "description" => esc_html__("This applies different grid structures", "north")
		)
	),
	"description" => esc_html__("Display Product Category Grid", "north")
) );

// Product Categories
vc_map( array(
	"name" => esc_html__("Product Categories", 'north'),
	"base" => "thb_product_categories",
	"icon" => "thb_vc_ico_product_categories",
	"class" => "thb_vc_sc_product_categories",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params"	=> array(
	  array(
	      "type" => "checkbox",
	      "heading" => esc_html__("Product Category", "north"),
	      "param_name" => "cat",
	      "value" => thb_productCategories(),
	      "description" => esc_html__("Select the categories you would like to display", "north")
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Columns", "north"),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => esc_html__("Select the layout of the products.", "north")
	  ),
	),
	"description" => esc_html__("Add WooCommerce product categories", "north")
) );

// Posts
vc_map( array(
	"name" => esc_html__("Posts", 'north'),
	"base" => "thb_post",
	"icon" => "thb_vc_ico_post",
	"class" => "thb_vc_sc_post",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params"	=> array(
	  array(
	      "type" => "loop",
	      "heading" => esc_html__("Post Source", 'north'),
	      "param_name" => "source",
	      "description" => esc_html__("Set your post source here", 'north')
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Columns", "north"),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'3 Columns' => "3",
	      	'4 Columns' => "4"
	      ),
	      "description" => esc_html__("Select the layout of the posts.", "north")
	  ),
	),
	"description" => esc_html__("Display Posts from your blog", "north")
) );

// Subscription shortcode
vc_map( array(
	"name" => __("Subscription Form", 'north'),
	"base" => "thb_subscribe",
	"icon" => "thb_vc_ico_subscribe",
	"class" => "thb_vc_sc_subscribe",
	"category" => "by Fuel Themes",
	"show_settings_on_create" => false,
	"description" => esc_html__("Add a subscription form", "north")
) );

// Team Member shortcode
vc_map( array(
	"name" => esc_html__("Team Member", "north"),
	"base" => "thb_teammember",
	"icon" => "thb_vc_ico_teammember",
	"class" => "thb_vc_sc_teammember",
	"category" => esc_html__("by Fuel Themes", "north"),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__("Select Team Member Image", "north"),
			"param_name" => "image",
			"description" => esc_html__("Minimum size is 270x270 pixels", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Name", "north"),
		  "param_name" => "name",
		  "admin_label" => true,
		  "description" => esc_html__("Enter name of the team member", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Position", "north"),
		  "param_name" => "position",
		  "description" => esc_html__("Enter position/title of the team member", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Facebook", "north"),
		  "param_name" => "facebook",
		  "description" => esc_html__("Enter Facebook Link", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Twitter", "north"),
		  "param_name" => "twitter",
		  "description" => esc_html__("Enter Twitter Link", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Pinterest", "north"),
		  "param_name" => "pinterest",
		  "description" => esc_html__("Enter Pinterest Link", "north")
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__("Linkedin", "north"),
		  "param_name" => "linkedin",
		  "description" => esc_html__("Enter Linkedin Link", "north")
		)
	),
	"description" => esc_html__("Display your team members in a stylish way", "north")
) );

// Testimonial Parent
vc_map( array(
	"name" => esc_html__("Testimonial Slider", "north"),
	"base" => "thb_testimonial_parent",
	"icon" => "thb_vc_ico_testimonial",
	"class" => "thb_vc_sc_testimonial",
	"content_element"	=> true,
	"category" => esc_html__("by Fuel Themes", "north"),
	"as_parent" => array('only' => 'thb_testimonial'),
	"params"	=> array(
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__("Style", "north"),
		    "param_name" => "thb_style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "testimonial-style1",
		    	'Style 2' => "testimonial-style2"
		    ),
		    "description" => esc_html__("This changes the layout style of the testimonials", "north")
		)
	),
	"description" => esc_html__("Testimonials Slider", "north"),
	"js_view" => 'VcColumnView'
) );
vc_map( array(
	"name" => esc_html__("Testimonial", "north"),
	"base" => "thb_testimonial",
	"icon" => "thb_vc_ico_testimonial",
	"class" => "thb_vc_sc_testimonial",
	"category" => esc_html__("by Fuel Themes", "north"),
	"as_child" => array('only' => 'thb_testimonial_parent'),
	"params"	=> array(
		array(
			'type'           => 'textarea',
			'heading'        => esc_html__( 'Quote', "north" ),
			'param_name'     => 'quote',
			'description'    => esc_html__( 'Quote you want to show', "north" ),
		),
		array(
		'type'           => 'textfield',
			'heading'        => esc_html__( 'Author', "north" ),
			'param_name'     => 'author_name',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Name of the member.', "north" ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Author Title', "north" ),
			'param_name'     => 'author_title',
			'description'    => esc_html__( 'Title that will appear below author name.', "north" ),
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Author Image', "north" ),
			'param_name'     => 'author_image',
			'description'    => esc_html__( 'Add Author image here. Could be used depending on style.', "north" )
		)
	),
	"description" => esc_html__("Single Testimonial", "north")
) );
class WPBakeryShortCode_thb_testimonial_parent extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_thb_testimonial extends WPBakeryShortCode {}

/* Revolution Slider */
vc_add_param("rev_slider_vc", array(
	"type" => "checkbox",
	"heading" => esc_html__("Affect Header Colors", 'north'),
	"param_name" => "thb_revslider_affect_headers",
	'weight' => 1,
	"value" => array(
		"Yes" => "thb_revslider_affect_headers"
	),
	"description" => esc_html__("If enabled, this slider will affect header colors. Please make sure that every slide has an image background.", 'north')
));