<?php if( function_exists('acf_add_options_page') ) {
	
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
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Contact',
		'menu_title'	=> 'Footer Contact',
		'parent_slug'	=> 'extra_settings',
	));
	

}
?>