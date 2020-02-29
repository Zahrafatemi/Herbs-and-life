<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Herb_&_Life
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'herblife' ); ?></a>

	<header id="masthead" class="site-header">
	<!-- Top Banner Nav -->
	<div class = "top-banner">
		<?php the_field('top_banner', 'option'); ?>
	</div>

	

	<!-- Second Banner Nav (Social Menu, Search, Cart, Login(NTH))-->
		 

		<div class = "top-header">
		<?php if(is_active_sidebar('top-social')){
				dynamic_sidebar('top-social');
			}
		?>
	
		<!-- Cart from Woocommerce See woocommerce.php -->	
		<?php
		if ( function_exists( 'herblife_woocommerce_header_cart' ) ) {
			herblife_woocommerce_header_cart();
		}
		?>
		
		</div>
		<!-- Account from Woocommerce See woocommerce.php -->	
		<span class="account">
		<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account',''); ?>"><img src= "<?php echo get_template_directory_uri();?>/images/myaccount-logo.png">
		<?php _e('My Account',''); ?>
		
		</a>
		</span>

		<div class="site-branding">
		
		
			
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php bloginfo( 'name' ); ?> logo">
			
				<?php $image = get_field('top_logo', 'option');
					$thumb = wp_get_attachment_image_src($image,'medium');
				?>
				<img src="<?php echo $thumb[0]; ?>"/>
		
			</a></h1>
				
		
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'herblife' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

		<nav id="category-navigation" class="category-navigation">
		<?php 
		
		 if(is_product_category() || is_product()||is_page(14)){
		if(is_active_sidebar('product-category-menu')){
				dynamic_sidebar('product-category-menu');
			}
		 }
		?>
		</nav><!-- #category-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
