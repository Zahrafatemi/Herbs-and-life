<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

?>

<article class="recipe" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="pattern01">
			<h1><?php the_title(); ?></h1>
		</span>
	</header><!-- .entry-header -->

	

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
			<section class="recipe-overview overview">
				<figure class="thumbnail">
					<img src=<?php the_post_thumbnail_url(); ?> alt="<?php the_title(); ?>">
				</figure><!--.thumbnail-->

				<div class="text">
					<div class="summary">
						<span class="serving-size"><?php if( $servingSize ) { echo '<h3>Serves:</h3> ' . $servingSize; }?></span>
						<span class="prep-time"><?php if( $prepTime ) { echo '<h3>Prep Time:</h3> ' . $prepTime[ 'time' ] . $prepUnit; } ?></span>
						<span class="calories"><?php if( $calories ) { echo '<h3>Calories:</h3> ' . $calories . 'cal'; }?></span>
					</div><!--.overview-->
					<p class="description"><?php if( $description ) { echo $description; } ?></p>
					<a href="<?php if( $source ) { echo $source; } else { echo "#0"; } ?>" class="source">Credits</a>
				</div><!--.text-->

				
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
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
