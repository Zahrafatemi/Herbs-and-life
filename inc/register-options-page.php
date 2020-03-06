<?php if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Extra Settings',
		'menu_title'	=> 'Extra Settings',
		'menu_slug' 	=> 'extra_settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
?>