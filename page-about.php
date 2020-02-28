<?php
/**
 * The template for Contact page
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

		<?php if ( has_post_thumbnail() ):?>
			<div class = "about-featured-image">
			<?php the_post_thumbnail();?>
			</div>
			<?php endif;  ?>
	

		<section class="about-intro">
				<?php if(get_field('mission_title') ):?>	
				<h2><?php the_field('mission_title')?></h2>
				<?php endif;?>

				<?php if(get_field('mission') ):?>	
				<p><?php the_field('mission')?></p>
				<?php endif;?>
				
		</section>
		<section>
			<h2>History</h2>
			
			<div class = "history-image">
			<?php if(function_exists('get_field')):
				$about_image_id = get_field('history_image');
				
			 if($about_image_id){
			echo wp_get_attachment_image($about_image_id, 'large', '', array('class'=>'alignleft'));
			} ?>
				<?php echo $image; ?>
			<?php endif;?> 
			</div>
			<div class ="history-text">
			<?php if(get_field('history_title') ):?>	
			<h2><?php the_field('history_title')?></h2>
			<?php endif;?>

			<?php if(get_field('history') ):?>	
			<p><?php the_field('history')?></p>
			<?php endif;?>
			</div>
		</section>

		<section class="awards">
			<h2>Awards & Certificates</h2>
			<?php 
				$args = array(
					'post_type' => 'hl-award',
					'posts_per_page' => -1,   // If you want to all posts, set up -1  default minimum 10
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						the_content();

					}
					wp_reset_postdata();
				} 
			?>
		</section>

		<section>
		<h2>Our Supporters</h2>
		<?php if(is_active_sidebar('instagram-feed')){
				dynamic_sidebar('instagram-feed');
			}
		?>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
