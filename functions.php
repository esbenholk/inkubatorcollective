<?php
/**
 * inku functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package inku
 */

if ( ! function_exists( 'inku_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function inku_setup() {

	/*
	 * Defines Constant
	 */
	$inku_theme_data = wp_get_theme();
	define( 'inku_THEME_NAME', $inku_theme_data['Name'] );
	define( 'inku_THEME_VERSION', $inku_theme_data['Version'] );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on inku, use a find and replace
	 * to change 'inku' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'inku', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	//Blog
	add_image_size( 'inku_post', 525, 525, true );

	add_image_size( 'inku_portfolio', 780, 9999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'inku' ),
		'social' => esc_html__( 'Social Menu', 'inku' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'inku_custom_background_args', array(
		'default-color' => 'F4F3E2',
		'default-image' => '',
	) ) );

	// Add Logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 110,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Styles for TinyMCE
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Source+Code+Pro:300,400,700' );
    add_editor_style( array( 'css/bootstrap.css', 'css/editor-style.css', $font_url )  );
	
}
endif; // inku_setup
add_action( 'after_setup_theme', 'inku_setup' );

function create_posttype() {

	register_post_type( '3D-experience',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( '3D-experience' ),
                'singular_name' => __( '3D-experience' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => '3Dexperiences'),
			'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')

 
        )
	);
	register_post_type( 'Artist',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Artist' ),
                'singular_name' => __( 'Artist' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'artists'),
			'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )

 
        )
	);
	register_post_type( 'Project',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Project' ),
                'singular_name' => __( 'Project' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'projects'),
			'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )

 
        )
	);
}
add_action( 'init', 'create_posttype' );
add_post_type_support( 'Artist', 'thumbnail' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function inku_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'inku_content_width', 1190 );
}
add_action( 'after_setup_theme', 'inku_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function inku_widgets_init() {

	require get_template_directory() . '/inc/widget-areas/widget-areas.php';

}
add_action( 'widgets_init', 'inku_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function inku_scripts() {

	/**
	 * Enqueue Stylesheets
	 */
	require get_template_directory() . '/inc/scripts/stylesheets.php';

	/**
	 * Enqueue Scripts
	 */
	require get_template_directory() . '/inc/scripts/scripts.php';
	wp_enqueue_script( 'inkubatorcollectivetheme-tickers', get_template_directory_uri() . '/js/tickers.js', array(), true );
	wp_enqueue_script( 'inkubatorcollectivetheme-eyes', get_template_directory_uri() . '/js/eyes.js', array(), true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), true );



}
add_action( 'wp_enqueue_scripts', 'inku_scripts' );



/**
 * Custom CSS generated by the Theme.
 */
require get_template_directory() . '/inc/scripts/styles.php';



/**
 * Admin Styles
 *
 * Enqueue styles to the Admin Panel.
 */
function inku_wp_admin_style() {

	$current_screen = get_current_screen();

    if( "appearance_page_inku_theme-info" == $current_screen->id ) {

        wp_register_style( 'inku_custom_wp_admin_css', get_template_directory_uri() . '/css/admin-styles.css', false, '1.0.0' );
		wp_enqueue_style( 'inku_custom_wp_admin_css' );
		
	}
}
add_action( 'admin_enqueue_scripts', 'inku_wp_admin_style' );




/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/**
 * Extras
 *
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';



/**
 * Customizer
 *
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Jetpack
 *
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Theme Functions
 *
 * Add Theme Functions
 */

	// Custom Header
	require get_template_directory() . '/inc/theme-functions/custom-header.php';

	// TGM Plugin Activation
	require get_template_directory() . '/inc/theme-functions/ql_tgm_plugin_activation.php';

	// Theme Info Page
	require get_template_directory() . '/inc/theme-functions/theme-info-page.php';

	// Retina Logo
	require get_template_directory() . '/inc/theme-functions/retina-logo.php';


