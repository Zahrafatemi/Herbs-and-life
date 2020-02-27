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

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
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
