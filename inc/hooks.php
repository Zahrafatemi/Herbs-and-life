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
	return ' ... <span class="read-more">Read more</span>';
}
add_action( 'excerpt_more', 'hl_replace_excerpt_more' );