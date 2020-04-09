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
		<main id="main" class="site-main">

			<header class="pattern01">
				<!-- <h1 class="page-title"><?php //single_post_title(); ?></h1> -->
				<h1 class="page-title">Herb and Blog</h1>
			</header>

			<div class="wrapper">
				<?php
				if( have_posts() ):
				?>
					<?php
					function getFilters( $category='category', $type='radio' ){
						$filters = '';

						$categorySlug = get_category_by_slug( $category );
						
						$args = array(
							'parent' => $categorySlug->term_id
						);

						$subcategories = get_categories( $args );

						if( $subcategories ){
							// Default option for filter group
							if( $type == 'dropdown' ){
								$filters .= "<option class='default' name=" . $category . " data-filter='' selected='selected'>Choose Option</option>\r\n";
							}else{
								$filters .= "<li class='filter-option' data-filter=''>\r\n";
								$filters .= "<input class='default' type=" . $type . " id='any-" . $category . "' name=" . $category . " checked='checked' />\r\n";
								$filters .= "<label for='any-" . $category ."'>Any</label>\r\n";
								$filters .= "</li>\r\n";
							}
						}

						foreach( $subcategories as $subcategory ){
							if( $type == 'dropdown' ){
								$filters .= "<option name=" . $category . " data-filter=." . $subcategory->slug . ">" . $subcategory->name . "</option>\r\n";
							}else{
								$filters .= "<li class='filter-option' data-filter=." . $subcategory->slug . ">\r\n";
								$filters .= "<input type=" . $type . " id=" . $subcategory->slug . " name=" . $category . " />\r\n";
								$filters .= "<label for=" . $subcategory->slug . ">" . $subcategory->name . "</label>\r\n";
								$filters .= "</li>\r\n";
							}
						}

						return $filters;
					}
					?>

					<div class="filters">
						<ul class="main filter-group" data-filter-cat="type">
							<?php echo getFilters(); ?>
						</ul><!--.main-->

						<div class="recipes-filters">
							<div class="cuisine filter-group filter-dropdown" data-filter-cat="cuisine">
								<label class="filter-category" for="cuisine">Cuisine: </label>
								<select class="filter-option" id="cuisine">
									<?php echo getFilters( "cuisine", "dropdown" );?>
								</select>						
							</div><!--.cuisine-->

							<ul class="meal filter-group" data-filter-cat="meal">
								<span class="filter-category">Meal:</span>
								<?php echo getFilters( "meal" );?>
							</ul><!--.meal-->

							<ul class="ingredients filter-group" data-filter-cat="ingredients">
								<?php echo getFilters( "ingredients" );?>
							</ul><!--.ingredients-->						
						</div>


					</div><!--.filters-->
					
					<div class="blog-feed">
						<?php
						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', 'blog' );
						}
						?>
					</div><!--.blog-feed-->

					<div id="infinite-handle">
						<button class="load-more button">Load More</button>
					</div><!--#infinite-handle-->
				<?php
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
		</div><!-- .wrapper -->
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
