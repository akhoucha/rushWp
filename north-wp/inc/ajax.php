<?php
function thb_blog_posts() {
	$page = isset($_POST['page']) ? wp_unslash($_POST['page']) : "1";  
	$ppp = get_option('posts_per_page');
	$blog_style = ot_get_option('blog_style', 'style3');
	
	$args = array(
		'posts_per_page'	 => $ppp,
		'paged' => $page,
		'post_status' => 'publish'
	);

	$more_query = new WP_Query( $args );
		
	if ($more_query->have_posts()) :  while ($more_query->have_posts()) : $more_query->the_post(); 
		get_template_part( 'inc/templates/blogbit/'.$blog_style); 
	endwhile; else : endif;
	wp_die();
}
add_action("wp_ajax_nopriv_thb_blog_ajax", "thb_blog_posts");
add_action("wp_ajax_thb_blog_ajax", "thb_blog_posts");

function thb_quick_shop_ajax() {
	$term_slug = isset($_POST['term_slug']) ? wp_unslash($_POST['term_slug']) : ""; 
	$quick_shop_count = ot_get_option('quick_shop_count', 8);

	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => $quick_shop_count,
		'no_found_rows' => true
	);
	
	if ($term_id !== '') {
		$args['product_cat'] = $term_slug;
	}
	
	$quick_products = new WP_Query( $args );
	set_query_var( 'thb_columns', 'medium-6');
	if ($quick_products->have_posts()) :  while ($quick_products->have_posts()) : $quick_products->the_post();
	wc_get_template_part( 'content', 'product' );
	endwhile; else : endif; 
	remove_query_arg( 'thb_columns' );
	wp_die();
}

add_action("wp_ajax_nopriv_thb_quick_shop_ajax", "thb_quick_shop_ajax");
add_action("wp_ajax_thb_quick_shop_ajax", "thb_quick_shop_ajax");


function thb_ajax_search_products() {
	$search_keyword = wp_unslash($_REQUEST['query']);
	$time_start = microtime();
	$product_visibility_term_ids = wc_get_product_visibility_term_ids();
	$ordering_args = WC()->query->get_catalog_ordering_args( 'title', 'asc' );
	$suggestions = array();
	
	$args = array(
	  's'                   => $search_keyword,
	  'post_type'           => 'product',
	  'post_status'         => 'publish',
	  'ignore_sticky_posts' => 1,
	  'posts_per_page'      => 9,
	  'orderby'             => $ordering_args['orderby'],
	  'order'               => $ordering_args['order'],
	  'tax_query' => array(
	  	'taxonomy' => 'product_visibility',
	  	'field'    => 'term_taxonomy_id',
	  	'terms'    => $product_visibility_term_ids['exclude-from-search'],
	  	'operator' => 'NOT IN'
	  )
	);

	$products = get_posts( $args );
	
  if ( ! empty( $products ) ) {
    foreach ( $products as $post ) {
      $product = wc_get_product( $post );

      $suggestions[] = array(
        'id'    => $product->get_id(),
        'value' => strip_tags( $product->get_title() ),
        'url'   => $product->get_permalink(),
        'thumbnail' => $product->get_image(),
        'price' => $product->get_price_html()
      );
    }
  } else {
    $suggestions[] = array(
      'id'    => -1,
      'value' => esc_html__( 'No results', 'north' ),
      'url'   => '',
      'thumbnail' => '',
      'price' => ''
    );
  }
	
	$time_end = microtime();
	$time = $time_end - $time_start;
  $suggestions = array(
    'suggestions' => $suggestions,
    'time'        => $time
  );
  echo json_encode( $suggestions );
	wp_die();
}

add_action("wp_ajax_nopriv_thb_ajax_search_products", "thb_ajax_search_products");
add_action("wp_ajax_thb_ajax_search_products", "thb_ajax_search_products");


/* Email Subscribe */
add_action("wp_ajax_nopriv_thb_subscribe_emails", "thb_subscribe_emails");
add_action("wp_ajax_thb_subscribe_emails", "thb_subscribe_emails");
function thb_subscribe_emails() {
	// the email
	$email = isset($_POST['email']) ? wp_unslash($_POST['email']) : '';

	//if the email is valid
	if (is_email($email)) {
		
		//get all the current emails
		$stack = get_option('subscribed_emails');
		
		//if there are no emails in the database
		if (!$stack) {
			//update the option with the first email as an array
			update_option('subscribed_emails', array($email));	
		} else {
			//if the email already exists in the array
			if( in_array($email, $stack) ) {
				echo '<div class="woocommerce-error">'.__('<strong>Oh snap!</strong> That email address is already subscribed!', 'north').'</div>';
			} else {
				
				// If there is more than one email, add the new email to the array
				array_push($stack, $email);
				
				//update the option with the new set of emails
				update_option('subscribed_emails', $stack);

				echo '<div class="woocommerce-message">'. __("<strong>Well done!</strong> Your address has been added", 'north').'</div>';
			}
		}
	} else {
		echo '<div class="woocommerce-error">'.__("<strong>Oh snap!</strong> Please enter a valid email address", 'north').'</div>';
	}
	wp_die();
}