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
		<section class = "newletter">
			<h2>SUBSCRIBE NEWSLETTER</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			
			<?php echo do_shortcode ('[mc4wp_form id="392"]'); ?>
			
		</section>
		<?php endif;?> 
	</div><!-- #content -->


	<footer id="colophon" class="site-footer">

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
		<div class="site-info">
		<?php
			if(is_active_sidebar( 'footer-support' )
			&& is_active_sidebar( 'footer-about' )
			&& is_active_sidebar( 'social' ))
			{
				dynamic_sidebar( 'footer-support' );
				dynamic_sidebar( 'footer-about' );
			
				dynamic_sidebar( 'social' );
			}
		?>
			<p>copyright© HERB&LIFE <?php echo date("Y"); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
