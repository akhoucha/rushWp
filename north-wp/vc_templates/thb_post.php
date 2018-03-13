<?php function thb_post( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_post', $atts );
   extract( $atts );
    
	$posts = vc_build_loop_query($source);
	$posts = $posts[1];
 	
 	ob_start();
	?>
	<div class="row posts-shortcode align-stretch">
		<?php if ($posts->have_posts()) :  while ($posts->have_posts()) : $posts->the_post(); ?>
			<?php 
				set_query_var( 'columns', $columns );
				get_template_part( 'inc/templates/blogbit/style1'); 
			?>
		<?php endwhile; else : endif; ?>
	</div>
	<?php

 $out = ob_get_clean();
 
 wp_reset_query();
 wp_reset_postdata();
  
 return $out;
}
thb_add_short('thb_post', 'thb_post');