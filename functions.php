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
 * Enqueue scripts and styles.
 */
function herblife_scripts() {
	wp_enqueue_style( 'herblife-style', get_stylesheet_uri() );

	//wp_enqueue_script('googlemapsapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDkumcU-Bh1GOJ3VqkVNnl04RvBxWSNG9U'); 

	//wp_enqueue_script('gmaps-init', get_template_directory_uri().'/gmaps.js', array('jquery'),'20200223' ,true);

	wp_enqueue_script( 'herblife-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'herblife-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Slick Slider Setting in front page top */
	// enqueue slick slider if it is the front page
	if ( is_front_page() || is_page('14') ) {

		// call in the js files
		wp_enqueue_script( 
			'hlproject-slickslider', 
			get_template_directory_uri().'/js/slick.min.js', 
			array('jquery'), 
			'20200128', 
			true );

		wp_enqueue_script( 
			'hlproject-slickslider-settings', 
			get_template_directory_uri().'/js/slick-settings.js', 
			array('jquery', 
			'hlproject-slickslider'), 
			'20200225', 
			true );

	}

	/**
	 * Product Subscription Enqueues
	 */

	if ( is_singular( 'product' ) ) {
		wp_enqueue_script( 
			'hl-product-subscription', 
			get_template_directory_uri().'/js/product-subscription.js', 
			array('jquery'), 
			'20200128', 
			true );
	}
	
}
add_action( 'wp_enqueue_scripts', 'herblife_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Extra Settings',
		'menu_title'	=> 'Extra Settings',
		'menu_slug' 	=> 'extra_settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Top Banner',
		'menu_title'	=> 'Top Banner',
		'parent_slug'	=> 'extra_settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Top Logo',
		'menu_title'	=> 'Top Logo',
		'parent_slug'	=> 'extra_settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Bottom Logo',
		'menu_title'	=> 'Bottom Logo',
		'parent_slug'	=> 'extra_settings',
	));
	

}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hl_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Support', 'hl' ),
		'id'            => 'footer-support',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer About', 'hl' ),
		'id'            => 'footer-about',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Address', 'hl' ),
		'id'            => 'footer-address',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Social Media', 'hl' ),
		'id'            => 'social',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Social Media', 'hl' ),
		'id'            => 'top-social',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Feed', 'hl' ),
		'id'            => 'instagram-feed',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Contact Form', 'hl' ),
		'id'            => 'contact-form',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Product Category Menu', 'hl' ),
		'id'            => 'product-category-menu',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Store Locator', 'hl' ),
		'id'            => 'store-locator',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Event Map', 'hl' ),
		'id'            => 'event-map',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Newsletter', 'hl' ),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Add widgets here.', 'hl' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );

}

add_action( 'widgets_init', 'hl_widgets_init' );

/**
 * Adding image size for Event page
 */

add_image_size( 'event-thumbnail', 200, 200, array( 'left', 'top' ) );


/**
 * Hooks - Single Product Page
 */
require get_template_directory() . '/inc/hooks-product.php';

/**
 * Google API
 */
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDkumcU-Bh1GOJ3VqkVNnl04RvBxWSNG9U';
	return $api;
}  
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
* Custom Post Type: Locations
*/
function cpt_location() {
	$labels = array(
		"name" => __( "Locations", "text_domain" ),
		"singular_name" => __( "Location", "text_domain" ),
	);
	$args = array(
		"label" => __( "Locations", "text_domain" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "location", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title" ),
	);
	register_post_type( "location", $args );
}
add_action( 'init', 'cpt_location' );

// Locations Map Shortcode - [location_map]
function location_map (){
	$args = array(
		'post_type' => 'product',
		'post_taxonomy' => 'events',
	);
	$query = new WP_QUERY($args);
	if ( $query->have_posts() ) {
	ob_start(); ?>
	<div class="acf-map" data-zoom="16" style="overflow: hidden; position: relative;">
		<?php while ( $query->have_posts() ) {
			$query->the_post();
			$address = get_field('location');
			$icon = get_template_directory_uri().'/images/green-marker.png';
			?>
			<div class="marker" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>" data-img="<?php echo $icon; ?>">
				<div class="inside-marker">
					<h5><?php echo esc_html( $address['address'] ); ?></h5>
				</div>
			</div>
	<?php } ?>
	</div>
	<?php wp_reset_postdata();
	}
	return ob_get_clean();    
}
add_shortcode( 'location_map', 'location_map' );
 
 

