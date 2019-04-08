<?php
namespace RowElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor social icons widget.
 *
 * Elementor widget that displays icons to social pages like Facebook and Twitter.
 *
 * @since 1.0.0
 */
class Row_Widgets_Social_Icons extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve social icons widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'row-social-icons';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve social icons widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Social Icons', 'elementor-row-widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve social icons widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the social icons widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register social icons widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_social_icon',
			[
				'label' => __( 'Social Icons', 'elementor-row-widgets' ),
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'elementor-row-widgets' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'social',
						'label' => __( 'Icon', 'elementor-row-widgets' ),
						'type' => Controls_Manager::ICON,
						'default' => 'icom-facebook',
						'label_block' => true,
					],
					[
						'name' => 'link',
						'label' => __( 'Link', 'elementor-row-widgets' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'is_external' => 'true',
						],
						'placeholder' => __( 'https://your-link.com', 'elementor-row-widgets' ),
					],
				],
				'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'icom-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);

		/*$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'rounded',
				'options' => [
					'rounded' => __( 'Rounded', 'elementor-row-widgets' ),
					'square' => __( 'Square', 'elementor-row-widgets' ),
					'circle' => __( 'Circle', 'elementor-row-widgets' ),
				],
				'prefix_class' => 'elementor-shape-',
			]
		);*/

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

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor-row-widgets' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_style',
			[
				'label' => __( 'Icon', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official Color', 'elementor-row-widgets' ),
					'custom' => __( 'Custom', 'elementor-row-widgets' ),
				],
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);

		$icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:not(:last-child)' => $icon_spacing,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border', // We know this mistake - TODO: 'icon_border' (for hover control condition also)
				'selector' => '{{WRAPPER}} .elementor-social-icon',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-row-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_hover',
			[
				'label' => __( 'Icon Hover', 'elementor-row-widgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor-row-widgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'image_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		/*$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor-row-widgets' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);*/

		$this->end_controls_section();

	}

	/**
	 * Render social icons widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		/*$class_animation = '';
		if ( ! empty( $settings['hover_animation'] ) ) {
			$class_animation = ' elementor-animation-' . $settings['hover_animation'];
		}*/

		?>
		<div class="elementor-social-icons-wrapper">
			<?php
			foreach ( $settings['social_icon_list'] as $index => $item ) {
				$social = str_replace( 'fa fa-', '', $item['social'] );

				$link_key = 'link_' . $index;

				$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

				if ( $item['link']['is_external'] ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( $item['link']['nofollow'] ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}
				?>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-<?php echo $social; ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
					<span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
					<i class="<?php echo $item['social']; ?>"></i>
				</a>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render social icons widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="elementor-social-icons-wrapper">
			<# _.each( settings.social_icon_list, function( item ) {
				var link = item.link ? item.link.url : '',
					social = item.social.replace( 'fa fa-', '' ); #>
				<a class="elementor-icon elementor-social-icon elementor-social-icon-{{ social }} elementor-animation-{{ settings.hover_animation }}" href="{{ link }}">
					<span class="elementor-screen-only">{{{ social }}}</span>
					<i class="{{ item.social }}"></i>
				</a>
			<# } ); #>
		</div>
		<?php
	}
}
