<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Trekkeando
 */

if ( ! function_exists( 'SR_the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function SR_the_posts_pagination() {

	// Previous/next posts navigation @since 4.1.0
	the_posts_pagination( array(
		'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous Page', 'row_themes' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next Page', 'row_themes' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'row_themes' ) . ' </span>',
	) );

}
endif;

if ( ! function_exists( 'SR_the_post_pagination' ) ) :
/**
 * Previous/next post navigation.
 *
 * @return void
 */
function SR_the_post_pagination() {

	// Previous/next post navigation @since 4.1.0.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav">' . esc_html__( 'Next', 'row_themes' ) . '</span> ' . '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev', 'row_themes' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );

}
endif;

if ( ! function_exists( 'SR_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function SR_posted_on( $before = '', $after = '' ) {

	// No need to display date for sticky posts
	if ( SR_has_sticky_post() ) {
		return;
	}

	// Time String
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Posted On
	$posted_on = sprintf( '<span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark"> %3$s</a>',
		esc_html_x( 'Posted on', 'post date', 'row_themes' ),
		esc_url( get_permalink() ),
		$time_string
	);

	// Posted On HTML
	$html = '<span class="posted-on">' . $posted_on . '</span>'; // // WPCS: XSS OK.

	// Posted On HTML Before After
	$html = $before . $html . $after; // WPCS: XSS OK.

	/**
	 * Filters the Posted On HTML.
	 *
	 * @param string $html Posted On HTML.
	 */
	$html = apply_filters( 'SR_posted_on_html', $html, $before, $after );

	echo $html; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'SR_posted_by' ) ) :
/**
 * Prints author.
 */
function SR_posted_by( $before = '', $after = '' ) {

	// Global Post
	global $post;

	// We need to get author meta data from both inside/outside the loop.
	$post_author_id = get_post_field( 'post_author', $post->ID );

	// Post Author
	$post_author = sprintf( '<span class="author vcard"><a class="entry-author-link url fn n" href="%1$s" rel="author"><span class="entry-author-name">%2$s</span></a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
		esc_html( get_the_author_meta( 'display_name', $post_author_id ) )
	);

	// Byline
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'row_themes' ),
		$post_author
	);

	// Posted By HTML
	$html = '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	// Posted By HTML Before After
	$html = $before . $html . $after; // WPCS: XSS OK.

	/**
	 * Filters the Posted By HTML.
	 *
	 * @param string $html Posted By HTML.
	 */
	$html = apply_filters( 'SR_posted_by_html', $html, $before, $after );

	echo $html; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'SR_sticky_post' ) ) :
/**
 * Prints HTML label for the sticky post.
 */
function SR_sticky_post( $before = '', $after = '' ) {

	// Sticky Post Validation
	if ( ! SR_has_sticky_post() ) {
		return;
	}

	// Sticky Post HTML
	$html = sprintf( '<span class="post-label post-label-sticky">%1$s</span>',
		esc_html_x( 'Featured', 'sticky post label', 'row_themes' )
	);

	// Sticky Post HTML Before After
	$html = $before . $html . $after; // WPCS: XSS OK.

	/**
	 * Filters the Sticky Post HTML.
	 *
	 * @param string $html Sticky Post HTML.
	 */
	$html = apply_filters( 'SR_sticky_post_html', $html, $before, $after );

	echo $html; // WPCS: XSS OK.
}
endif;


if ( ! function_exists( 'SR_post_edit_link' ) ) :
/**
 * Prints post edit link.
 *
 * @return void
*/
function SR_post_edit_link( $before = '', $after = '' ) {

	// Post edit link Validation
	if ( SR_has_post_edit_link() ) {

		// Post Edit Link
		$post_edit_link = sprintf( '<span class="screen-reader-text">%1$s</span><a class="post-edit-link" href="%2$s">%3$s</a>',
		esc_html( the_title_attribute( 'echo=0' ) ),
		esc_url( get_edit_post_link() ),
		esc_html_x( 'Edit', 'post edit link label', 'row_themes' )
		);

		// Post Edit Link HTML
		$html = '<span class="post-edit-link-meta">' . $post_edit_link . '</span>';

		// Post Edit Link HTML Before After
		$html = $before . $html . $after; // WPCS: XSS OK.

		/**
		 * Filters the Post Edit Link HTML.
		 *
		 * @param string $html Post Edit Link HTML.
		 */
		$html = apply_filters( 'SR_post_edit_link_html', $html, $before, $after );

		echo $html; // WPCS: XSS OK.
	}

}
endif;


if ( ! function_exists( 'SR_post_first_category' ) ) :
/**
 * Prints first category for the current post.
 *
 * @return void
*/
function SR_post_first_category( $before = '', $after = '' ) {

	// An array of categories to return for the post.
	$categories = get_the_category();
	if ( $categories[0] ) {

		// Post First Category HTML
		$html = sprintf( '<span class="post-first-category"><a href="%1$s" title="%2$s">%3$s</a></span>',
			esc_attr( esc_url( get_category_link( $categories[0]->term_id ) ) ),
			esc_attr( $categories[0]->cat_name ),
			esc_html( $categories[0]->cat_name )
		);

		// Post First Category HTML Before After
		$html = $before . $html . $after; // WPCS: XSS OK.

		/**
		 * Filters the Post First Category HTML.
		 *
		 * @param string $html Post First Category HTML.
		 * @param array $categories An array of categories to return for the post.
		 */
		$html = apply_filters( 'SR_post_first_category_html', $html, $before, $after, $categories );

		echo $html; // WPCS: XSS OK.
	}

}
endif;


if ( ! function_exists( 'SR_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function SR_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( _x(', ', 'Used between category, there is a space after the comma.', 'row_themes' ) );
		if ( $categories_list && SR_categorized_blog() ) {
			printf( '<span class="cat-links cat-links-single">' . esc_html__( 'Posted in %1$s', 'row_themes' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', _x(', ', 'Used between tag, there is a space after the comma.', 'row_themes' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links tags-links-single">' . esc_html__( 'Tagged %1$s', 'row_themes' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'row_themes' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function SR_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'SR_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array (
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'SR_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so SR_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so SR_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in SR_categorized_blog.
 */
function SR_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'SR_categories' );
}
add_action( 'edit_category', 'SR_category_transient_flusher' );
add_action( 'save_post',     'SR_category_transient_flusher' );



if ( ! function_exists( 'SR_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @param string $size Size of the image.
 * @return void
*/
function SR_post_thumbnail( $size = 'wisteria-featured' ) {

	// Post Thumbnail HTML
	$html = '';

	// Post Thumbnail Validation
	if ( SR_has_post_thumbnail() ) {

		// Post Thumbnail HTML
		$html = sprintf( '<div class="entry-image-wrapper entry-image-wrapper-archive"><figure class="post-thumbnail"><a href="%1$s">%2$s</a></figure></div>',
			esc_attr( esc_url( get_the_permalink() ) ),
			get_the_post_thumbnail( null, $size, array( 'class' => 'img-featured img-responsive' ) )
		);

	}

	/**
	 * Filters the Post Thumbnail HTML.
	 *
	 * @param string $html Post Thumbnail HTML.
	 */
	$html = apply_filters( 'SR_post_thumbnail_html', $html );

	// Print HTML
	if ( ! empty ( $html ) ) {
		echo $html; // WPCS: XSS OK.
	}

}
endif;

/**
 * A helper conditional function.
 * Whether there is a post thumbnail and post is not password protected.
 *
 * @return bool
 */
function SR_has_post_thumbnail() {

	/**
	 * Post Thumbnail Filter
	 * @return bool
	 */
	return apply_filters( 'SR_has_post_thumbnail', (bool) ( ! post_password_required() && has_post_thumbnail() ) );

}

/**
 * A helper conditional function.
 * Post is Sticky or Not
 *
 * @return bool
 */
function SR_has_sticky_post() {

	/**
	 * Sticky Post Filter
	 * @return bool
	 */
	return apply_filters( 'SR_has_sticky_post', (bool) ( is_sticky() && is_home() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Post has Edit link or Not
 *
 * @return bool
 */
function SR_has_post_edit_link() {

	/**
	 * Post Edit Link Filter
	 * @return bool
	 */
	$post_edit_link = get_edit_post_link();
	return apply_filters( 'SR_has_post_edit_link', (bool) ( ! empty( $post_edit_link ) ) );

}

/**
 * A helper conditional function.
 * Theme has Excerpt or Not
 *
 * @return bool
 */
function SR_has_excerpt() {

	// Post Excerpt
	$post_excerpt = get_the_excerpt();

	/**
	 * Excerpt Filter
	 * @return bool
	 */
	return apply_filters( 'SR_has_excerpt', (bool) ! empty ( $post_excerpt ) );

}

/**
 * A helper conditional function.
 * Theme has Sidebar or Not
 *
 * @return bool
 */
function SR_has_sidebar() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'SR_has_sidebar', (bool) is_active_sidebar( 'sidebar-1' ) );

}

/**
 * Check if page layout is build with Elementor
 *
 * @return bool
 */
function SR_has_Elementor_layout($id) {
	// by metabox
	//return get_post_meta( $id, '_elementor_edit_mode', true );

	return Elementor\Plugin::instance()->db->is_built_with_elementor($id);


}
