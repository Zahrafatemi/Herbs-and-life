<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Herb_&_Life
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function herblife_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'herblife_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function herblife_woocommerce_scripts() {

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'herblife-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'herblife_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function herblife_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'herblife_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function herblife_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'herblife_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function herblife_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'herblife_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function herblife_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'herblife_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function herblife_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'herblife_woocommerce_related_products_args' );

if ( ! function_exists( 'herblife_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function herblife_woocommerce_product_columns_wrapper() {
		$columns = herblife_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'herblife_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'herblife_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function herblife_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'herblife_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'herblife_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function herblife_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'herblife_woocommerce_wrapper_before' );

if ( ! function_exists( 'herblife_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function herblife_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'herblife_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'herblife_woocommerce_header_cart' ) ) {
			herblife_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'herblife_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function herblife_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		herblife_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'herblife_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'herblife_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function herblife_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'herblife' ); ?>">
			<?php
			// $item_count_text = sprintf(
			// 	/* translators: number of items in the mini cart. */
			// 	_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'herblife' ),
			// 	WC()->cart->get_cart_contents_count()
			// );
			?>
			<span class="count">
				<img src= "<?php echo get_template_directory_uri();?>/images/assets/header/cart.svg">
				<div class="count-text"><?php echo esc_html( WC()->cart->get_cart_contents_count()); ?></div>
			</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'herblife_woocommerce_header_cart' ) ) {
	function herblife_woocommerce_header_cart() {
         herblife_woocommerce_cart_link();
    }
}

/* --------------------------------------------------
 * # Hooks - Single Product Page
 * -------------------------------------------------- /

/**
 * Move product images inside product summary on single event pages
 */
function hl_move_product_images( ) {
	if( (has_term('events', 'product_cat', $post->ID)) ){
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 1 );		
	}
}
add_filter( 'woocommerce_before_single_product_summary', 'hl_move_product_images' );

/**
 * Enclose single product summary items in a div
 */
function hl_product_summary_opening_div() {
	echo '<div class="product-summary">';
}
function hl_product_summary_closing_div() {
	echo '</div><!--.product-summary-->';
}
add_action( 'woocommerce_single_product_summary', 'hl_product_summary_opening_div', 1 );
add_action( 'woocommerce_after_single_product_summary', 'hl_product_summary_closing_div', 1 );

/**
 * Enclose after single_product_summary and after_single_product items in a div
 */
function hl_after_product_summary_opening_div() {
	echo '<div class="after-product-summary">';
}
function hl_after_product_summary_closing_div() {
	echo '</div><!--.after-product-summary-->';
}
add_action( 'woocommerce_after_single_product_summary', 'hl_after_product_summary_opening_div', 1 );
add_action( 'woocommerce_after_single_product', 'hl_after_product_summary_closing_div' );

/**
 * Remove SKU / Categories
 */
function hl_product_remove_sku_cat() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar',10);
}
add_action( 'init', 'hl_product_remove_sku_cat');

/**
 * Add quantity label to the cart
 */
function hl_add_quantity_label_to_cart() {
	echo '<span class="quantity-label">Quantity: </span>';
}
add_action( 'woocommerce_before_add_to_cart_quantity', 'hl_add_quantity_label_to_cart' );

/* --------------------------------------------------
 * ## Product Data Tabs
 * -------------------------------------------------- /

/**
 * Add a custom product data tab
 */
function hl_product_new_tab( $tabs ) {
	if( is_singular( 'product' ) ){
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

/* --------------------------------------------------
 * ## Variations
 * -------------------------------------------------- /
 /**
 * Remove 'Choose an Option' from variations dropdown
 */
function hl_remove_variations_option_text( $args ) {
	$args[ 'show_option_none' ] = '';
	return $args;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'hl_remove_variations_option_text' );

 /**
 * Remove Reset Variations
 */
function hl_remove_reset_variations() {
	return '';
}
add_filter('woocommerce_reset_variations_link', 'hl_remove_reset_variations');

 /**
 * Hide variable product price range
 * SOURCE: https://learnwoo.com/hide-price-range-woocommerce-variable-products/
 */
function hl_remove_variation_price_range( $v_price, $v_product ) {
	$v_product_types = array( 'variable' );

	if ( in_array ( $v_product->product_type, $v_product_types ) && !(is_shop()) ) {
		return '';
	}

	return $v_price;
}
add_filter( 'woocommerce_get_price_html', 'hl_remove_variation_price_range', 10, 2 );

 /**
 * Move selected variation price to below product name
 */
function hl_move_selected_variation_price() {
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
	add_action( 'woocommerce_before_variations_form', 'woocommerce_single_variation', 10 );
}
add_action( 'woocommerce_before_add_to_cart_form', 'hl_move_selected_variation_price', 10 );

/* --------------------------------------------------
 * # Hooks - Products Page
 * -------------------------------------------------- /

/* --------------------------------------------------
 * ## Promotional Banners
 * -------------------------------------------------- /

 /**
 * Output a template part
 * SOURCE: https://stackoverflow.com/questions/5817726/wordpress-save-get-template-part-to-variable
 */
function hl_load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

 /**
 * Shuffle an associative array
 */
function hl_shuffle_arr( $arr ) {
	$keys = array_keys( $arr );

	shuffle( $keys );

	foreach( $keys as $key ) {
		$shuffled[ $key ] = $arr[ $key ];
	}

	return $shuffled;
  }


/**
 * Sort array based on the element's priority value
 * Where the higher priority,
 * the earlier it is placed in the array
 */
function hl_sort_by_priority( $x, $y ){
	return $x[ 'priority' ] < $y[ 'priority' ];
}

/**
 * Reorder Promotional Banners array depending on Display Order ACF
 */
function hl_reorder_promotional_banners( $promoBannersArr ) {
	if( function_exists( 'get_field' ) ) {

		$settings = get_field( 'promotional_banners_settings', 'options' );
		$displayOrder = $settings[ 'display_order' ];

        if( $displayOrder == 'random' ) {
			
			$promoBannersArr = hl_shuffle_arr( $promoBannersArr );
			
        }else if( $displayOrder == 'priority' ) {

			usort( $promoBannersArr, 'hl_sort_by_priority' );

		}
	}
	return $promoBannersArr;
}

/**
 * Get promotional banners ACFs and convert to template
 */
function hl_get_promotional_banners() {
	if( function_exists( 'have_rows' ) ){
		if( have_rows( 'promotional_banner', 'option' ) ){

			$promotionalBannersData = [];

			while( have_rows( 'promotional_banner', 'option' ) ){

				the_row();

				$promotionalBanner = array(
					'title' 				=> get_sub_field( 'title' ),
					'size' 					=> get_sub_field( 'size' ),
					'style'					=> get_sub_field( 'style' ),
					'heading_text' 			=> get_sub_field( 'heading_text' ),
					'heading_text_color'	=> get_sub_field( 'heading_text_colour' ),
					'subheading_text' 		=> get_sub_field( 'subheading_text' ),
					'subheading_colour'		=> get_sub_field( 'subheading_text_colour' ),
					'background_image' 		=> get_sub_field( 'background_image' ),
					'background_colour' 	=> get_sub_field( 'background_colour' ),
					'link' 					=> get_sub_field( 'link' ),
					'priority' 				=> get_sub_field( 'priority' ),
					'display'				=> get_sub_field( 'display' )
				);

				if( !$promotionalBanner[ 'display'][ 'display_all'] ){
					if( $promotionalBanner[ 'display' ][ 'display_page' ] ){
						if( is_product_category( $promotionalBanner[ 'display' ][ 'display_page' ][0] ) ){
							$promotionalBannersData[] = $promotionalBanner;
						}						
					}
				}else{
					$promotionalBannersData[] = $promotionalBanner;
				}
			}

			$reorderedPBD = hl_reorder_promotional_banners( $promotionalBannersData );

			foreach( $reorderedPBD as $promotionalBannerData ){
				set_query_var( 'promotionalBanner', $promotionalBannerData );

				$promotionalBanners[] = hl_load_template_part( 'template-parts/content', 'promo-banner' );

				set_query_var( 'promotionalBanner', false );
			}

			return $promotionalBanners;
		}
	}	
}

/**
 * Add new product loop with promotional banners
 */
function hl_new_product_loop() {

	if ( wc_get_loop_prop( 'total' ) ) {

		$i = 0;
		$j = 4;
		$k = 0;
		$promotionalBanners = hl_get_promotional_banners();

		echo '<ul class="product-list">';

		while ( have_posts() ) {

			the_post();
			
			do_action( 'woocommerce_shop_loop' );
			
			wc_get_template_part( 'content', 'product' );
			
			$i++;

			if( $i % $j == 0 ) {
				// Make sure there are promotional banners to display
				// and that counter does not exceed the number of banners ...
				if( $promotionalBanners && ( $k < count( $promotionalBanners ) ) ) {
					echo $promotionalBanners[ $k ];
					$k++;
					// Loop through the banners
					// after they have all been displayed
					// if( $k == count( $promotionalBanners ) ){
					// 	$k = 0;
					// }
				}
			}
			
		}
		echo '</ul>';
	}
}
add_action( 'woocommerce_after_shop_loop' , 'hl_new_product_loop', 5);