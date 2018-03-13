	</div>
</div><!-- #container -->
<div id="footer">
	<div class="pads">
		<ul id="menu-bottom" class="clearfix">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer'))?>
		</ul>
	</div>
	<div class="footerlinks">
<!-- #ici code -->
	</div>
</div><!-- #footer -->
<?php wp_footer() ?> <!-- #NE PAS SUPPRIMER cf. codex wp_footer() -->
</body>
</html>