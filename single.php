<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			if ( has_tag( 'recipe' ) ){
				get_template_part( 'template-parts/content', 'recipe' );
			}else{
				get_template_part( 'template-parts/content', get_post_type() );
			}
		endwhile; // End of the loop.
		?>

		<section class="related-posts">
			<h2>Related Posts</h2>

			<div class="posts-container">
				<?php
				$args = array(
					'posts_per_page' => 3,
					'post__not_in'   => array( get_the_ID() ), // Exclude current post
					'no_found_rows'  => true,
				);

				// Check for current post category and add tax_query to the query arguments
				$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
				$cats_ids = array();  
				foreach( $cats as $wpex_related_cat ) {
					$cats_ids[] = $wpex_related_cat->term_id; 
				}
				if ( ! empty( $cats_ids ) ) {
					$args['category__in'] = $cats_ids;
				}
				// Query posts
				$wpex_query = new wp_query( $args );

				// Loop through posts
				foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
						<h3><?php the_title(); ?></h3>
						<figure class="related-image">
							<?php the_post_thumbnail( 'blog-thumbnail' ); ?>
						</figure>
					</a>
				<?php
				endforeach;
				wp_reset_postdata(); ?>

			</div><!--.posts-container-->
		</section><!--.related-posts-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
