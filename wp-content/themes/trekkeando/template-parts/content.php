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

		<?php if ( 'post' === get_post_type() ) : // For Posts ?>
			<div class="entry-meta">
				<?php RT_posted_on(); ?>
				<span class="categories"><?php the_category(', ') ?></span>
				<?php RT_post_edit_link();  ?>
			</div>
		<?php endif; ?>

		<?php if ( RT_has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
