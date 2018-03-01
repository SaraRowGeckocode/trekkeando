<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Trekkeando
 */

get_header();
	
	get_template_part( 'template-parts/head', 'page' ); ?>

	<div class="container">

		<div class="row blog-layout">

			<main id="main" class="site-main" role="main">

				<?php 
				if ( have_posts() ) : ?>

					<div id="post-wrapper" class="post-wrapper post-wrapper-archive">
						<?php while ( have_posts() ) : the_post();
							
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile; ?>
					</div><!-- .post-wrapper -->

					<?php SR_the_posts_pagination(); 

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main><!-- #main -->

			
			<?php get_sidebar(); ?>

		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
