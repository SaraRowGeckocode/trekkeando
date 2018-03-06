<?php
/**
 * The template for displaying search forms.
 *
 * @package Trekkeando
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'row_themes' ); ?></span>
		<input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'row_themes' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'row_themes' ); ?>" />
	</label>
	<button type="submit" class="btn btn-icon search-submit"><span class="sr-only"><?php echo esc_html_x( 'Search', 'submit button', 'row_themes' ); ?></span></button>
</form>
