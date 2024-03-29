<?php $blog_pagination_style = is_home() ? ot_get_option('blog_pagination_style', 'style1') : 'style1'; ?>
<div class="row align-center">
	<div class="small-12 medium-10 large-9 columns <?php echo esc_attr('pagination-'.$blog_pagination_style); ?>">
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'inc/templates/blogbit/style3'); ?>
		<?php endwhile; else : ?>
		  <?php get_template_part( 'inc/templates/not-found' ); ?>
		<?php endif; ?>
	</div>
</div>
<?php do_action('thb_blog_pagination'); ?>