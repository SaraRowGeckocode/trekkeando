<?php
namespace RowElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Row Widgets Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.0.0
 */
class Row_Widgets_Typing_Effect extends Widget_Base {

	public function get_name() {
		return 'row-typing-effect';
	}

	public function get_title() {
		return __( 'Typing Effect', 'elementor-row-widgets' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_script_depends() {
		return [ 'typedjs', 'typing-effect' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-row-widgets' ),
			]
		);

		$this->add_control(
			'typed_text',
			[
				'label' => __( 'Text', 'elementor-row-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'string' => __( 'Type out sentences', 'elementor-row-widgets' ),
					],
					[
						'string' => __( 'and then delete them', 'elementor-row-widgets' ),
					],
					[
						'string' => __( 'with a beautiful animation', 'elementor-row-widgets' ),
					],
				],
				'fields' => [
					[
						'name' => 'string',
						'label' => __( 'String', 'elementor-row-widgets' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'String', 'elementor-row-widgets' ),
						'placeholder' => __( 'String', 'elementor-row-widgets' ),
					],
				],
				'title_field' => '{{{ string }}}',
			]
		);

		$this->add_control(
			'prefix_text',
			[
				'label' => __( 'Prefix Text', 'elementor-row-widgets' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
			]
		);

		$this->add_control(
			'suffix_text',
			[
				'label' => __( 'Suffix Text', 'elementor-row-widgets' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'elementor-row-widgets' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elementor-row-widgets' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor-row-widgets' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor-row-widgets' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' => __( 'Settings', 'elementor-row-widgets' ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'elementor-row-widgets' ),
					'h2' => __( 'H2', 'elementor-row-widgets' ),
					'h3' => __( 'H3', 'elementor-row-widgets' ),
					'h4' => __( 'H4', 'elementor-row-widgets' ),
					'h5' => __( 'H5', 'elementor-row-widgets' ),
					'h6' => __( 'H6', 'elementor-row-widgets' ),
					'p'  => __( 'p', 'elementor-row-widgets' ),
					'div' => __( 'div', 'elementor-row-widgets' ),
					'span' => __( 'span', 'elementor-row-widgets' ),
				],
				'default' => 'p',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed (ms)', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'ms',
				],
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label' => __( 'Back-spacing Speed (ms)', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'ms',
				],
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label' => __( 'Time before typing starts (ms)', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'ms',
				],
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label' => __( 'Time before back-spacing (ms)', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 2000,
					'unit' => 'ms',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __( 'True', 'elementor-row-widgets' ),
					'0' => __( 'False', 'elementor-row-widgets' ),
				],
				'default' => '0',
			]
		);

		$this->add_control(
			'show_cursor',
			[
				'label' => __( 'Show Cursor', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __( 'True', 'elementor-row-widgets' ),
					'0' => __( 'False', 'elementor-row-widgets' ),
				],
				'default' => '0',
			]
		);

		$this->add_control(
			'cursor_char',
			[
				'label' => __( 'Cursor Char', 'elementor-row-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '|',
				'condition' => [
					'show_cursor' => '1'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_strings',
			[
				'label' => __( 'Style Strings', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .press-elements-typing-effect' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-typing-effect',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_cursor',
			[
				'label' => __( 'Style Cursor', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_cursor' => '1'
				],
			]
		);

		$this->add_control(
			'color_cursor',
			[
				'label' => __( 'Cursor Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .press-elements-typing-effect .typed-cursor' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cursor' => '1'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_cursor',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-typing-effect .typed-cursor',
				'condition' => [
					'show_cursor' => '1'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_prefix',
			[
				'label' => __( 'Style Prefix', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_prefix',
			[
				'label' => __( 'Text Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .press-elements-typing-effect .typing-effect-prefix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_prefix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-typing-effect .typing-effect-prefix',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_suffix',
			[
				'label' => __( 'Style Suffix', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_suffix',
			[
				'label' => __( 'Text Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .press-elements-typing-effect .typing-effect-suffix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_suffix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-typing-effect .typing-effect-suffix',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		printf( '<%s class="press-elements-typing-effect">', $settings['html_tag'] );
			?>
			<span class="typing-effect-prefix"><?php echo $settings['prefix_text']; ?></span>
			<span class="typing-effect-strings"
				data-strings='<?php echo json_encode( wp_list_pluck( $settings['typed_text'], 'string' ) ); ?>'
				data-speed="<?php echo esc_attr( $settings['speed']['size'] ); ?>"
				data-back-speed="<?php echo esc_attr( $settings['back_speed']['size'] ); ?>"
				data-start-delay="<?php echo esc_attr( $settings['start_delay']['size'] ); ?>"
				data-back-delay="<?php echo esc_attr( $settings['back_delay']['size'] ); ?>"
				data-loop="<?php echo esc_attr( $settings['loop'] ); ?>"
				data-show-cursor="<?php echo esc_attr( $settings['show_cursor'] ); ?>"
				data-cursor-char="<?php echo esc_attr( $settings['cursor_char'] ); ?>"
			></span>
			<span class="typing-effect-suffix"><?php echo $settings['suffix_text']; ?></span>
			<?php
		printf( '</%s>', $settings['html_tag'] );

	}

	protected function _content_template() {
	}

}
