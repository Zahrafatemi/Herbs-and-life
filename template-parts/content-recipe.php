<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<?php
			herblife_posted_on();
			herblife_posted_by();
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php herblife_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		
		if( has_tag( 'recipe' ) ):
			if( function_exists( 'get_field' ) ){
				$description 	= get_field( 'description' );
				$servingSize 	= get_field ( 'serving_size' );
				$prepTime 		= get_field( 'prep_time' );
				$calories 		= get_field( 'calories' );
				$directions 	= get_field( 'directions' );
				$source 		= get_field( 'source' );

				if( $prepTime[ 'unit' ] == 'Hour(s)' ){
					$prepUnit = 'h';
				}else if( $prepTime[ 'unit' ] == 'Minute(s)' ){
					$prepUnit = 'min';
				}
			}
		?>	

			<section class="recipe-description description">
				<?php if( $description ) { echo $description; } ?>
			</section><!--.recipe-description.description-->

			<section class="recipe-overview overview">
				<span class="serving-size"><?php if( $servingSize ) { echo 'Serves: ' . $servingSize; }?></span>
				<span class="prep-time"><?php if( $prepTime ) { echo 'Prep Time: ' . $prepTime[ 'time' ] . $prepUnit; } ?></span>
				<span class="calories"><?php if( $calories ) { echo $calories . 'cal'; }?></span>
			</section><!--.recipe-overview.overview-->

			<section class="recipe-ingredients ingredients">
				<h2>Ingredients</h2>
				<ul>
					<?php if( function_exists( 'have_rows' ) ):
						if( have_rows( 'ingredients' )): 
							while( have_rows( 'ingredients' ) ):
								the_row(); 
								$ingredient = get_sub_field( 'ingredient' );
								if ( $ingredient ): ?>

								<li class="ingredient"><?php echo $ingredient; ?></li>

							<?php endif;
							endwhile;
						endif;
					endif; ?>			
				</ul>
			</section><!--.recipe-ingredients.ingredients-->

			<section class="recipe-directions directions">
				<h2>Directions</h2>
				<ul>
					<?php if( function_exists( 'have_rows' ) ):
						if( have_rows( 'directions' )): 
							while( have_rows( 'directions' ) ):
								the_row(); 
								$direction = get_sub_field( 'direction' );
								if ( $direction ): ?>

								<li class="direction"><?php echo $direction; ?></li>

							<?php endif;
							endwhile;
						endif;
					endif; ?>			
				</ul>
			</section><!--.recipe-directions.directions-->
		
		<?php endif; ?>
		<!------------------------------------>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'herblife' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php herblife_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
