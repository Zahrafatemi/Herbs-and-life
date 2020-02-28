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

		<?php
		
		global $post;

		$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

		?>

		<?php
		$args = array(
			'posts_per_page' => '-1',
			'product_cat' => 'events',
			'post_type' => 'product',
			'orderby' => 'title',
		);
	
		$query = new WP_Query( $args );
		if( $query->have_posts()) : 
			while( $query->have_posts() ) 
				: $query->the_post();
		?>
		<div class="single-event">
			<span class="excerpt"><?php the_excerpt() ?></span>
			<span class="title">
				<a href="<?php the_permalink() ?>">
					<?php the_title(); ?>
				</a>
			</span>
			<?php the_post_thumbnail('event-thumbnail'); ?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php else:  ?>
		<p>
			<?php _e( 'No Products' ); ?>
		</p>
		<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
