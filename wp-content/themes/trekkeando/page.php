<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Trekkeando
 */
use Elementor\Base_Data_Control;

get_header();

while ( have_posts() ) : the_post(); 

	if ( RT_has_Elementor_layout( $post->ID ) ) {
		
		the_content();

	}
	else {

		get_template_part( 'template-parts/content', 'page' );

	}

endwhile;

get_footer(); ?>