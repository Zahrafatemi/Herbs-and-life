<?php

/**
 * Herb & Life Hooks for Single Product Pages
 */

 /**
 * Remove SKU / Categories
 */
function hl_product_remove_sku_categories() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'init', 'hl_product_remove_sku_categories');

function hl_product_rename_tabs( $tabs ) {
	$tabs[ 'additional_information' ][ 'title' ] = __( 'Shipping' );

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'hl_product_rename_tabs', 98 );

/**
 * Add a custom product data tab
 */
function hl_product_new_tab( $tabs ) {	
	$tabs[ 'ingredients' ] = array(
		'title' 	=> __( 'Ingredients', 'woocommerce' ),
		'priority' 	=> 12,
		'callback' 	=> 'hl_product_new_tab_content'
	);

	return $tabs;
}

function hl_product_new_tab_content() {
	if( function_exists( 'get_field' ) ){
		$tabContent = get_field( 'ingredients' );
		if( $tabContent ){
			echo $tabContent;
		}
	}
}
add_filter( 'woocommerce_product_tabs', 'hl_product_new_tab' );