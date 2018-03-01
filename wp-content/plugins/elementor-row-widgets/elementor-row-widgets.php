<?php
/**
 * Plugin Name: Elementor Row widgets
 * Description: Elementor widgets for RowThemes.
 * Version:     1.0.0
 * Author:      SaraRow
 * Author URI:  http://sararow.es
 * Text Domain: 'elementor-row-widgets'
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_ROW__FILE__', __FILE__ );

/**
 * Load Hello World
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function Row_Elementor_Widgets_load() {
	// Load localization file
	load_plugin_textdomain( 'elementor-row-widgets', false, basename( dirname( __FILE__ ) ) . '/languages' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'Row_Elementor_Widgets_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'Row_Elementor_Widgets_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'Row_Elementor_Widgets_load' );


function Row_Elementor_Widgets_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Hello World is not working because you are using an old version of Elementor.', 'elementor-row-widgets' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'elementor-row-widgets' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}