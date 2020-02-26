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

			<section class="home-intro">
				<?php if(get_field('home_intro_title') ):?>	
				<h1><?php the_field('home_intro_title')?></h1>
				<?php endif;?>

				<?php if(get_field('home_intro') ):?>	
				<p><?php the_field('home_intro')?></p>
				<?php endif;?>
				
			</section>
			<section class ="featured-products">
				<h2>Featured Products</h2>
				<?php if(get_field('home_featured') ):?>
					<?php while(has_sub_field('home_featured')): 
				$images = get_sub_field('featured_product');
				$title = get_sub_field('featured_title');
				$text = get_sub_field('featured_text');
				$buttonText = get_sub_field('featured_button_label');
				$size = 'medium'; // (thumbnail, medium, large, full or custom size)
				?>
				<?php if($images):
				foreach($images as $image):
				echo wp_get_attachment_image( $image, $size ); ?>
				<div class="featured-banner-text-box">
							<h3>
							<?php echo $title?>
							</h3>
							<?php if($text):?>
							<p>
							<?php echo $text?>
							<p>
							<?php endif; ?>
							<?php if($buttonText):
								echo '<button src="get_permalink($image->ID)">'.$buttonText.'</button>'
							?>
							<?php endif; ?>
				<?php endforeach;?>
				<?php endif; ?>
					</div>	
				
				<?php
				
				// 	$featured_product = new WP_Query( $args );

				// 	if ( $featured_product->have_posts() ) : 

				// 	echo '<div class="woocommerce columns-2"><ul class="products">';

				// 	while ( $featured_product->have_posts() ) : $featured_product->the_post();

				// 	$post_thumbnail_id     = get_post_thumbnail_id();
				// 	$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'shop-feature');
				// 	$product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
				// ?>

				// 	<li class="product">
				// 		<a href="<?php the_permalink();?>">
				// 			<img src="<?php echo $product_thumbnail[0];?>" alt="<?php echo $product_thumbnail_alt;?>">
				// 			<h3 class="woocommerce-loop-product__title"><?php the_title();?></h3>
				// 			<button class="yellow-but">VIEW PRODUCT</button>
				// 		</a>    
				// 	</li>
				<?php 
				// endwhile; 

				// echo '</ul></div>';

				// endif; 
						
				// wp_reset_query();
				// ?>  
				<?php endwhile; ?>
				<?php endif;?>        
<!-- Featured products loop -->  
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

get_footer();
