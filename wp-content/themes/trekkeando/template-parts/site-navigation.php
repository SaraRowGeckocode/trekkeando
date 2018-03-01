<?php
/**
 * The template for displaying site navigation
 * @package Trekkeando
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<div class="inner">

		<a class="sr-only" href="#content"><?php _e( 'Skip to content', 'row_themes' ); ?></a>

		<!-- toggle menu -->
		<button class="toggle-menu" type="button" data-toggle="offcanvas">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="sr-only">Open Menu</span>
		</button>

		<?php
		// Header Menu
		wp_nav_menu( array(
			'container'       => null,
			'theme_location'  => 'header-menu',
			'menu_class'      => 'navbar-nav header-menu'
		) );
		?>

	</div>
</nav>
