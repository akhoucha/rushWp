<?php

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Main Menu' ),
		));
}

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 150, true ); // Normal post thumbnails

add_custom_background();

// Custom comment listing
function wpbx_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$commenter = get_comment_author_link();
	if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
		$commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	} else {
		$commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
    $avatarURL = get_bloginfo('template_directory');
	$avatar = str_replace( "class='avatar", "class='avatar", get_avatar( $avatar_email, 40, $default = $avatarURL . '/images/gravatar-blank.jpg' ) );
?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo $avatar . ' <span class="fn n">' . $commenter . '</span>'; ?>
			</div>
			<div class="comment-meta">
				<?php printf(__('%1$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'wpbx'),
					get_comment_date('j M Y', '', '', false),
					get_comment_time(),
					'#comment-' . get_comment_ID() );
					edit_comment_link(__('Edit', 'wpbx'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>');
				?>
				<span class="reply-link">
					<span class="meta-sep">|</span> <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</span>
			</div>

			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'wpbx') ?>

			<div class="comment-content"><?php comment_text() ?></div>
		</div>
<?php
}
// wpbx_comment()

// For category lists on category archives: Returns other categories except the current one (redundant)
function wpbx_cat_also_in($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function wpbx_tag_also_in($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
}

// Generate custom excerpt length
function wpbx_excerpt_length($length) {
	return 75;
}
add_filter('excerpt_length', 'wpbx_excerpt_length');


// Widgets plugin: intializes the plugin after the widgets above have passed snuff
function wpbx_widgets_init() {
	if ( !function_exists('register_sidebars') ) {
		return;
	}
	// Formats the theme widgets, adding readability-improving whitespace
	$p = array(
		'before_widget'  =>   '<li id="%1$s" class="widget %2$s">',
		'after_widget'   =>   "</li>\n",
		'before_title'   =>   '<h3 class="widget-title">',
		'after_title'    =>   "</h3>\n"
	);
	register_sidebars( 1, $p );

	  if ( function_exists('register_sidebar') )
	      register_sidebar( array(
	       'name' 		=> __( 'Footer', 'virtue' ),
	       'id'		=> 'footer',
	       'before_widget' => '<aside id="%1$s" class="newsL %2$s">',
	       'after_widget'  => '</aside>',
	       'before_title'  => '<h3>',
	       'after_title'   => '</h3>',
	     )
	   );
	
} // ici on ferme la fonction function wpbx_widgets_init()

    // On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments


function create_post_type() {
 register_post_type( 'room',
   array(
   'labels' => array(
       'name' => __( 'Room' ),
       'singular_name' => __( 'Room' )
       ),
     'public' => true,
     'supports' => array( 'title', 'description', 'comments', 'thumbnail', 'location' )
   )
 );
	
    register_taxonomy(
    'location',
    'room',
    array(
        'label' => 'Location',
        'labels' => array(
            'name' => 'Location',
            'singular_name' => 'Location',
            'all_items' => 'Tous les Location',
            'edit_item' => 'Éditer le Location',
            'view_item' => 'Voir le Location',
            'update_item' => 'Mettre à jour le Location',
            'add_new_item' => 'Ajouter un Location',
            'new_item_name' => 'Nouveau Location',
            'search_items' => 'Rechercher parmi les Location',
            'popular_items' => 'Location les plus utilisés'
            ),
        'hierarchical' => true
        )
    );
    
    register_taxonomy_for_object_type( 'location', 'room' );
}



function prix_ma_meta_function($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  $val = get_post_meta($post->ID,'_ma_valeur_prix',true);
  echo '<label for="mon_champ">Prix par nuit € : </label>';
  echo '<input id="mon_champ" type="number" name="prix" value="'.$val.'" />';
}
function dispo_produit($post){
  $dispo = get_post_meta($post->ID,'_dispo_produit', true);
  echo '<label for="dispo_meta">selectionnez :</label>';
  echo '<select name="dispo_produit">';
  echo '<option ' . selected( 'maison', $dispo, false) . ' value="maison">maison</option>';
  echo '<option ' . selected( 'appartement', $dispo, false) . ' value="appartement">appartement</option>';
  echo '</select>';
}

function check($cible,$test){
  if(in_array($test,$cible)){return ' checked="checked" ';}
}
function equipements($post){
  $cond = get_post_meta($post->ID,'_equipements',false);
  echo 'Indiquez les equipements :';
  echo '<label><input type="checkbox" ' . check( $cond, 1 ) . ' name="cond[]" value="1" /> Cuisine </label>';
  echo '<label><input type="checkbox" ' . check( $cond, 2 ) . ' name="cond[]" value="2" /> Chauffage </label>';
  echo '<label><input type="checkbox" ' . check( $cond, 3 ) . ' name="cond[]" value="3" /> Internet </label>';
 
}

function initialisation_metaboxes(){
  //on utilise la fonction add_metabox() pour initialiser une metabox
  add_meta_box('id_ma_meta_prix', 'Prix par nuit', 'prix_ma_meta_function', 'room', 'side', 'high');
	add_meta_box('dispo_produit', 'Type de propriété', 'dispo_produit', 'room', 'side','high');
	add_meta_box('equipements', 'equipements disponibles', 'equipements', 'room', 'side', 'high');
}

function save_metaboxes($post_ID){
  // si la metabox est définie, on sauvegarde sa valeur
  if(isset($_POST['prix'])){
    update_post_meta($post_ID,'_ma_valeur_prix', esc_html($_POST['prix']));
  }
  if(isset($_POST['dispo_produit'])){
  update_post_meta($post_ID, '_dispo_produit', $_POST['dispo_produit']);
  }
  if(isset($_POST['cond'])){
    // je supprime toutes les entrées pour cette meta
    delete_post_meta($post_ID, '_equipements');
    // et pour chaque conditionnement coché, j'ajoute une metadonnée
    foreach($_POST['cond'] as $c){
      add_post_meta($post_ID, '_equipements', intval($c));
    }
  }
}

add_action('add_meta_boxes','initialisation_metaboxes');
add_action('save_post','save_metaboxes');

// Runs our code at the end to check that everything needed has loaded
add_action( 'init', 'wpbx_widgets_init' );
add_action( 'init', 'create_post_type' );

// Adds filters for the description/meta content
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Translate, if applicable
load_theme_textdomain('wpbx');


// Construct the WordPress header
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'next_post_rel_link');
remove_action('wp_head', 'previous_post_rel_link');