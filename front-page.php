<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

get_header();
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<section class = "hero-slide slider">
		
		<?php 
		if(get_field('hero_image_slider') ):?>
		
		
			<?php while(has_sub_field('hero_image_slider')): 
			$images = get_sub_field('hero_image');
			$header = get_sub_field('hero_header');
			$description = get_sub_field('hero_description');
			$buttonText = get_sub_field('hero_button_label');
			$buttonLink = get_sub_field('hero_link');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			?>
		 
		 	<div class = "hero-banner">
					
					<?php echo wp_get_attachment_image( $images, $size ); ?>
            		<div class="hero-banner-text-box">
						<h3>
						<?php echo $header?>
						</h3>
						<?php if($description):?>
						<p>
						<?php echo $description?>
						<p>
						<?php endif; ?>
						<?php if($buttonText):
							echo '<button src=".$buttonLink.">'.$buttonText.'</button>'
						?>
						<?php endif; ?>
					</div>	
			</div>	
						
			<?php endwhile; ?>
						
	
					
		<?php endif; ?>
			
		</section>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
