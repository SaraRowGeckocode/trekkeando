<?php
/**
 * Plugin Name: Custom Elementor IconBox
 * Description: Override Elementor's 'Icon' control to include custom icon packs.
 * Author: @cbrcongit, @albionselimaj, @ryanlabelle
 * Version: 0.5
 * Site: https://github.com/pojome/elementor/issues/110
 */
if ( ! defined( 'ABSPATH' ) ) exit;
// Define some constants
define( 'PLUG_VERSION', '0.5');
define( 'PLUG__FILE__', __FILE__ ); 
define( 'PLUG_PLUGIN_BASE', plugin_basename( PLUG__FILE__ ) ); 
define( 'PLUG_URL', plugins_url( '/', PLUG__FILE__ ) ); 
define( 'PLUG_PATH', plugin_dir_path( PLUG__FILE__ ) ); 
// Hook into things early in the WP-Elementor load sequence
add_action( 'elementor/init', function() {
// Elementor icon control.
class Elementor_Control_Icon extends Elementor\Base_Control {
	// Retrieve icon control type.
	public function get_type() {
		return 'icon';
	}
	// Retrieve icons.
	// Make your own list, and use the IcoMoon font 'style.css' Classes to build your array
	public static function get_icons() {
		return [
			'icom-activity' 			=> 'actividad',
			'icom-settings' 			=> 'ajustes rueda',
			'icom-hash' 				=> 'almohadilla',
			'icom-at-sign' 				=> 'arroba',
			'icom-send' 				=> 'avion',
			'icom-flag' 				=> 'bandera',
			'icom-battery-charging' 	=> 'bateria pila',
			'icom-x' 					=> 'borrar cerrar',
			'icom-compass' 				=> 'brujula',
			'icom-search' 				=> 'buscar lupa',
			'icom-calendar' 			=> 'calendario',
			'icom-camera' 				=> 'camara foto',
			'icom-bell' 				=> 'campana alerta',
			'icom-shopping-cart' 		=> 'carrito compra',
			'icom-home' 				=> 'casa',
			'icom-check' 				=> 'check',
			'icom-check-square' 		=> 'check cuadrado',
			'icom-message-square' 		=> 'comentario',
			'icom-heart' 				=> 'corazon',
			'icom-target' 				=> 'diana',
			'icom-edit' 				=> 'editar lapiz',
			'icom-mail' 				=> 'email correo',
			'icom-shield' 				=> 'escudo',
			'icom-star' 				=> 'estrella',
			'icom-tag' 					=> 'etiqueta',
			'icom-facebook' 			=> 'facebook',
			'icom-chevron-down' 		=> 'flecha abajo',
			'icom-chevron-up' 			=> 'flecha arriba',
			'icom-chevron-right' 		=> 'flecha derecha',
			'icom-chevron-left' 		=> 'flecha izquierda',
			'icom-arrow-down-circle' 	=> 'flecha abajo circulo',
			'icom-arrow-up-circle' 		=> 'flecha arriba circulo',
			'icom-arrow-right-circle' 	=> 'flecha derecha circulo',
			'icom-arrow-left-circle' 	=> 'flecha izquierda circulo',
			'icom-droplet' 				=> 'gota agua',
			'icom-trending-down' 		=> 'grafico sube',
			'icom-trending-up' 			=> 'grafico baja',
			'icom-image' 				=> 'imagen',
			'icom-info' 				=> 'informacion',
			'icom-instagram' 			=> 'instagram',
			'icom-help-circle' 			=> 'interrogacion pregunta',
			'icom-thumbs-up' 			=> 'like gustar',
			'icom-linkedin' 			=> 'linkedin',
			'icom-map-pin' 				=> 'localizacion mapa',
			'icom-moon' 				=> 'luna',
			'icom-map' 					=> 'mapa',
			'icom-plus' 				=> 'mas',
			'icom-plus-circle' 			=> 'mas circulo',
			'icom-award' 				=> 'medalla',
			'icom-minus' 				=> 'menos',
			'icom-minus-circle' 		=> 'menos circulo',
			'icom-menu' 				=> 'menu',
			'icom-music' 				=> 'musica',
			'icom-navigation' 			=> 'navegacion flecha',
			'icom-navigation-2' 		=> 'navegacion2 flecha',
			'icom-eye' 					=> 'ojo',
			'icom-play' 				=> 'play',
			'icom-play-circle' 			=> 'play circulo',
			'icom-clipboard' 			=> 'portafolio carpeta',
			'icom-zap' 					=> 'rayo',
			'icom-clock' 				=> 'reloj',
			'icom-watch' 				=> 'reloj pulsera',
			'icom-sun' 					=> 'sol',
			'icom-phone' 				=> 'telefono',
			'icom-thermometer' 			=> 'termometro temperatura',
			'icom-alert-triangle' 		=> 'triangulo alerta',
			'icom-twitter' 				=> 'twitter',
			'icom-user' 				=> 'usuario',
			'icom-users' 				=> 'usuarios',
			'icom-video' 				=> 'video',
			'icom-wind' 				=> 'viento'
	    ];
	}





	// Retrieve the default settings of the icons control to return the default settings while initializing the icons control.
	protected function get_default_settings() {
		return [
			'icons' => self::get_icons(),
		];
	}
	// Render icons control output in the editor.
	public function content_template() {
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select class="elementor-control-icon" data-setting="{{ data.name }}" data-placeholder="<?php _e( 'Select Icon', 'elementor' ); ?>">
					<option value=""><?php _e( 'Select Icon', 'elementor' ); ?></option>
					<# _.each( data.icons, function( option_title, option_value ) { #>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}
};
});
// ENQUEUE // Enqueueing Frontend stylesheet and scripts.
//add_action( 'elementor/editor/after_enqueue_scripts', 'icons_enqueue_before_editor');
// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'icons_enqueue_before_editor' );

function icons_enqueue_before_editor() {
    wp_enqueue_style( 'theme-icons', plugin_dir_url( __FILE__ ) . 'style.css' , array(), PLUG_VERSION);
}
// Register the bloody thing
add_action('elementor/controls/controls_registered', function($el) { 
  $el->register_control('icon', new Elementor_Control_Icon); 
});
?>
