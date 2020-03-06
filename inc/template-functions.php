<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Herb_&_Life
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function herblife_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'herblife_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function herblife_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'herblife_pingback_header' );

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
