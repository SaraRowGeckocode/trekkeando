<?php
/**
 * Wisteria functions and definitions
 *
 * @package Trekkeando
 */

if ( ! function_exists( 'SR_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function SR_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Wisteria, use a find and replace
	 * to change 'row_themes' to the name of your theme in all the template files
	 */
	load_theme_textdomain('row_themes', get_template_directory() . '/languages');

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 400,
		'width'       => 580,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array('post') );

	// Theme Image Sizes
	add_image_size('portfolio',         380,380,true);
	add_image_size('portfolio2x',       760,760,true); //380,380 retina

	// This theme uses wp_nav_menu() in four locations.
	register_nav_menus( array (
		'header-menu' => esc_html__( 'Header Menu', 'row_themes' ),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array ( 'css/editor-style.css' ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array (
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support Elemento footer
	add_theme_support( 'header-footer-elementor' );

}
endif; // SR_setup
add_action( 'after_setup_theme', 'SR_setup' );



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function SR_widgets_init() {

	// Widget Areas
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'row_themes' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'SR_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function SR_scripts() {

	// Theme Stylesheet
	wp_enqueue_style( 'trekkeando', get_stylesheet_uri() );


	/**
	 * Enqueue JS files
	 */

	// Enquire
	wp_enqueue_script( 'enquire', get_template_directory_uri() . '/js/enquire.js', array( 'jquery' ), '2.1.2', true );

	// Fitvids
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '1.1', true );

	// Comment Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Custom Script
	wp_enqueue_script( 'trekkeando', get_template_directory_uri() . '/js/custom.min.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'SR_scripts' );


/*
function RT_scripts_styles() {
	$template = get_template_directory_uri();
	$theme_ver = wp_get_theme()->get('Version');

	wp_enqueue_style('row-bootstrap',  $template . '/css/bootstrap.min.css', array(), '4.0.0', 'all');
	wp_enqueue_style('lightgallery',  $template . '/css/lightgallery.min.css', array(), '1.6.6', 'all');
	
	wp_register_style('row-style',      $template . '/style.css', array(), $theme_ver, 'all');
	

	wp_enqueue_script('modernizr',     $template.'/js/modernizr.min.js', array(), '3.5.0', false);
	wp_enqueue_script('lazyload',      $template.'/js/jquery.lazyload.min.js', array('jquery'), '1.10.0', true);
	wp_enqueue_script('lightgallery',  $template.'/js/lightgallery.min.js', array('jquery'), '1.6.6', true);
	
	wp_register_script('row-js', 		$template.'/js/scripts.min.js', array(), $theme_ver, true);


	wp_localize_script('row-js', 'row_translate', array(
		'next' => __( 'Next', 'row_themes' ),
		'previous' => __( 'Previous', 'row_themes' ),
	) );



	if(!has_action('elementor/frontend/after_enqueue_scripts')){
		wp_enqueue_style('row-style');
		wp_enqueue_script('row-js');
	}
}
add_action('wp_enqueue_scripts', 'RT_scripts_styles');

// Make sure scripts and styles are enqueued after elementor
function RT_script_after_Elementor() {
	wp_enqueue_script('row-js');
}
add_action( 'elementor/frontend/after_enqueue_scripts', 'RT_script_after_Elementor');

function RT_styles_after_Elementor() {
	wp_enqueue_style('row-style');
}
add_action( 'elementor/frontend/after_enqueue_styles', 'RT_styles_after_Elementor');*/



/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom meta boxes for this theme.
 */
require get_template_directory() . '/inc/metaboxes.php';