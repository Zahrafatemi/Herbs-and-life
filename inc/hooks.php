<?php
/**
 * Hooks
 *
 * @package Herb_&_Life
 */

/* --------------------------------------------------
 * # Blog Page
 * -------------------------------------------------- /

 /**
 * Replace excerpt from [...] to link
 */
function hl_replace_excerpt_more( $more ) {
	return ' ... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">Read more</a> ';
}
add_action( 'excerpt_more', 'hl_replace_excerpt_more' );