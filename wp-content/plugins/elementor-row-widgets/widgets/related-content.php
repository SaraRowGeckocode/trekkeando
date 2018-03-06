<?php
namespace RowElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
//use Elementor\Scheme_Color;
// use Elementor\Scheme_Typography;
// use Elementor\Group_Control_Typography;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Row Widgets Post Date
 *
 * Single post/page date element for elementor.
 *
 * @since 1.0.0
 */
class Row_Widgets_Related_Content extends Widget_Base {

	public function get_name() {
		return 'row-related-content-widget';
	}

	public function get_title() {
		return __( 'Related Content', 'elementor-row-widgets' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'general-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Related Projects', 'elementor-row-widgets' )
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Widget title', 'elementor-row-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Related content', 'elementor-row-widgets' ),
			]
		);

		$options = array();
		$items = get_categories();
		foreach ($items as $item) {
			$options[$item->term_id] = $item->name;
		}

		$this->add_control(
			'posts_selection',
			[
				'label' => __( 'Posts selection', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $options,
				'default' => 'random',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings();

		$this->add_inline_editing_attributes( 'title', 'none' );

		?>


		<aside class="row-related">
			<?php
			echo '<p class="headline"><strong '. $this->get_render_attribute_string( 'title' ) .'>'. $settings['title'] .'</strong></p>'; ?>
		
			<ul>
				<?php
				

				$args = array(
					'posts_per_page' => 3,
					'suppress_filters' => false
				);

				// categories selected
				if($settings['posts_selection']){
					$args['category__in'] = $settings['posts_selection'];
				} 
				// random posts
				else {
					$args['orderby'] = 'rand';
				}


				$posts = get_posts($args);
				foreach ($posts as $item) {

					echo '<li class="item"><a href="'. get_permalink($item->ID) .'">';

					echo '<span class="thumbnail">'.get_the_post_thumbnail($item->ID,'portfolio').'</span>';

					echo '<h2 class="title">'. $item->post_title .'</h2></a></li>';

				}
				wp_reset_query(); ?>

			</ul>

		</aside>
		<?php
	}

	protected function _content_template() {
		?>
		<aside class="row-related fake">
			<p class="headline"><span data-elementor-setting-key="title">{{{ settings.title }}}</span></p>

			<ul>
				<li class="item"><div></div></li>
				<li class="item"><div></div></li>
				<li class="item"><div></div></li>
			</ul>
		</aside>

		<?php
	}
}
