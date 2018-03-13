<?php function thb_play( $atts, $content = null ) {
	ob_start();
	$out = '';
	?>
	<a class="thb_video_play" href="#"><?php get_template_part('assets/img/svg/play_pause.svg'); ?></a>
	
	<?php
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	return $out;
}
thb_add_short('thb_play', 'thb_play');