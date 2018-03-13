<?php function thb_selection() {
	$id = get_queried_object_id();
	ob_start();
?>
/* Options set in the admin page */
<?php if ($menu_margin = ot_get_option('menu_margin')) { ?>
.thb-full-menu>li+li {
	margin-left: <?php thb_measurementecho($menu_margin); ?>	
}
<?php } ?>

/* Logo Height */
<?php if ($logo_height = ot_get_option('logo_height')) { ?>
.header .logolink .logoimg {
	max-height: <?php thb_measurementecho($logo_height); ?>;	
}
<?php } ?>
<?php if ( thb_wc_supported() ) { ?>
	<?php if (is_shop() || is_product_tag() ) { ?>
		<?php if ($shop_header_bg = ot_get_option('shop_header_bg')) { ?>
			.post-type-archive-product .shop-header-style2,
			.tax-product_tag .shop-header-style2 {
				<?php thb_bgecho($shop_header_bg); ?>	
			}
		<?php } ?>
	<?php } else if ( is_product_category() ) { 
		$cat = get_queried_object();
		$cat_id = $cat->term_id;
		$header_id = get_term_meta( $cat_id, 'header_id', true );
		
		$image = wp_get_attachment_url($header_id, 'full');
	?>
		.tax-product_cat.term-<?php echo esc_attr($cat_id); ?> .shop-header-style2 {
			background-image: url(<?php echo esc_url($image); ?>);	
		}
	<?php } ?>
<?php } ?>

/* Typography */
<?php if ($title_type = ot_get_option('title_type')) { ?>
h1,h2,h3,h4,h5,h6 {
	<?php thb_typeecho($title_type, false); ?>
}
<?php } ?>
<?php if ($body_type = ot_get_option('body_type')) { ?>
body,
p {
	<?php thb_typeecho($body_type, false); ?>		
}
<?php } ?>
<?php if ($menu_left_type = ot_get_option('menu_left_type')) { ?>
.thb-full-menu {
	<?php thb_typeecho($menu_left_type); ?>		
}
<?php } ?>
<?php if ($menu_left_submenu_type = ot_get_option('menu_left_submenu_type')) { ?>
.thb-full-menu .sub-menu {
	<?php thb_typeecho($menu_left_submenu_type); ?>		
}
<?php } ?>
<?php if ($menu_right_type = ot_get_option('menu_right_type')) { ?>
.account-holder {
	<?php thb_typeecho($menu_right_type); ?>		
}
<?php } ?>
<?php if ($menu_mobile_type = ot_get_option('menu_mobile_type')) { ?>
.mobile-menu {
	<?php thb_typeecho($menu_mobile_type); ?>		
}
<?php } ?>
<?php if ($menu_mobile_submenu_type = ot_get_option('menu_mobile_submenu_type')) { ?>
.mobile-menu .sub-menu {
	<?php thb_typeecho($menu_mobile_submenu_type); ?>		
}
<?php } ?>
<?php if ($menu_mobile_secondary_type = ot_get_option('menu_mobile_secondary_type')) { ?>
.mobile-secondary-menu {
	<?php thb_typeecho($menu_mobile_secondary_type); ?>		
}
<?php } ?>
<?php if ($button_type = ot_get_option('button_type')) { ?>
.btn, .button, input[type=submit], button {
	<?php thb_typeecho($button_type); ?>		
}
<?php } ?>
/* Backgrounds */
<?php if ($header_bg = ot_get_option('header_bg')) { ?>
.header.hover, 
.header:hover {
	<?php thb_bgecho($header_bg); ?>
}
<?php } ?>
<?php if ($footer_bg = ot_get_option('footer_bg')) { ?>
.footer {
	<?php thb_bgecho($footer_bg); ?>
}
<?php } ?>
/* Extra CSS */
<?php 
echo ot_get_option('extra_css');
?>
<?php 
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	// Remove comments
	$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
	// Remove space after colons
	$out = str_replace(': ', ':', $out);
	// Remove whitespace
	$out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $out);
	
	return $out;
}