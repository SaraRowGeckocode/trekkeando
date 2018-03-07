<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Trekkeando
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/head', 'page' ); ?>
	
	<div class="container">
		
		<div class="entry-content entry-content-single">
			
			<?php the_content(); ?>
			
		</div><!-- .entry-content -->

		<?php if ( RT_has_post_edit_link() ) : ?>
		<footer class="entry-meta entry-meta-single entry-meta-footer">
			<?php RT_entry_footer(); ?>
		</footer><!-- .entry-meta -->
		<?php endif; ?>
		
	</div>

</article><!-- #post-## -->
