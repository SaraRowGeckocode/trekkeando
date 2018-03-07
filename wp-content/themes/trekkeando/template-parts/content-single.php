<?php
/**
 * Template part for displaying single posts.
 *
 * @package Trekkeando
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header entry-header-single">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<?php RT_entry_meta(); ?>
	</header>


	<div class="entry-content entry-content-single">
		<?php the_content(); ?>
		
		<?php
		// paginated entry
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'row_themes' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta entry-meta-footer">
		<?php RT_entry_footer(); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->