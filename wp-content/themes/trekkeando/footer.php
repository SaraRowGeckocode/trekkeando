<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Trekkeando
 */
?>
	</div><!-- /site-content -->

	<?php 
	if ( function_exists( 'hfe_render_footer' ) ) {

		hfe_render_footer();
		
	} else {
		echo '<footer><p>&copy; '. date('Y') .' '. get_bloginfo('name') .'. '. __('All rights reserved.', 'row_themes') .'</p></footer>';
	} ?>


	<div class="overlay"></div>
	
	<?php wp_footer(); ?>

</body>
</html>