<?php

/* --------------------------------------------------
 * # Hooks - Single Product Page
 * -------------------------------------------------- /

 /**
 * Remove SKU / Categories
 */
function hl_product_remove_sku_categories() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'init', 'hl_product_remove_sku_categories');


/* --------------------------------------------------
 * ## Product Data Tabs
 * -------------------------------------------------- /

/**
 * Rename 'Additional Information' tab to 'Shipping'
 */
function hl_product_rename_adtl_info_tab( $tabs ) {
	$tabs[ 'additional_information' ][ 'title' ] = __( 'Shipping' );

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'hl_product_rename_adtl_info_tab', 98 );

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

/**
 * Remove tabs from Events pages
 */
// function hl_remove_products_tabs_from_events( $tabs ){
// 	if( has_term('', 'events') ){
// 		foreach( $tabs as $tab ){
// 			unset( $tab );
// 		}	
// 		return $tabs;
// 	}
// }
// add_filter( 'woocommerce_product_tabs', 'hl_remove_products_tabs_from_events', 98);