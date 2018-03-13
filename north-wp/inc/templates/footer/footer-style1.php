<?php
	$row_classes[] = "row";
	$row_classes[] = ot_get_option('footer_fullwidth', 'off') == 'on' ? 'full-width-row' : '';
?>
<footer class="footer style1">
	<div class="<?php echo implode(' ', $row_classes); ?>">
		<div class="small-12 medium-6 columns footer-left-side">
			<?php if (has_nav_menu('footer-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'thb-footer-menu' ) ); ?>
			<?php } ?>
			<div class="thb-footer-copyright">
				<?php echo do_shortcode(ot_get_option('copyright')); ?>
			</div>
		</div>
		<div class="small-12 medium-6 columns footer-right-side">
			<?php do_action('thb_footer_social'); ?>
			<?php do_action('thb_footer_payment'); ?>
		</div>
	</div>
</footer>