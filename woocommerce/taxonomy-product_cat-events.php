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
			<?php
			
			global $post;

			$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

			$args = array(
				'posts_per_page' => '-1',
				'product_cat' => 'events',
				'post_type' => 'product',
				'orderby' => 'title',
			);
		
			$query = new WP_Query( $args );
			if( $query->have_posts()) : 
				while( $query->have_posts() ) : 
					$query->the_post();
			?>

					<div class="single-event">
						<span class="excerpt"><?php the_excerpt() ?></span>
						<a class="title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						<?php the_post_thumbnail('event-thumbnail'); ?>
					</div><!--.single-event-->
				<?php 
				endwhile;
				wp_reset_postdata();
			else: ?>
				<p><?php _e( 'No Products' ); ?></p>
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
//get_sidebar();
get_footer();

