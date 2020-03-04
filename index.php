<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="filters">
				<div class="ui-group">
					<h3>Type</h3>
					<div class="button-group js-radio-button-group" data-filter-group="color">
						<button class="button is-checked" data-filter="">Any</button>
						<button class="button" data-filter=".news">News</button>
						<button class="button" data-filter=".recipe">Recipes</button>
					</div><!--.button-group js-radio-button-group-->
				</div><!--.ui-group-->
			</div><!--.filters-->

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			function tagsToString() {
				$tags = [];
				$tagObjects = get_the_tags();

				if( $tagObjects ) {
					foreach( $tagObjects as $tagObject ) {
						$tags[] = $tagObject->name;
					}
				}

				if( $tags ) {
					$tags = implode( ' ', $tags );
					return $tags;
				}else {
					return;
				}
			}

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'blog' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
