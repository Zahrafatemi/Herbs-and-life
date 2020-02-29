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
<?php if(is_front_page() || is_home()|| is_page(array(14, 327, 103))):?>
		<section class = "newletter">
			<h2>SUBSCRIBE NEWSLETTER</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			
					<?php if(is_active_sidebar('newsletter')){
						dynamic_sidebar('newsletter');
					}
					?>  
			
		</section>
		<?php endif;?> 
	</div><!-- #content -->


	<footer id="colophon" class="site-footer">

			<div class="bottom-logo">
				<?php $image = get_field('bottom_logo', 'option');
					$thumb = wp_get_attachment_image_src($image,'medium');
				?>
				<img src="<?php echo $thumb[0]; ?>"/>
			</div>
		<div class="site-info">
		<?php
			if(is_active_sidebar('footer-support')
			&& is_active_sidebar('footer-about')
			&& is_active_sidebar('footer-address')
			&& is_active_sidebar('social'))
			{
				dynamic_sidebar('footer-support');
				dynamic_sidebar('footer-about');
				dynamic_sidebar('footer-address');
				dynamic_sidebar('social');
			}
		?>
			<p>copyright© HERB&LIFE 2020</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
