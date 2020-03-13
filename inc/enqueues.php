<?php
/**
 * Enqueue scripts and styles.
 */
function herblife_scripts() {
	/**
	 * Fonts
	 */
	wp_enqueue_style( 'herblife-font', 'https://use.typekit.net/hgw2ysu.css' );

	/**
	 * Template stylesheet
	 */
	wp_enqueue_style( 'herblife-style', get_stylesheet_uri() );

	/**
	 * Events Button JS
	 */
	if(has_term('events', 'product_cat')){
		wp_enqueue_script( 'herblife-past-events', get_template_directory_uri() . '/js/past-events-button.js', array(), '20200301', true );
	}

	/**
	 * Event Page Google Maps
	 */
	if('product'== get_post_type() && has_term('events', 'product_cat', $post->ID)){
		wp_enqueue_script('googlemapsapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDkumcU-Bh1GOJ3VqkVNnl04RvBxWSNG9U'); 
		wp_enqueue_script('gmaps-init', get_template_directory_uri().'/js/gmaps.js', array('jquery'),'20200223' ,true);
	}

	/**
	 * Navigation JS
	 */
	wp_enqueue_script( 'herblife-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'herblife-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 * Comments JS
	 */
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
	 * Isotope for Blog page
	 */
    wp_enqueue_script( 
        'hl-isotope', 
        get_template_directory_uri().'/js/isotope.pkgd.min.js', 
        array('jquery'), 
        '20200304', 
        true );
        
    wp_enqueue_script( 
        'hl-isotope-settings', 
        get_template_directory_uri().'/js/isotope.js', 
        array('jquery', 
        'hl-isotope'), 
        '20200304', 
		true );
	 
	/**
	 * Product Subscription Enqueues
	 */
	if ( is_singular( 'product' ) && ( has_term( 'Subscription', 'product_cat' ) ) ) {
		wp_enqueue_script( 
			'hl-product-subscription', 
			get_template_directory_uri().'/js/product-subscription.js', 
			array('jquery'), 
			'20200128', 
			true );
	}

	/**
	 * Custom Giftwrapping
	 */

	if ( is_singular( 'product' ) ) {
		wp_register_script( 
			'hl-custom-giftwrapping', 
			get_template_directory_uri().'/js/custom-giftwrapping.js', 
			array('jquery'), 
			'20200129', 
			true );

		// Pass the post ID onto the jQuery file
		wp_localize_script( 'hl-custom-giftwrapping', 'post', array(
			'id' => $post->ID
		) );

		wp_enqueue_script( 'hl-custom-giftwrapping' );
	}

	/**
	 * Header toggle JS
	 */	
	wp_enqueue_script( 
		'header-toggle', 
		get_template_directory_uri().'/js/header-toggle.js', 
		array('jquery'), 
		'20200306', 
		true );
}
add_action( 'wp_enqueue_scripts', 'herblife_scripts' );