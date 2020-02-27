<?php 
//This is more functional style
function hl_register_custom_post_types() {
//Register Award CPT
	$labels = array(
		'name'               => _x( 'Awards', 'post type general name' ),
		'singular_name'      => _x( 'Award', 'post type singular name' ),
		'menu_name'          => _x( 'Awards', 'admin menu' ),
		'name_admin_bar'     => _x( 'Award', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'award'  ),
		'add_new_item'       => __( 'Add New Award'  ),
		'new_item'           => __( 'New Award' ),
		'edit_item'          => __( 'Edit Award' ),
		'view_item'          => __( 'View Award' ),
		'all_items'          => __( 'All Awards'  ),
		'search_items'       => __( 'Search Awards' ),
		'parent_item_colon'  => __( 'Parent Awards:' ),
		'not_found'          => __( 'No awards found.' ),
		'not_found_in_trash' => __( 'No awards found in Trash.' ),
		'insert_into_item'   => __( 'Insert into award'),
		'uploaded_to_this_item' => __( 'Uploaded to this award'),
		);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'awards'),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-awards',
		'supports'           => array( 'title', 'editor' )
		);
	
	register_post_type( 'hl-award', $args );


	//Register Testomonial CPT
	$labels = array(
        'name'               => _x( 'Testimonials', 'post type general name'  ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'  ),
        'menu_name'          => _x( 'Testimonials', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial'  ),
        'all_items'          => __( 'All Testimonials' ),
        'search_items'       => __( 'Search Testimonials' ),
        'parent_item_colon'  => __( 'Parent Testimonials:' ),
        'not_found'          => __( 'No testimonials found.' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-editor-quote',
        'supports'           => array( 'title', 'editor' ),
		'template'           => array( array( 'core/quote' ) ),
		'template_lock'  => 'all'
    );

	register_post_type( 'hl-testimonial', $args );
	


}
add_action( 'init', 'hl_register_custom_post_types' );

//When activating this theme, flush permalinks
function hl_rewrite_flush() {
	hl_register_custom_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'hl_rewrite_flush' );


