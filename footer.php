<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Herb_&_Life
 */

?>
<?php if(is_front_page() || is_home()|| is_page(array(14, 327, 103))||(is_product() && !has_term('events', 'product_cat', $post->ID))):?>
		<section class = "newsletter">
		<div class="newsletter-wrapper">
				<div class="newsletter-image-left"></div><!-- .newsletter-image-left -->
				<h2>GET IN TOUCH !</h2>
				<p>Join our newsletter to receive updates news from our blog. <br/>
			 Learn about our products, services and get exiciting discounts ahead of time.</p>
			 <?php echo do_shortcode ('[mc4wp_form id="392"]'); ?>
		<div class="newsletter-image-right"></div><!-- .newsletter-image-right-->
		</div><!-- .newsletter-wrapper -->
		</section>
		<?php endif;?> 
	</div><!-- #content -->


	<footer id="colophon" class="site-footer">
	<div class="footer-mqm-wrapper">
			<div class="bottom-logo">
				<?php if( function_exists( 'get_field' ) ){
					if( get_field( 'bottom_logo', 'option' ) ){
						$image = get_field('bottom_logo', 'option');
						$thumb = wp_get_attachment_image_src($image,'medium');
					}
				} ?>
				<img src="<?php if($thumb[0]) { echo esc_url( $thumb[0]);} ?>"/>
			</div>
			<div class = "company-info">
				<ul>
					<li><?php the_field('company_name', 'option'); ?></li>
					<li><?php the_field('company_address', 'option'); ?></li>
					<li><?php the_field('company_phone_number', 'option'); ?></li>
					<li><?php the_field('company_email', 'option'); ?></li>
				</ul>
			</div>
		</div><!-- .footer-mqm-wrapper -->
		<div class="site-info">
				<div class="footer-menus">
						<nav id="footer-navigation1" class="footer-navigation">
							<h3>Order & Support</h3>
							<?php 
								wp_nav_menu(
									array(
											'theme_location' => 'fotter-1',
											'memu_id' =>'footer1-menu'
									)
								);
							?>
						</nav>
						<nav id="footer-navigation2" class="footer-navigation">
							<h3>About US</h3>
							<?php 
								wp_nav_menu(
									array(
											'theme_location' => 'fotter-2',
											'memu_id' =>'footer2-menu'
									)
								);
							?>
						</nav>
					</div><!-- .footer-menu -->
					<div class="footer-nav-wrapper-left">
						<nav id="social-navigation" class="social-navigation">
							<?php 
								wp_nav_menu(
									array(
											'theme_location' => 'social-footer-menu',
											'memu_id' =>'social-footer-menu',
											
									)
								);
							?>
						</nav>
					
					<p>© HERB&LIFE <?php echo date("Y"); ?></p>
					</div><!-- .footer-nav-wrapper-left -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
