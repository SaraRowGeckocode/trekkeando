<?php
/**
 * The default template for displaying content
 *
 * @package Trekkeando
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php SR_post_thumbnail(); ?>

	<div class="entry-excerpt">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : // For Posts ?>
			<div class="entry-meta entry-meta-header-after">
				<?php
				SR_posted_on();
				SR_post_first_category();
				?>
			</div>
		<?php endif; ?>

		<?php if ( SR_has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
