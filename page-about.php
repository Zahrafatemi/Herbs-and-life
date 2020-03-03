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
			
			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php if ( has_post_thumbnail() ):?>
				<div class = "about-featured-image">
					<?php the_post_thumbnail();?>
				</div><!--.about-featured-image-->
			<?php endif;  ?>
	
			<section class="about-intro">
				<?php if( function_exists( 'get_field' ) ){
					$mission_title 	= get_field( 'mission_title' );
					$mission_text	= get_field( 'mission' ); 
				}?>

				<h2 class="mission-title"><?php if( $mission_title ){ echo $mission_title; }?></h2>
				<p class="mission-text"><?php if( $mission_text ){ echo $mission_text; }?></p>
			</section><!--.about-intro-->

			<section class="about-history">
				<h2>History</h2>
				
				<div class="history-image">
					<?php if( function_exists( 'get_field' ) ){
						$about_image_id = get_field( 'history_image' );

						if( $about_image_id ){
							echo wp_get_attachment_image( $about_image_id, 'large', '', array( 'class'=>'alignleft' ) );
						}

						echo $image;
					}?>
				</div><!--.history-image-->
				
				<div class ="history-text">
					<?php if( function_exists( 'get_field' ) ){
						$history_title 	= get_field( 'history_title' );
						$history	 	= get_field( 'history' );
					}?>

					<h2 class="history-title"><?php if( $history_title ){ echo $history_title; }?></h2>
					<p class="history"><?php if( $history ){ echo $history; }?></p>
				</div><!--.history-text-->
			</section><!--.about-history-->

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
			</section><!--.awards-->

			<section class="supporters">
				<h2>Our Supporters</h2>
					<?php echo do_shortcode ("[instagram-feed cols=6]"); ?>
			</section><!--.supporters-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
