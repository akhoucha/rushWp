<?php function thb_subscribe( $atts, $content = null ) {
	$style = 'style1';
  $atts = vc_map_get_attributes( 'thb_subscribe', $atts );
  extract( $atts );
 	ob_start();
 	
 	?>
 	<div class="thb_subscribe">
		<form class="newsletter-form" action="#" method="post">   
			<input placeholder="<?php esc_attr_e("Your E-Mail",'north'); ?>" type="text" name="widget_subscribe" class="widget_subscribe large">
			<input type="submit" name="submit" class="widget_subscribe_btn" value="&rarr;" />
		</form>
		<div class="result"></div>
	</div>
	<?php
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
  return $out;
}
thb_add_short('thb_subscribe', 'thb_subscribe');