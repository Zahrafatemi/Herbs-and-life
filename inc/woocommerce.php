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
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function herblife_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php herblife_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/* --------------------------------------------------
 * # Hooks - Single Product Page
 * -------------------------------------------------- /

 /**
 * Remove SKU / Categories
 */
function hl_product_remove_actions() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar',10);
}
add_action( 'init', 'hl_product_remove_actions');


/* --------------------------------------------------
 * # Variations
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

/**
 * Remove tabs from Events pages
 */
function hl_remove_products_tabs_from_events( $tabs ){
	if( is_singular( 'product' ) && ( has_term( 'Events', 'product_cat' ) ) ){
		foreach( $tabs as $tab ){
			unset( $tab );
		}
		return $tabs;
	}
	
}
add_filter( 'woocommerce_product_tabs', 'hl_remove_products_tabs_from_events', 1);