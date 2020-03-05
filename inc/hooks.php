<?php
/**
 * Hooks
 *
 * @package Herb_&_Life
 */

/* --------------------------------------------------
 * # Excerpt
 * -------------------------------------------------- /

 /**
 * Change excerpt length
 */
function hl_excerpt_length() {
	return 20;
}

/**
 * Replace [...] in excerpt
 */
function hl_excerpt_more() {
	return ' ... <span class="read-more">Read more</span>';
}

/**
 * Excerpt filters
 */
function hl_excerpt(){
	global $post;
	$excerpt_text = get_the_excerpt();
	if( function_exists( 'get_field' ) ){
		// If ACF description field exists, use this as excerpt text instead
		$description = get_field( 'description' );
		if( $description ){
			$excerpt_text = $description;
		}
	}
	$excerpt_length = hl_excerpt_length();
	$excerpt_more = hl_excerpt_more();
	$excerpt = wp_trim_words( $excerpt_text, $excerpt_length, $excerpt_more );
	return $excerpt;
}
add_filter( 'the_excerpt', 'hl_excerpt' );	
