<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />

	<!--[if lte IE 6]><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/supersleight-min.js"></script><![endif]-->
<?php wp_enqueue_script(get_bloginfo('template_directory').'/js/jquery.js'); ?>
<?php wp_enqueue_script('superfish', get_bloginfo('template_directory').'/js/superfish.js', array('jquery'), '1.7'); ?>
<?php wp_enqueue_script(get_bloginfo('template_directory').'/js/nav.js'); ?>
<?php if (trim(get_option('ft_header_code')) <> "") { echo stripslashes(get_option('ft_header_code')); } ?>
<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

<?php wp_head(); ?> <!-- #NE PAS SUPPRIMER cf. codex wp_head() -->
</head>
<body <?php body_class() ?>>
<div id="header">
	<div class="pads clearfix">
		<div id="logobarre">
		<a href="<?php echo get_option('home'); ?>">
			<img id="site-logo" src="https://cdn.worldvectorlogo.com/logos/airbnb.svg" alt="<?php bloginfo('name'); ?>" />
			
			<?php if (!is_home()) { ?>
				<div id="researchtop">
					<div id="blocsearch"> <?php include('searchform.php'); ?></div>
				</div>
			<?php } ?>
		<div id="button">
			
			<?php if ( is_user_logged_in() ) {?>
				 <a href="/wp-login.php?action=logout&_wpnonce=d0625a7c53"><button id="deconnexion">
					deconnexion
				</button>
				</a>
			<?php } else { ?>
				 <a href="/wp-login?action=register"><button id="enregistrer">
					s'enregistrer
				</button>
				</a>
				<a href="/wp-login">
					<button id="connecter">
						connexion
					</button>
				</a>
			<?php } ?>
			<a>
			<button id="annonce">
				Publier votre annonce
			</button>
			</a>
			</div>
		</a>
		</div>
		
			<?php if (is_home()) { ?>
				<div id="blocsearch"> <?php include('searchform.php'); ?></div>
			<?php } ?>

		<div class="nav-wrap">
			<div id="nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'sort_column' => 'menu_order', 'container_class' => 'nav' ) ); ?>
			</div>
		</div>
		<div class="nav-wrap">
			<div id="nav">
				<a href="http://wp.local.42.fr:8080/?page_id=13">
				<button id="emploi">
					Mode d'emploi
				</button>
					</a>
			</div>
		</div>
	</div>
</div><!--  #header -->

<div id="container">
	<div class="pads clearfix">