<?php
/**
 * Template part for displaying posts in the "Recipes" category
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

?>

<article class="recipe" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<header class="entry-header">

			<figure class="thumbnail">
				<img src=<?php the_post_thumbnail_url(); ?> alt="<?php the_title(); ?>">
			</figure><!--.thumbnail-->

			<!-- <h1><?php //the_title(); ?></h1> -->
			
		</header><!-- .entry-header -->

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

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="text">
				<div class="summary">
					<span class="serving-size"><?php if( $servingSize ) { echo '<h3>Serves:&nbsp;</h3> ' . '<p>'. $servingSize . '</p>'; }?></span>
					<span class="prep-time"><?php if( $prepTime ) { echo '<h3>Prep Time:&nbsp;</h3> ' . '<p>'. $prepTime[ 'time' ] . $prepUnit . '</p>'; } ?></span>
					<span class="calories"><?php if( $calories ) { echo '<h3>Calories:&nbsp;</h3> ' . '<p>'. $calories . 'Cal</p>'; }?></span>
				</div><!--.overview-->
				<p class="description"><?php if( $description ) { echo $description; } ?></p>
				<a href="<?php if( $source ) { echo $source; } else { echo "#0"; } ?>" class="source" target="_blank">Credits</a>
			</div><!--.text-->

		</section><!--.recipe-overview.overview-->
	</div><!-- .entry-content -->
		

	<div class="main-content">
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
	</div><!-- .main-content -->	
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
