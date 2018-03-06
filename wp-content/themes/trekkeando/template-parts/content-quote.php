<?php
/**
 * The default template for displaying content
 *
 * @package Trekkeando
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-excerpt">
		
		<?php the_content(); ?>

		<?php if ( 'post' === get_post_type() ) : // For Posts ?>
			<div class="entry-meta">
				<?php
				SR_post_edit_link(); ?>
			</div>
		<?php endif; ?>

	</div>
</article>
