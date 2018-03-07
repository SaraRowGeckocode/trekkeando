<?php
/**
 * The default template for displaying content
 *
 * @package Trekkeando
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php RT_post_thumbnail('portfolio'); ?>

	<div class="entry-excerpt">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php RT_entry_meta(); ?>

		<?php if ( RT_has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
