<?php
namespace RowElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
// use Elementor\Scheme_Color;
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
class Row_Widgets_Subpages_Grid extends Widget_Base {

	public function get_name() {
		return 'row-subpages-grid';
	}

	public function get_title() {
		return __( 'Subpages Grid', 'elementor-row-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Subpages grid', 'elementor-row-widgets' )
			]
		);

		$options = array();
		$args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => 0,
			'suppress_filters' => false
		);
		$posts = get_posts($args);
		foreach ($posts as $item) {
			$options[$item->ID] = $item->post_title;
		}

		$this->add_control(
			'page-parent',
			[
				'label' => __( 'Page parent', 'elementor-row-widgets' ),
				'type' => Controls_Manager::SELECT,
				'options' => $options
			]
		);

		$this->end_controls_section();

	}

	protected function render_item($item){
		echo '<li class="item"><a href="'. get_permalink($item->ID) .'" class="thumbnail">';

		$thumb 	= rwmb_meta( 'RT_thumb', 'size=portfolio', $item->ID );
		$subtitle 	= rwmb_meta( 'RT_subtitle', '', $item->ID );

		if (!empty($thumb)) {
			$thumb = current($thumb);
			
			// responsive images
			$images_path = str_replace($thumb['sizes']['portfolio']['file'], '', $thumb['url']);
			$thumb2x = $thumb['sizes']['portfolio2x'];
			
			if($thumb2x){
				$srcset = array(
					$thumb['url'] . ' ' . $thumb['width'].'w',
					$images_path . $thumb2x['file'] . ' ' . $thumb2x['width'].'w'
				);
				$srcset_attr = 'srcset="'. implode (", ", $srcset) .'"';
			}

			echo '<img '.
				'src="'. $thumb['url'] .'" '.
				'width="'. $thumb['width'] .'" '.
				'height="'. $thumb['height'] .'" '.
				$srcset_attr .'">';
		}
		echo '<div class="overlay">'.
			'<h2>'. $item->post_title .'</h2>';
		if($subtitle) echo '<p>'. $subtitle .'</p>';
		echo '</div></a></li>';
	}

	protected function render() {

		$settings = $this->get_settings();

		$args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => $settings['page-parent'],
			'suppress_filters' => false
		);
		?>


		<ul class="subpages-grid">
			<?php

			$posts = get_posts($args);
			foreach ($posts as $item) {

				$this->render_item($item);
			}
			wp_reset_query(); ?>

		</ul>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="row-widgets-projects">
			<p class="text center"><strong><?php _e( 'Subpages Grid', 'elementor-row-widgets' ) ?></strong><br>
				<?php _e( 'Select page parent ID', 'elementor-row-widgets' ) ?>
			</p>
		</div>

		<?php
	}
}
