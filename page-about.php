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
			<h1 class="screen-reader-text"><?php the_title(); ?></h1>

			<?php if( function_exists( 'get_field' ) ):?>
			
			<div class="about-banner">
				<div class="banner-wrapper">
					<h1 class="page-title title-on-banner"><?php the_title(); ?></h1>
					<?php 
					if(get_field('about_us_image')):
						echo wp_get_attachment_image( get_field('about_us_image') , 'full' );
					endif;
					?>
				</div><!--.banner-wrapper-->
				<div class="about-banner-text-box">
					<?php if( function_exists( 'get_field' ) ){
						$mission_title 	= get_field( 'mission_title' );
						$mission_text	= get_field( 'mission' ); 
					}?>
					<h3 class="mission-title"><?php if( $mission_title ){ echo $mission_title; }?></h3>
					<p class="mission-text description"><?php if( $mission_text ){ echo $mission_text; }?></p>
				</div><!--.about-banner-text-box-->
			</div><!--.about-banner-->
			<?php endif;  ?>
	 	<div class="wrapper pattern01">
			<section class="about-history">
				<h2>Our History</h2>
				
				<div class="history-box history-past">
					<?php if( function_exists( 'get_field' ) ){
						$history_title_past_year = get_field('history_title_past_year');
						$history_title_past_text = get_field('history_title_past_text');
						$history_content_past = get_field( 'history_past' );
						$history_image_past_id = get_field( 'history_image_past' );
					}?>
					<div class="history-image">
					<?php if( $history_image_past_id ){
								echo wp_get_attachment_image( $history_image_past_id, 'large', '', array( 'class'=>'alignleft' ) );
							}
					?>
					</div><!--.history-image-->
					<div class="history-text">
						<h3 class="history-title">
							<?php if( $history_title_past_year || $history_title_past_text): ?>
							<?php echo $history_title_past_year;?>
							<span>|</span>
							<?php echo $history_title_past_text;?>
							<?php endif;?>
						</h3>
						<p class="history-content-text">
							<?php if( $history_content_past ):?>
							<?php echo $history_content_past;?>
							<?php endif;?>
						</p>
					</div><!--.history-text-->
					<div class="history-bt-top"></div><!--.history-bt-top-->
				</div><!--.history-past-->

				<div class=" history-box history-future">
					<?php if( function_exists( 'get_field' ) ){
						$history_title_future_year = get_field('history_title_future_year');
						$history_title_future_text = get_field('history_title_future_text');
						$history_content_future = get_field( 'history_future' );
						$history_image_future_id = get_field( 'history_image_future' );
					}?>
					<div class="history-image">
					<?php if( $history_image_future_id ){
								echo wp_get_attachment_image( $history_image_future_id, 'large', '', array( 'class'=>'alignright' ) );
							}
					?>
					</div><!--.history-image-->
					<div class="history-text">
						<h3 class="history-title">
							<?php if( $history_title_future_year||$history_title_future_text): ?>
							<?php echo $history_title_future_year;?>
							<span>|</span>
							<?php echo $history_title_future_text;?>
							<?php endif;?>
						</h3>
						<p class="history-content-text">
							<?php if( $history_content_future ):?>
							<?php echo $history_content_future;?>
							<?php endif;?>
						</p>
					</div><!--.history-text-->
					<div class="history-bt-bottom"></div><!--.history-bt-bottom-->
				</div><!--.history-future-->

			</section><!--.about-history-->

			<section class="awards">
						<h2>Awards & Certificates</h2>
						<div class="award-slider">
						<?php 
							$args = array(
								'post_type' => 'hl-award',
								'posts_per_page' => -1,   // If you want to all posts, set up -1  default minimum 10
							);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) { ?>
									<?php $query->the_post();?>
									
									<div class="ac-image"><?php the_content();?></div><!--.ac-image-->
									
							<?php	}
								wp_reset_postdata();
							} 
						?>
						</div><!--.award-slides-->
					</section><!--.awards-->

			<section class="supporters">
				<h2>Our Supporters</h2>
					<?php echo do_shortcode ("[instagram-feed cols=6]"); ?>
			</section><!--.supporters-->
			</div> <!--.wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
