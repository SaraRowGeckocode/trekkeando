<?php
namespace RowElementorWidgets;


use RowElementorWidgets\Widgets\Row_Widgets_Subpages_Grid;
use RowElementorWidgets\Widgets\Row_Widgets_Related_Content;
use RowElementorWidgets\Widgets\Row_Widgets_Social_Icons;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		// Add New Elementor Categories
        add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );

        // Register Widget Scripts
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_widget_scripts' ) );
        

        // Register Widget Styles
        //add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'register_widget_styles' ) );

        // Register New Widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'on_widgets_registered' ) );
	}

	/**
     * Add Elementor Categories
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function add_elementor_category()
    {
    	/*
    	$elements_manager = \Elementor\Plugin::instance()->elements_manager;
        $elements_manager->add_category( 'row-widgets-post-elements', array(
            'title' => __( 'Page/Project Info', 'elementor-row-widgets' ),
        ), 1 );
        $elements_manager->add_category( 'row-widgets-projects', array(
            'title' => __( 'Projects Elements', 'elementor-row-widgets' ),
        ), 2 );
        */
    }

    /**
     * Register Widget Scripts
     *
     * @since 1.6.0
     *
     * @access public
     */
    public function register_widget_scripts()
    {
        wp_register_script( 'elementor-row-widgets', plugins_url( '/assets/js/row-widgets.js', __FILE__ ), array('jquery','bootstrap'), '1.0.1' );
    }

    /**
     * Register Widget Styles
     *
     * @since 1.7.0
     *
     * @access public
     */
    public function register_widget_styles()
    {
        // Typing Effect
        /*wp_register_style( 'typing-effect', plugins_url( 'press-elements/assets/css/typing-effect.css' ) );
        wp_enqueue_style( 'typing-effect' );*/
    }

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
        require_once __DIR__ . '/widgets/subpages-grid.php';
        require_once __DIR__ . '/widgets/related-content.php';
        require_once __DIR__ . '/widgets/social-icons.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

		$widgets_manager->register_widget_type( new \RowElementorWidgets\Widgets\Row_Widgets_Subpages_Grid() );
		$widgets_manager->register_widget_type( new \RowElementorWidgets\Widgets\Row_Widgets_Related_Content() );
		$widgets_manager->register_widget_type( new \RowElementorWidgets\Widgets\Row_Widgets_Social_Icons() );

		$remove_widgets = array(
			//'counter',
			//'progress',
			'audio',
			//'accordion',
			'social-icons', // it breaks when custom icons added
			'wp-widget-pages',
			'wp-widget-archives',
			'wp-widget-media_audio',
			'wp-widget-media_image',
			'wp-widget-media_gallery',
			'wp-widget-meta',
			'wp-widget-text',
			//'wp-widget-categories',
			//'wp-widget-recent-posts',
			//'wp-widget-recent-comments',
			'wp-widget-rss',
			//'wp-widget-tag_cloud',
			'wp-widget-custom_html',
			'wp-widget-calendar'
		);
		foreach($remove_widgets as $widget){
			$widgets_manager->unregister_widget_type($widget);
		}
	}
}

new Plugin();
