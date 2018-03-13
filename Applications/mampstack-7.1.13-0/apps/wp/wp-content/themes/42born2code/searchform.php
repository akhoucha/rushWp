<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

		<input type="text" value="<?php _e("Où voulez-vous aller ?"); ?>" name="s" id="searchbox" onfocus="if (this.value == '<?php _e("Où voulez-vous aller ?"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Où voulez-vous aller ?"); ?>';}" />
		<input type="submit" id="searchsubmit" value="<?php _e("Rechercher"); ?>" />
</form>