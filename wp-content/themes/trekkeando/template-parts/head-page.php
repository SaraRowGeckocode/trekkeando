<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Trekkeando
 */
?>



<div class="page-head">
	<?php if ( SR_has_post_edit_link() ) : ?>
		<div class="entry-meta entry-meta-single">
			<?php SR_post_edit_link(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php the_title( '<h1 class="entry-title entry-title-single">', '</h1>' ); ?>

</div><!-- .entry-header-wrapper -->

