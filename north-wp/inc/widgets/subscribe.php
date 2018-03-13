<?php
// thb Subscribe Widget
class thb_subscribe_widget extends WP_Widget {
	
	function __construct() {
		
		$widget_ops = array(
			'classname'   => 'widget_subscribe_widget',
			'description' => __('A widget that gathers email addresses.','north')
		);
	
		parent::__construct(
			'thb_subscribe_widget',
			__( 'Fuel Themes - Subscribe Widget' , 'north' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => '', 'desc' => '' );
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$desc = $instance['desc'];

		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');

		?>
                
    <p><?php echo esc_html($desc); ?></p>

    <div class="thb_subscribe">
    	<form class="newsletter-form" action="#" method="post">   
    		<input placeholder="<?php esc_attr_e("Your E-Mail",'north'); ?>" type="text" name="widget_subscribe" class="widget_subscribe large">
    		<input type="submit" name="submit" class="widget_subscribe_btn" value="&rarr;" />
    	</form>
    	<div class="result"></div>
    </div>
		
		<?php

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );

		return $instance;
	}
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Widget Title:', 'north'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php esc_html_e('Short Description:', 'north'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
		</p>
		
		<?php if (current_user_can( 'manage_options' )) { ?>
			<p>
				<a href="?thb_download_emails=true" class="button button-primary"><?php esc_html_e('Download Emails', 'north'); ?></a>
			</p>
		<?php } ?>
	<?php
	}
}
add_action( 'widgets_init', 'thb_subscribe_widgets' );

function thb_subscribe_widgets() {
	register_widget( 'thb_subscribe_widget' );
}