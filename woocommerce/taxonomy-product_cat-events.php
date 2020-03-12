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
		<main id="main" class="site-main">
			<h1 class="screen-reader-text"><?php the_title(); ?></h1>
		
			<?php if( function_exists( 'get_field' ) ):?>
				<h1 class="title-on-banner">Events & Workshops</h1>
				<div class = "events_image">
					<?php 
					if(get_field('events_image', 'option')):
						echo wp_get_attachment_image( get_field('events_image', 'option') , 'full' );
					endif;
					?>
				</div><!--.events-image-->
			<?php endif;  ?>

			<div class="events">
				<?php
				
				global $post;

				$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

				$today = date('Ymd');

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

				<div class="future-events">

				<?php 
				$query = new WP_Query( $args_future_events );
				if( $query->have_posts()) :
					while( $query->have_posts() ) : 
							$query->the_post();
					?>
						<div class="future-single-event">
							<a class="title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							<?php the_excerpt(); ?>
							<?php the_post_thumbnail('event-thumbnail'); ?>
						</div><!--.future-single-event-->
					<?php 
					endwhile;
						wp_reset_postdata();
				else: ?>
					<p><?php _e( 'No Products' ); ?></p>
				<?php endif; ?>
				</div>

				<button class="see-past-events" id="see-past-events" >Past Events</button>

				<div class="past-events" id="past-events">

				<?php
				$query = new WP_Query( $args_past_events );
				if( $query->have_posts()) : 
					while( $query->have_posts() ) : 
						$query->the_post();
				?>
						<div class="past-single-event">
							<a class="title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							<?php the_post_thumbnail('event-thumbnail'); ?>
						</div><!--.past-single-event-->
					<?php 
					endwhile;
					wp_reset_postdata();
				else: ?>
					<p><?php _e( 'No Products' ); ?></p>
					
				<?php endif; ?>
				</div><!-- end of past events -->
			</div><!-- end of events -->
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
//get_sidebar();
get_footer();

