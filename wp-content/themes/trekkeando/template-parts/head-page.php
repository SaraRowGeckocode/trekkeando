<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Trekkeando
 */
?>



<div class="page-head">
	<div class="background-overlay"></div>

	<div class="container">
		
		<?php 
		if(is_home()){
			echo '<h1 class="entry-title entry-title-single">'. get_the_title( get_option('page_for_posts') ) .'</h1>';
		} else {
			the_title( '<h1 class="entry-title entry-title-single">', '</h1>' );
		} ?>

	</div>

</div><!-- .entry-header-wrapper -->

