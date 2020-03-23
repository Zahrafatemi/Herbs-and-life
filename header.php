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
		<?php if( function_exists( 'get_field' ) ) {
			$topBanner = get_field('top_banner', 'option'); 
			if( $topBanner ){
				echo $topBanner;
			}
		}?>
	</div>

	

	<!-- Second Banner Nav (Social Menu, Search, Cart, Login(NTH))-->
		 
<div class="header-mb-wrapper">
		<div class = "top-header">
		
			
				
			<!-- For social menu -->
		<div class="icon-wrapper">
			<nav id="social-navigation" class="social-navigation">
					<?php 
						wp_nav_menu(
							array(
									'theme_location' => 'social-menu',
									'memu_id' =>'social-menu',
									
							)
						);
					?>
			</nav>
			<div class= "search-bar sb-dt">		
					<?php get_search_form();?>
			<!-- For search bar -->
				
			</div><!-- .search-bar -->	
				
		
			<!-- Cart from Woocommerce See woocommerce.php -->	
			<?php
			if ( function_exists( 'herblife_woocommerce_header_cart' ) ) {
				herblife_woocommerce_header_cart();
			}
			?>
		

			<!-- Account from Woocommerce See woocommerce.php -->	
			<span class="account">
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account',''); ?>"><img src= "<?php echo get_template_directory_uri();?>/images/assets/header/account.svg">
				<span class = "screen-reader-text">	<?php _e('My Account',''); ?></span>
				</a>
			</span><!--.account-->
			</div><!--.icon-wrapper-->
		</div><!--.top-header-->
		<div class="site-branding">
			<a class="site-logo top-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php bloginfo( 'name' ); ?> logo">
				<?php if( function_exists( 'get_field' ) ){
					if( get_field( 'top_logo', 'option' ) ){
						$image = get_field('top_logo', 'option');
						$thumb = wp_get_attachment_image_src($image,'medium');
					}
				} ?>
				<img src="<?php if( $thumb[0] ) { echo $thumb[0]; } ?>"/>
			</a>
		</div><!-- .site-branding -->

		
		</div><!-- .header-mb-wrapper -->

		<nav id="site-navigation" class="main-navigation">
		
			<button class="menu-toggle-open" aria-controls="" aria-expanded="false">
			<img id = "hm-icon" src="<?php echo get_template_directory_uri(); ?>/images/assets/header/hamburger.svg" alt="hm-icon">	
			
			<img id = "hm-icon-close" src="<?php echo get_template_directory_uri(); ?>/images/assets/header/hamburger-close.svg" alt="hm-icon">
			</button>

			<div class= "search-bar sb-mb">		
					<?php get_search_form();?>
			</div><!-- .search-bar -->
			
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->

		<nav id="category-navigation" class="category-navigation">
		<?php 
		
		 if((is_product_category() && !is_tax('product_cat', 'events'))|| is_page(14)||(is_product()&&!has_term('events', 'product_cat', $post->ID))):?>
		
		<nav id="category-navigation" class="category-navigation">
			<div class="category-nav-wrapper">
					<?php 
						wp_nav_menu(
							array(
									'theme_location' => 'category-menu',
									'memu_id' =>'category-menu'
							)
						);
					?>

			</div>
		</nav>
		<?php endif;?>
		</nav><!-- #category-navigation -->
				
	</header><!-- #masthead -->

	<div id="content" class="site-content">
