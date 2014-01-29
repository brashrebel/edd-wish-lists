<?php
/**
 * Shortcodes
 *
 * @since 1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * View wishlist shortcode
 *
 * @since 1.0
*/
function edd_wl_view_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $atts, 'edd_wish_lists_view' )
	);

	$edd_wish_lists = edd_wish_lists();
  	$edd_wish_lists::$add_script = true;

	$content = edd_wl_load_template( 'view' );

	return $content;
}
add_shortcode( 'edd_wish_lists_view', 'edd_wl_view_shortcode' );

/**
 * Wishlist edit shortcode
 *
 * @since 1.0
*/
function edd_wl_edit_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $atts, 'edd_wish_lists_edit' )
	);

	$content = edd_wl_load_template( 'edit' );

	return $content;
}
add_shortcode( 'edd_wish_lists_edit', 'edd_wl_edit_shortcode' );

/**
 * Add wishlist shortcode
 *
 * @since 1.0
*/
function edd_wl_create_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $atts, 'edd_wish_lists_create' )
	);

	$content = edd_wl_load_template( 'create' );

	return $content;
}
add_shortcode( 'edd_wish_lists_create', 'edd_wl_create_shortcode' );


/**
 * View Wish Lists shortcode
 * 
 * @param  array $atts
 * @param  $content
 * @return object
 * @since  1.0
 */
function edd_wl_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $atts, 'edd_wish_lists' )
	);

	$content = edd_wl_wish_list();

	return $content;
}
add_shortcode( 'edd_wish_lists', 'edd_wl_shortcode' );

/**
 * Add to wish list shortcode
 * 
 * @param  array $atts
 * @param  $content
 * @return object
 * @since  1.0
 */
function edd_wl_add_to_list_shortcode( $atts, $content = null ) {
	global $post, $edd_options;

	extract( shortcode_atts( array(
			'id' 		=> $post->ID,
			'text' 		=> ! empty( $edd_options[ 'edd_wl_add_to_wish_list' ] ) ? $edd_options[ 'edd_wl_add_to_wish_list' ] : __( 'Add to wish list', 'edd-wish-lists' ),
			'icon'		=> $edd_options[ 'edd_wl_icon' ] ? $edd_options[ 'edd_wl_icon' ] : 'gift',
			'option'	=> 1, 		// default variable pricing option
			'style'		=> $edd_options[ 'edd_wl_button_style' ] ? $edd_options[ 'edd_wl_button_style' ] : 'button',
		), $atts, 'edd_wish_lists_add' )
	);

	$edd_wish_list = edd_wish_lists();
    $edd_wish_list::$shortcode = true;

    $args = array(
		'download_id' 	=> $id,
		'text' 			=> $text,
		'icon'			=> $icon,
		'style'			=> $style,
		'action'		=> 'edd_wl_open_modal',
		'class'			=> 'edd-wl-open-modal edd-wl-action before',
		'price_option'	=> $option,
	);

	$content = edd_wl_wish_list_link( $args );

	return $content;
}
add_shortcode( 'edd_wish_lists_add', 'edd_wl_add_to_list_shortcode' );
