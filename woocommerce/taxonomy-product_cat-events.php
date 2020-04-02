<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main events-archive">
			<h1 class="screen-reader-text"><?php the_title(); ?></h1>

				<?php 
				if( function_exists( 'get_field' ) ):
					if( function_exists( 'get_field' ) ):
						if( get_field( 'events_image', 'option' ) ):
							$image = get_field('events_image', 'option');
							$header = get_field('events_header', 'option');
							$description = get_field('events_description', 'option');
							$buttonText = get_field('events_button_label', 'option');
							$buttonLink = get_field('events_link', 'option'); 
							$second_header = get_field('events_second_header', 'option');
							$second_description = get_field('events_second_description', 'option');
							$third_header = get_field('events_third_header', 'option');
							?>

							<div class = "events-banner">
								
								<div class="banner-wrapper">
									<?php echo wp_get_attachment_image( $image, 'full' ); ?>
									<h1 class="title-on-banner">Events & Workshops</h1>
								</div><!--.banner-wrapper-->

								<div class="events-banner-text-box">
									<h3 class="title"><?php echo $header ?></h3>
									<p class="description"><?php echo $description ?></p>
									<a class="cta-banner-btn btn-text btn" href="<?php if( $buttonLink ){ echo esc_url( $buttonLink ); } ?>"><?php if( $buttonText ){ echo $buttonText; }?></a>
								</div><!--.events-banner-text-box-->

							</div><!--.events-banner-->
							
							<div class="events-second-text-box">
								<h1 class="title"><?php echo $second_header ?></h1>
								<p class="description"><?php echo $second_description ?></p>
							</div><!--.events-second-text-box-->

							<div class="events-third-text-box">
								<h2 class="title"><?php echo $third_header ?></h2>
							</div><!--.events-third-text-box-->
								 
						<?php endif;
					endif;  
				endif;  ?>


			<div class="events-list">

				<div class="events-headers">
					<h2 class="col2">Event</h2>
					<h2 class="col3">Date and Time</h2>
				</div>
				<?php
				global $post;
				$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
				$today = date('Ymd');

				// Determining Future Events
				$args_future_events = array(
					'posts_per_page' => '-1',
					'product_cat' => 'events',
					'post_type' => 'product',
					'orderby'   => 'meta_value_num',
					'order'     => 'ASC',
					'meta_query' => array(
						array(
							'key'     => 'date',
							'compare' => '>=',
							'value'   => $today,
						),
					),
				);

				// Determining Past Events
				$args_past_events = array(
					'posts_per_page' => '-1',
					'product_cat' => 'events',
					'post_type' => 'product',
					'orderby'   => 'meta_value_num',
					'order'     => 'ASC',
					'meta_query' => array(
						array(
							'key'     => 'date',
							'compare' => '<',
							'value'   => $today,
						),
					),
				);
				?>
				
				<!-- Displaying Future Events -->
				<div class="future-events">
					<?php 
					$query = new WP_Query( $args_future_events );
					if( $query->have_posts()) :
						while( $query->have_posts() ) : 
								$query->the_post();
							?>
							<div class="future-single-event single-event">
								<a class="each-event" href="<?php the_permalink() ?>">
									<div class="event-image">
										<?php the_post_thumbnail('medium'); ?>
									</div><!-- end of .event-image -->

									<!-- <div class="event-summary"> -->

										<div class="second-column">
											<!-- The product tags list -->
											<?php $terms = get_the_terms( $post->ID, 'product_tag' ); ?>
											<div class="event-tags">
												<?php 
												$i = 1;
												foreach ( $terms as $term ) :
													echo $term->name;
													echo ($i < count($terms))? ", " : "";
													// Increment counter
													$i++;
												endforeach ?>
											</div>

											<div class="event-title-price">
												<!-- The product Title -->
												<h3 class="title"><?php the_title(); ?></h3>
												
												<!-- The product Price -->
												<p class="event-price"><?php echo($product->get_price()>0) ? "$".$product->get_price() : 'Free Event'; ?></p>
											</div><!-- End of event-title-price -->
										</div>

										<div class="event-date-time">
											<?php if(get_field('date')):?>
													<p><?php the_field('date');?></p>
													<?php if(get_field('start_time') && get_field('end_time')): ?>
														<p><?php the_field('start_time');?> to <?php the_field('end_time'); ?></p>
													<?php endif;?>
											<?php endif;?>

											<?php if(get_field('note')): ?>
												<p><?php the_field('note'); ?></p>
											<?php endif;?>
											
										</div><!-- end of .event-date-time -->
									<!-- </div>.event-summary -->
								</a>
							</div><!--.future-single-event-->
						<?php endwhile;
							wp_reset_postdata();
						else: ?>
							<p><?php _e( 'No Events' ); ?></p>
					<?php endif; ?>
				</div><!--future-events-->

				<button class="woo-btn see-past-events" id="see-past-events" >Past Events</button>

				<!-- Displaying Past Events -->
				<div class="past-events" id="past-events">

					<?php
					$query = new WP_Query( $args_past_events );
					if( $query->have_posts()) : 
						while( $query->have_posts() ) : 
							$query->the_post();
							?>
							<div class="past-single-event single-event">
							<a class="each-event" href="<?php the_permalink() ?>">
									<div class="event-image">
										<?php the_post_thumbnail('medium'); ?>
									</div><!-- end of .event-image -->

									<!-- <div class="event-summary"> -->

										<div class="second-column">
											<!-- The product tags list -->
											<?php $terms = get_the_terms( $post->ID, 'product_tag' ); ?>
											<div class="event-tags">
												<?php 
												$i = 1;
												foreach ( $terms as $term ) :
													echo $term->name;
													echo ($i < count($terms))? ", " : "";
													// Increment counter
													$i++;
												endforeach ?>
											</div>

											<div class="event-title-price">
												<!-- The product Title -->
												<h3 class="title"><?php the_title(); ?></h3>
												
												<!-- The product Price -->
												<p class="event-price"><?php echo($product->get_price()>0) ? "$".$product->get_price() : 'Free Event'; ?></p>
											</div><!-- End of event-title-price -->
										</div>

										<div class="event-date-time">
											<?php if(get_field('date')):?>
													<p><?php the_field('date');?></p>
													<?php if(get_field('start_time') && get_field('end_time')): ?>
														<p><?php the_field('start_time');?> to <?php the_field('end_time'); ?></p>
													<?php endif;?>
											<?php endif;?>

											<?php if(get_field('note')): ?>
												<p><?php the_field('note'); ?></p>
											<?php endif;?>
											
										</div><!-- end of .event-date-time -->
									<!-- </div>.event-summary -->
								</a>
							</div><!--.past-single-event-->
						<?php endwhile;
						wp_reset_postdata();
						else: ?>
							<p><?php _e( 'No Events' ); ?></p>
					<?php endif; ?>
				</div><!-- end of past events -->
			</div><!-- end of events-list -->
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
//get_sidebar();
get_footer();

