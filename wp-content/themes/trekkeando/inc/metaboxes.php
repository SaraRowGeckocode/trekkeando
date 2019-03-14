<?php
// https://metabox.io/online-generator/


function RT_metaboxes( $meta_boxes ) {
    $prefix = 'RT_';

    $meta_boxes[] = array(
        'id' => 'page-grid-fields',
        'title' => __( 'Page Settings (for grid view)', 'row_themes' ),
        'post_types' => array( 'page' ),
        //'context' => 'after_editor',
        'priority' => 'high',
        'autosave' => true,
        'fields' => array(
            array(
                'id' => $prefix . 'subtitle',
                'type' => 'text',
                'name' => __( 'Subtitle', 'row_themes' ),
            ),
            array(
                'id' => $prefix . 'thumb',
                'type' => 'image_advanced',
                'name' => __( 'Image', 'row_themes' ),
                'max_file_uploads' => '1',
            )
        ),
    );

    foreach ( $meta_boxes as $k => $meta_box ){
        if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ){
            unset( $meta_boxes[$k] );
        }
    }

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'RT_metaboxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions )
{
    // Always include in the frontend to make helper function work
    if ( ! is_admin() ) return true;
    // Always include for ajax
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return true;

    if ( isset( $_GET['post'] ) ){
        $post_id = intval( $_GET['post'] );
    } elseif ( isset( $_POST['post_ID'] ) ){
        $post_id = intval( $_POST['post_ID'] );
    } else {
        $post_id = false;
    }
    $post_id = (int) $post_id;
    $post    = get_post( $post_id );
    foreach ( $conditions as $cond => $v ) {
        // Catch non-arrays too
        if ( ! is_array( $v ) ) {
            $v = array( $v );
        }
        switch ( $cond ) {

            case 'template':
                $template = get_post_meta( $post_id, '_wp_page_template', true );
                if ( in_array( $template, $v ) ) return true;
                break;

        }
    }
    // If no condition matched
    return false;
}
?>