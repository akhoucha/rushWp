<!-- Start Mobile Menu -->
<nav id="mobile-menu" class="side-panel">
	<header>
		<h6><?php esc_html_e('Menu','north'); ?></h6>
		<a href="#" class="thb-close" title="<?php esc_attr_e('Close', 'north'); ?>"><?php get_template_part('assets/img/svg/close.svg'); ?></a>
	</header>
	<div class="side-panel-content custom_scroll">
		<?php if(has_nav_menu('mobile-menu')) { ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
		<?php } ?>
		<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false, 'menu_class' => 'mobile-secondary-menu', 'walker' => new thb_mobileDropdown ) ); ?>
		<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false, 'menu_class' => 'mobile-secondary-menu', 'walker' => new thb_mobileDropdown ) ); ?>
		<?php } ?> 
		<div class="social-links">
			<?php do_action( 'thb_social' ); ?>
		</div>
	</div>
</nav>
<!-- End Mobile Menu -->