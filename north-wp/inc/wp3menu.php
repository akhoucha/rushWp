<?php
/* Mega Menu */
add_filter( 'wp_setup_nav_menu_item', 'thb_add_custom_nav_fields' );
function thb_add_custom_nav_fields( $menu_item ) {

  $menu_item->menuicon = get_post_meta( $menu_item->ID, '_menu_item_menuicon', true );
  $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
  $menu_item->menuimage = get_post_meta( $menu_item->ID, '_menu_item_menuimage', true );
  $menu_item->titleitem = get_post_meta( $menu_item->ID, '_menu_item_titleitem', true );
  return $menu_item;
    
}

add_action( 'wp_update_nav_menu_item', 'thb_update_custom_nav_fields', 1, 3 );
function thb_update_custom_nav_fields( $menu_id, $menu_item_db_id, $menu_item_data ) {
  if (!empty($_REQUEST['edit-menu-item-menuicon']) && is_array( $_REQUEST['edit-menu-item-menuicon']) ) {
      $menu_icon_value = $_REQUEST['edit-menu-item-menuicon'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_menuicon', $menu_icon_value );
  }
  
	if (!isset($_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id])) {
	    $_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id] = '';
	}
	$menuimage_enabled_value = $_REQUEST['edit-menu-item-menuimage'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_menuimage', $menuimage_enabled_value );
	
	if (!isset($_REQUEST['edit-menu-item-titleitem'][$menu_item_db_id])) {
	    $_REQUEST['edit-menu-item-titleitem'][$menu_item_db_id] = '';
	}
	$titleitem_enabled_value = $_REQUEST['edit-menu-item-titleitem'][$menu_item_db_id];        
	update_post_meta( $menu_item_db_id, '_menu_item_titleitem', $titleitem_enabled_value );
	
  if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
      $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
      
  }
  $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
  update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
  
}

add_filter( 'wp_edit_nav_menu_walker', 'thb_edit_walker' );
function thb_edit_walker() {
   return 'thb_Nav_Menu_Edit'; 
}

/**
 * Custom Walker - Mobile Menu
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class thb_mobileDropdown extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class=" ' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'. (!empty($children) ? '<span></span>' : '');
		
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;


		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class thb_MegaMenu extends Walker_Nav_Menu {

  var $active_megamenu = 0;

  /**
   * @see Walker::start_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function start_lvl(&$output, $depth = 0, $args = array()) {
  		$menuimage_class = $args->menuimage != '' ? ' has_bg' : '';
  		$menuimage_style = $args->menuimage != '' ? 'style="background-image:url('.$args->menuimage.');"' : '';
  		
      $indent = str_repeat("\t", $depth);
      
      $output .= "\n$indent<ul class=\"sub-menu".esc_attr($menuimage_class) . "\" ".$menuimage_style.">\n";
  }

  /**
   * @see Walker::end_lvl()
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function end_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul>\n";
      

      if ( $this->active_megamenu && $depth === 1) {
      	//$output = str_replace("{locate_class}", " thb_mega_menu", $output);
      } else {
      	//$output = str_replace("{locate_class}", "", $output);
      }
  }    

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
      $item_output = $column_class = "";
      
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
      		
  		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
  		$classes[] = 'menu-item-' . $item->ID;
  		
  		
  		if($depth === 1 && $this->active_megamenu)  {
  			$classes[] = 'mega-menu-title';
  		}
  		/**
  		 * Filter the CSS class(es) applied to a menu item's list item element.
  		 *
  		 * @since 3.0.0
  		 * @since 4.1.0 The `$depth` parameter was added.
  		 *
  		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
  		 * @param object $item    The current menu item.
  		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
  		 * @param int    $depth   Depth of menu item. Used for padding.
  		 */
  		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
  		
      if($depth === 0) {   
          $this->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true);
          if($this->active_megamenu) { $class_names .= " menu-item-mega-parent "; }
      } else {
      		$class_names .= get_post_meta( $item->ID, '_menu_item_titleitem', true) === 'enabled' ? ' title-item' : '';
      }
      if($depth === 2) {   
          if($this->active_megamenu) { $class_names .= " menu-item-mega-link "; }  
      }
     
          
          
      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
      $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
      $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
      $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
      $menu_icon_tag  = ! empty( $item->menuicon ) ? '<i class="fa '.esc_attr( $item->menuicon ).'"></i>' : '';
      
      $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
      
      $attributes = '';
      foreach ( $atts as $attr => $value ) {
      	if ( ! empty( $value ) ) {
      		$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
      		$attributes .= ' ' . $attr . '="' . $value . '"';
      	}
      }
      		
      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';
      /** This filter is documented in wp-includes/post-template.php */
      $item_output .= $menu_icon_tag;
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;
      
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			
      $output .= $indent . '<li id="menu-item-'. $item->ID .'"' . $class_names .'>';
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      
      apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->menuimage = $item->menuimage );
  }
}

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class thb_Nav_Menu_Edit extends Walker_Nav_Menu  {
	
	var $thb_icons;
	
	function __construct() {
	    $this->thb_icons = thb_getIconArray();
	}
	
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output, $depth = 0, $args = array()) {  
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl(&$output, $depth = 0, $args = array()) {
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = false;
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}
		
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;
		
		if ( ! empty( $item->_invalid ) ) {
		    $classes[] = 'menu-item-invalid';
		    /* translators: %s: title of menu item which is invalid */
		    $title = sprintf( esc_html__( '%s (Invalid)', 'north'), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
		    $classes[] = 'pending';
		    /* translators: %s: title of menu item in draft status */
		    $title = sprintf( esc_html__('%s (Pending)', 'north'), $item->title );
		}
		
		$title = empty( $item->label ) ? $title : $item->label;
		
		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
				    <span class="item-title"><?php echo esc_html( $title ); ?></span>
				    <span class="item-controls">
				        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
				        <span class="item-order hide-if-js">
				            <a href="<?php
				                echo wp_nonce_url(
				                    add_query_arg(
				                        array(
				                            'action' => 'move-up-menu-item',
				                            'menu-item' => $item_id,
				                        ),
				                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
				                    ),
				                    'move-menu_item'
				                );
				            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'north'); ?>">&#8593;</abbr></a>
				            |
				            <a href="<?php
				                echo wp_nonce_url(
				                    add_query_arg(
				                        array(
				                            'action' => 'move-down-menu-item',
				                            'menu-item' => $item_id,
				                        ),
				                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
				                    ),
				                    'move-menu_item'
				                );
				            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','north'); ?>">&#8595;</abbr></a>
				        </span>
				        <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'north'); ?>" href="<?php
				            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
				        ?>"><?php esc_html_e( 'Edit Menu Item', 'north'); ?></a>
				    </span>
				</dt>
			</dl>
		
		  <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
		        <?php if( 'custom' == $item->type ) : ?>
		            <p class="field-url description description-wide">
		                <label for="edit-menu-item-url-<?php echo $item_id; ?>">
		                    <?php esc_html_e( 'URL', 'north' ); ?><br />
		                    <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
		                </label>
		            </p>
		        <?php endif; ?>
		        <p class="description description-thin">
		            <label for="edit-menu-item-title-<?php echo $item_id; ?>">
		                <?php esc_html_e( 'Navigation Label', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
		            </label>
		        </p>
		        <p class="description description-thin">
		            <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
		                <?php esc_html_e( 'Title Attribute', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
		            </label>
		        </p>
		        <p class="field-link-target description">
		            <label for="edit-menu-item-target-<?php echo $item_id; ?>">
		                <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
		                <?php esc_html_e( 'Open link in a new window/tab', 'north' ); ?>
		            </label>
		        </p>
		        <p class="field-css-classes description description-thin">
		            <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
		                <?php esc_html_e( 'CSS Classes (optional)', 'north' ); ?><br />
		                <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
		            </label>
		        </p>
		        <p class="field-xfn description description-thin">
		            <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
		                <?php esc_html_e( 'Link Relationship (XFN)', 'north'  ); ?><br />
		                <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
		            </label>
		        </p>
		        <p class="field-description description description-wide">
		            <label for="edit-menu-item-description-<?php echo $item_id; ?>">
		                <?php esc_html_e( 'Description', 'north' ); ?><br />
		                <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
		                <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'north'); ?></span>
		            </label>
		        </p>
		        <?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );?>
		
		        <div class="thb_menu_options">
							<p class="thb-field-link-mega description description-thin">
		          	<label for="edit-menu-item-megamenu-<?php echo $item_id; ?>">
		          		<?php esc_html_e( 'Mega Menu', 'north'  ); ?><br />
		              <?php 
		
		                  $value = get_post_meta( $item_id, '_menu_item_megamenu', true);
		                  if($value != "") $value = "checked='checked'";
		
		              ?>
                  <input type="checkbox" value="enabled" id="edit-menu-item-megamenu-<?php echo $item_id; ?>" name="edit-menu-item-megamenu[<?php echo $item_id; ?>]" <?php echo $value; ?> />
                  <?php esc_html_e( 'Enable', 'north'  ); ?>
	              </label>
		          </p>
		          <p class="thb-field-link-image description description-thin">
		          	<label for="edit-menu-item-menuimage-<?php echo $item_id; ?>">
		          		<?php esc_html_e( 'Mega Menu Background', 'north'  ); ?><br />
		              <?php $savedimage = get_post_meta( $item_id, '_menu_item_menuimage', true);?>
		              <input type="text" class="widefat code edit-menu-item-custom" id="edit-menu-item-menuimage-<?php echo $item_id; ?>" name="edit-menu-item-menuimage[<?php echo $item_id; ?>]" value="<?php echo $savedimage; ?>"/>
		             </label>
		          </p>
		          <p class="thb-field-link-title description description-thin">
              	<label for="edit-menu-item-titleitem-<?php echo $item_id; ?>">
              		<?php esc_html_e( 'Title', 'north'  ); ?><br />
                  <?php 
    
                      $value = get_post_meta( $item_id, '_menu_item_titleitem', true);
                      if($value != "") $value = "checked='checked'";
    
                  ?>
                  <input type="checkbox" value="enabled" id="edit-menu-item-titleitem-<?php echo $item_id; ?>" name="edit-menu-item-titleitem[<?php echo $item_id; ?>]" <?php echo $value; ?> />
                  <?php esc_html_e( 'Enable', 'north'  ); ?>
                </label>
              </p>
		          
		      </div>
		     
		     <fieldset class="field-move hide-if-no-js description description-wide">
		     	<span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'north' ); ?></span>
		     	<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'north' ); ?></button>
		     	<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'north' ); ?></button>
		     	<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
		     	<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
		     	<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'north' ); ?></button>
		     </fieldset>
		
		      <div class="menu-item-actions description-wide submitbox">
		          <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
		              <p class="link-to-original">
		                  <?php printf( esc_html__('Original: %s', 'north'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
		              </p>
		          <?php endif; ?>
		          <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
		          echo wp_nonce_url(
		              add_query_arg(
		                  array(
		                      'action' => 'delete-menu-item',
		                      'menu-item' => $item_id,
		                  ),
		                  remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
		              ),
		              'delete-menu_item_' . $item_id
		          ); ?>"><?php esc_html_e('Remove', 'north' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
		              ?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_html_e('Cancel', 'north'); ?></a>
		      </div>
		
		      <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
		      <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
		      <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
		      <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
		      <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
		      <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
		  </div><!-- .menu-item-settings-->
		  <ul class="menu-item-transport"></ul>
		<?php
		
		$output .= ob_get_clean();
	
	}
}