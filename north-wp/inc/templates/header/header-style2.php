<?php 
$logo = ot_get_option('logo', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/logo-light.png');
$logo_dark = ot_get_option('logo_dark', Thb_Theme_Admin::$thb_theme_directory_uri.'assets/img/logo-dark.png');

$row_classes[] = "row align-center";
$row_classes[] = ot_get_option('header_fullwidth', 'off') == 'on' ? 'full-width-row' : '';
?>
<header class="header style2">
	<div class="<?php echo implode(' ', $row_classes); ?>">
		<div class="small-3 columns hide-for-large toggle-holder">
			<a href="#" class="mobile-toggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="small-6 large-8 columns logo-and-menu">
			<div class="logo-holder">
				<a href="<?php echo esc_url(home_url()); ?>" class="logolink">
					<img src="<?php echo esc_attr($logo); ?>" class="logoimg bg--light" alt="<?php bloginfo('name'); ?>"/>
					<img src="<?php echo esc_attr($logo_dark); ?>" class="logoimg bg--dark" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
			<div class="menu-holder">
				<nav id="nav">
					<?php if (has_nav_menu('nav-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 4, 'container' => false, 'menu_class' => 'thb-full-menu', 'walker' => new thb_MegaMenu  ) ); ?>
					<?php } ?>
				</nav>
			</div>
		</div>
		<div class="small-3 large-4 columns account-holder">
			<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false, 'menu_class' => 'secondary-menu' ) ); ?>
			<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false, 'menu_class' => 'secondary-menu' ) ); ?>
			<?php } ?> 
			<?php do_action( 'thb_quick_search' ); ?>
			<?php do_action( 'thb_quick_cart' ); ?>
		</div>
	</div>
</header>