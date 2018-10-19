<?php
/**
 * Theme functions
 */

/*--------------------------------------------------
* Content Width
*--------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 640;

/*--------------------------------------------------
* Theme Setup
*--------------------------------------------------*/
if ( ! function_exists( 'photolistic_setup' ) ):

function photolistic_setup() {

	add_editor_style();
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_custom_background();

	// register default header
	register_default_headers( array(
		'mountains' => array(
			'url' => '%s/images/headers/mountains.jpg',
			'thumbnail_url' => '%s/images/headers/mountains-thumbnail.jpg',
			'description' => __( 'Mountains', 'photolistic' )
		)
		)
	);

	/*--------------------------------------------------
   * Menus
   *--------------------------------------------------*/
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'photolistic' ),
	) );

}
endif;
add_action( 'after_setup_theme', 'photolistic_setup' );

/*--------------------------------------------------
* Translation
*--------------------------------------------------*/
load_theme_textdomain( 'photolistic', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/*--------------------------------------------------
* Customization
*--------------------------------------------------*/

	if ( ! defined( 'HEADER_TEXTCOLOR' ) ) define( 'HEADER_TEXTCOLOR', '' );
	if ( ! defined( 'HEADER_IMAGE' ) ) define( 'HEADER_IMAGE', '%s/images/headers/mountains.jpg' );
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'photolistic_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'photolistic_header_image_height', 350 ) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	add_custom_image_header( '', 'photolistic_admin_header_style' );

if ( ! function_exists( 'photolistic_admin_header_style' ) ) :
	// Styles the header image displayed on the Appearance > Header admin panel.
	function photolistic_admin_header_style() {
	?>
	<style type="text/css">
	/* Shows the same border as on front end */
	#headimg {
		border-bottom: 1px solid #000;
		border-top: 4px solid #000;
	}
	</style>
	<?php
	}
endif;

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function photolistic_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'photolistic_page_menu_args' );

/*--------------------------------------------------
* Theme Helpers & tags
*--------------------------------------------------*/
function photolistic_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'photolistic_excerpt_length' );

// Continue reading
function photolistic_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'photolistic' ) . '</a>';
}

// replaces .. with ellipsis
function photolistic_auto_excerpt_more( $more ) {
	return ' &hellip;' . photolistic_continue_reading_link();
}
add_filter( 'excerpt_more', 'photolistic_auto_excerpt_more' );

// Adds a custom read more to excerpts
function photolistic_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= photolistic_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'photolistic_custom_excerpt_more' );

/*--------------------------------------------------
* Gallery
*--------------------------------------------------*/

// Remove inline styles gallery
add_filter( 'use_default_gallery_style', '__return_false' );

//  Deprecated way to remove inline styles printed when the gallery shortcode is used.
function photolistic_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'photolistic_remove_gallery_css' );

/*--------------------------------------------------
* Includes
*--------------------------------------------------*/

include get_template_directory() . '/lib/pl-theme-tags.php';
if(is_admin()) require_once('lib/pl-theme-settings-basic.php');

/*--------------------------------------------------
* Widgets
*--------------------------------------------------*/
function photolistic_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'photolistic' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'photolistic' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'photolistic' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'photolistic' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'photolistic' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'photolistic' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'photolistic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running photolistic_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'photolistic_widgets_init' );

// Removes the default styles that are packaged with the Recent Comments widget.
function photolistic_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'photolistic_remove_recent_comments_style' );

/*--------------------------------------------------
* Theme Options
*--------------------------------------------------*/

function photolistic_get_global_options(){

	$photolistic_option = array();

	$photolistic_option = get_option('photolistic_options');

	if ($photolistic_option === false)
	{
		$photolistic_option['photolistic_featured_txt'] = 'You can change this text in the <a href="wp-admin/themes.php?page=pl-settings">Theme Options.</a>';
		$photolistic_option['photolistic_featured_posts_nr'] = 3;
	}

return $photolistic_option;
}

$photolistic_option = photolistic_get_global_options();
