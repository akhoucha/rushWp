<?php get_header() ?>
<div id="contentfull">
<?php the_post() //cf. codex the_post() ?>
	<div class="entry">
		<h2 class="page-title"><?php the_title()?></h2>
		<h5>
			Location: Rome
		</h5>
		<img src="<?php echo get_template_directory_uri(); ?>/images/filename.png">
		<div class="entry-content">
		<?php the_content() //cf. codex the_content() ?>
		<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
		</div>
	</div><!-- entry -->
<?php if ( get_post_custom_values('comments') ) comments_template() ?>
</div><!-- #content -->
		<?php the_post_thumbnail('large'); ?>
<?php echo category_description(); ?>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

<h5>
	Auteur:  <?php the_author() ?>
</h5>
<?php if ( get_post_custom_values('comments') ) comments_template() ?>
<?php get_footer() ?>


