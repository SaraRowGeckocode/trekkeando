<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Trekkeando
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<!-- header -->
	<header id="topbar" role="banner" <?php if(is_front_page()) echo ' class="transparent"' ?>>
		<div class="container">
			<?php the_custom_logo(); ?>

			<div class="site-branding">
				<?php 
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="sr-only"><?php bloginfo( 'name' ); ?></h1>
					<?php 
				endif; ?>
			</div>

			<?php
			// Site Navigation
			get_template_part( 'template-parts/site-navigation' );
			?>
		</div>
	</header>


	<div id="content" class="site-content">
