<?php
/**
 * Herb & Life functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Herb_&_Life
 */

if ( ! function_exists( 'herblife_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function herblife_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Herb & Life, use a find and replace
		 * to change 'herblife' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'herblife', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'herblife' ),
			'fotter-1' => esc_html__( 'Footer1', 'herblife' ),
			'fotter-2' => esc_html__( 'Footer2', 'herblife' ),
			'category-menu' => esc_html__( 'Category Menu', 'herblife' ),
			'social-menu'=>esc_html__('Social Menu', 'herblife'),
			'social-footer-menu'=>esc_html__('Social Footer Menu', 'herblife'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'herblife_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		

	}
endif;
add_action( 'after_setup_theme', 'herblife_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function herblife_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'herblife_content_width', 640 );
}
add_action( 'after_setup_theme', 'herblife_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function herblife_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'herblife' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'herblife' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'herblife_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * register custome CPT.
 */
require get_template_directory() . '/inc/register-cpt.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Enqueue scripts and styles
 */
require get_template_directory() . '/inc/enqueues.php';

/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory().'/inc/register-options-page.php';

/**
 * Custom image sizes
 */
// Featured Images
add_image_size( 'blog-thumbnail', 400, 600, true );

//  Events
add_image_size( 'event-thumbnail', 200, 200, array( 'left', 'top' ) );

/**
 * Google API
 */
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDkumcU-Bh1GOJ3VqkVNnl04RvBxWSNG9U';
	return $api;
}  
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function custom_admin_marker_dir() {

   //$admin_marker_dir = get_stylesheet_directory() . '/wpsl-markers/';
    $admin_marker_dir = get_stylesheet_directory() . '/images/markers/';

    return $admin_marker_dir;
}
add_filter( 'wpsl_admin_marker_dir', 'custom_admin_marker_dir' );

//define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url') ) . '/wpsl-markers/' );
define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url') ) . '/images/markers/' );

//Remoce Search placeholder from search bar
function wpforo_search_form( $html ) {

	$html = str_replace( 'placeholder="Search ', 'placeholder=""', $html );

	return $html;
}
add_filter( 'get_search_form', 'wpforo_search_form' );

/**
 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );

/**
 * Add WooCommerce Product Category as Body CSS Class
 */
function herblife_wc_product_cats_css_body_class( $classes ){
	if( is_singular( 'product' ) ) {
		$custom_terms = get_the_terms(0, 'product_cat');
		if ($custom_terms) {
			foreach ($custom_terms as $custom_term) {
			$classes[] = 'product_cat_' . $custom_term->slug;
			}
		}
	}
	return $classes;
}
add_filter( 'body_class', 'herblife_wc_product_cats_css_body_class' );


/**
 * All widgets on dashboard to be removed
 */
function wporg_remove_all_dashboard_metaboxes() {
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );


add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function wporg_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'wporg_dashboard_widget',                          // Widget slug.
        esc_html__( 'Welcome', 'wporg' ), // Title.
        'wporg_dashboard_widget_render'                    // Display function.
    ); 
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );
 
/**
 * Create the function to output the content of our Dashboard Widget.
 */
function wporg_dashboard_widget_render() {
    // Display whatever you want to show.
    esc_html_e( "Hello, Welcome to herb and life.", "wporg" );
}

// function remove_menus() {
// 	    remove_menu_page( 'edit.php' );
// 	}
// add_action ( 'admin_menu', 'remove_menus' );
function wd_admin_menu_rename(){
	global $menu;
	$menu[20][0] = 'Pages';
}
add_action( 'admin_menu', 'wd_admin_menu_rename');

function wpse_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;
    return array(
        'edit.php?post_type=page', // Pages
        'index.php', // Dashboard
        'separator1', // First separator
        'edit.php', // Posts
        'upload.php', // Media
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );

// Rename WooCommerce to Shop
 
add_action( 'admin_menu', 'rename_woocoomerce', 999 );
 
function rename_woocoomerce()
{
    global $menu;
 
    // Pinpoint menu item
    $woo = rename_woocommerce( 'WooCommerce', $menu );
 
    // Validate
    if( !$woo )
        return;
 
    $menu[$woo][0] = 'eCommerce';
}
 
function rename_woocommerce( $needle, $haystack )
{
    foreach( $haystack as $key => $value )
    {
        $current_key = $key;
        if(
            $needle === $value
            OR (
                is_array( $value )
                && rename_woocommerce( $needle, $value ) !== false
            )
        )
        {
            return $current_key;
        }
    }
    return false;
}	

/**
 * Remove product name from WooCommerce breadcrumb
 */
function herblife_change_breadcrumb( $breadcrumb ) {
	
  if( is_singular() ){
		array_pop( $breadcrumb );
	}
  
  return $breadcrumb;
}
add_filter( 'woocommerce_get_breadcrumb', 'herblife_change_breadcrumb' );


/**
 * Change the default "{qty} x {product-name} has(ve) been added to your cart" message to:
 * {qty} item(s) has/have been added to your cart.
 * from https://stackoverflow.com/a/53840271
 */
function custom_add_to_cart_message_html( $message, $products ) {
    $count = 0;
    foreach ( $products as $product_id => $qty ) {
        $count += $qty;
    }
    // The custom message is just below
    $added_text = sprintf( _n("%s item has %s", "%s items have %s", $count, "woocommerce" ),
        $count, __("been added to your cart.", "woocommerce") );

    // Output success messages
    if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
        $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue shopping', 'woocommerce' ), esc_html( $added_text ) );
    } else {
		$message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View cart', 'woocommerce' ), esc_html( $added_text ) );
		
    }
    return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'custom_add_to_cart_message_html', 10, 2 );

/**
 * Change redirect url for Back to Shop link
 */
function wc_empty_cart_redirect_url() {
	return 'https://herblife.bcitwebdeveloper.ca/shop/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );


/**
 * Change removed comment in Cart page
 */
function removed_from_cart_title( $message, $cart_item ) {
    $product = wc_get_product( $cart_item['product_id'] );

    if( $product )
        $message = sprintf( __('"%s" has been'), $product->get_name());

    return $message;
}
add_filter( 'woocommerce_cart_item_removed_title','removed_from_cart_title', 12, 2);

function cart_undo_translation( $translation, $text, $domain ) {

    if( $text === 'Undo?' ) {
        $translation =  __('Do you want to <span>Undo</span>?', $domain );
    }
    return $translation;
}
add_filter('gettext', 'cart_undo_translation', 35, 3);


/**
 * Display minimum price from multiple variations
 * Modified from : https://www.themelocation.com/how-to-display-minimum-price-from-multiple-variations-in-woocommerce/
 */
function custom_variation_price( $price, $product ) { 

	if( is_product_category() ){
		$price = 'From&nbsp;';
		$price .= wc_price($product->get_price()); 
		return $price;
	}else {
		return '';
	}
	
}
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);