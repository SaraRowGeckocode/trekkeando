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

get_header();

while ( have_posts() ) : the_post(); 

	if ( SR_has_Elementor_layout( $post->ID ) ) {
		
		the_content();

	}
	else { ?>

		<div class="container">
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		</div><!-- .container -->

		<?php 
	}

endwhile;

get_footer(); ?>