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
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>

			<div class="wrapper">

				<?php
				function getFilters( $category='categories', $type='radio' ){
					$filters = '';
					
					// Default option for filter group
					if( $type == 'dropdown' ){
						$filters .= "<option name=" . $category . "value='*' selected='selected'>Choose Option</option>\r\n";
					}else{
						$filters .= "<li class='filter-option'>\r\n";
						$filters .= "<input type=" . $type . " id='any' name=" . $category . " value='*' checked='checked' />\r\n";
						$filters .= "<label for='any'>Any</label>\r\n";
						$filters .= "</li>\r\n";

					}

					$category = get_category_by_slug( $category );
					
					$args = array(
						'taxonomy' => 'category',
						'parent' => $category->term_id
					);

					$subcategories = get_terms( $args );

					foreach( $subcategories as $subcategory ){
						if( $type == 'dropdown' ){
							$filters .= "<option name=" . $category->slug . "value=" . $subcategory->slug . ">" . $subcategory->name . "</option>\r\n";
						}else{
							$filters .= "<li class='filter-option'>\r\n";
							$filters .= "<input type=" . $type . " id=" . $subcategory->slug . " name=" . $category->slug . " value=" . $subcategory->slug . "/>\r\n";
							$filters .= "<label for=" . $subcategory->slug . ">" . $subcategory->name . "</label>\r\n";
							$filters .= "</li>\r\n";
						}
					}

					return $filters;
				}
				?>

				<div class="filters">
					<ul class="main filter-group">
						<?php echo getFilters(); ?>
					</ul><!--.filter-group-->

					<select class="cuisine news-filter filter-group">
						<?php echo getFilters('cuisine', 'dropdown');?>
					</select>

					<ul class="meal news-filter filter-group">
						<?php echo getFilters('meal');?>
					</ul>
				</div><!--.filters-->

				<div class="filters">
					<div class="ui-group">
						<div class="filter-group js-radio-button-group" data-filter-group="type">
							<div class="filter-option">
								<input type="radio" name="type" id="any" class="option is-checked" checked="checked" data-filter="" />
								<label for="any">Any</label>
							</div><!--.filter-option-->

							<div class="filter-option">
								<input type="radio" name="type" id="news" class="option" data-filter=".news" />
								<label for="news">News</label>
							</div><!--.filter-option-->

							<div class="filter-option">
								<input type="radio" name="type" id="recipe" class="option" data-filter=".recipe" />
								<label for="recipe">Recipes</label>
							</div><!--.filter-option-->
						</div><!--.filter-group-->
					</div><!--.ui-group-->
				</div><!--.filters-->

				<div class="grid">
					<?php
					while( have_posts() ){
						the_post();
						get_template_part('template-parts/content', 'blog');
					}					
					?>
				</div><!--.grid-->
				<?php
					// if( $wp_query->max_num_pages > 1){
					// 	echo do_shortcode( '[ajax_load_more container_type="div" css_classes="grid" post_type="post" transition="masonry" masonry_selector=".blog-post" posts_per_page="6" scroll_container=".grid" button_label="Load More" button_loading_label="Loading ..." no_results_text="&lt;span class="no-results"&gt;No more results&lt;/span&gt;"]' );
					// }else{
					// 	while( have_posts() ){
					// 		the_post();
					// 		get_template_part('template-parts/content', 'blog');
					// 	}
					// }
				
				?>
		</div><!-- .wrapper -->
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
