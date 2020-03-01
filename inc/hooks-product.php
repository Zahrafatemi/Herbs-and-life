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


 /**
 * Remove 'Choose an Option' from variations dropdown
 */
function hl_remove_variations_option_text( $args ) {
	$args[ 'show_option_none' ] = '';
	return $args;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'hl_remove_variations_option_text' );

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
add_filter( 'woocommerce_product_tabs', 'hl_product_rename_adtl_info_tab');

/**
 * Add a custom product data tab
 */
function hl_product_new_tab( $tabs ) {
	if( is_singular( 'product' ) ) ){
		$tabs[ 'ingredients' ] = array(
			'title' 	=> __( 'Ingredients', 'woocommerce' ),
			'priority' 	=> 12,
			'callback' 	=> 'hl_product_new_tab_content'
		);

		return $tabs;		
	}
}

function hl_product_new_tab_content() {
	if( function_exists( 'get_field' ) ){
		$tabContent = get_field( 'ingredients' );
		if( $tabContent ){
			echo $tabContent;
		}
	}
}
add_filter( 'woocommerce_product_tabs', 'hl_product_new_tab');

/**
 * Remove tabs from Events pages
 */
function hl_remove_products_tabs_from_events( $tabs ){
	if( is_singular( 'product' ) && (has_term( 'Events', 'product_cat' )) ){
		foreach( $tabs as $tab ){
			unset( $tab );
		}
		return $tabs;
	}
	
}
add_filter( 'woocommerce_product_tabs', 'hl_remove_products_tabs_from_events', 1);

