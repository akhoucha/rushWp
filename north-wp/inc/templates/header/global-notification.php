<?php 
$global_notification = ot_get_option('global_notification', 'on');
$cookie = isset($_COOKIE['thb-global-notification']) ? wp_unslash($_COOKIE['thb-global-notification']) : false;
	if ($global_notification === 'on' && !$cookie) {
?>
	<aside class="thb-global-notification">
		<div class="row">
			<div class="small-12 columns">
				<?php echo do_shortcode(ot_get_option('global_notification_content')); ?>
			</div>
		</div>
		<a href="#" class="thb-notification-close"><?php get_template_part('assets/img/svg/close.svg'); ?></a>
	</aside>
<?php 
	}
?>