<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

?>

<?php
	$categories = '';
	$catObjects = get_the_category();

	if( $catObjects ) {
		foreach( $catObjects as $catObject ) {
			if( $categories ){
				$categories .= ' ';
			}
			$categories .= $catObject->slug;
		}
	}
?>

<a class="blog-post <?php echo $categories; ?>" href="<?php echo get_permalink( get_the_ID() ) ?>">
	<article class="content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_post_thumbnail( 'blog-thumbnail' ); ?>
			
			<header class="entry-header">
				<h2 class="title"><?php the_title(); ?></h2><!--.title-->
				<div class="meta-info">
					<?php
						$targetCategories 	= array( 'news', 'recipes' );
						$postCategories 	= [];
						$postCategory 		= '';

						$categories 		= get_the_category( );
						if( $categories ) {
							foreach( $categories as $category ) {
								$postCategories[] = $category->slug;
							}
						}

						foreach( $targetCategories as $targetCategory ){
							if( in_array( $targetCategory, $postCategories ) ) {
								$postCategory = $targetCategory;
							}
						}
					?>
					<span class="author"><?php echo "By " . get_the_author(); ?></span><!--.author-->
					<span class="blog-seperator">|</span><!--.blog-seperator-->
					<span class="category"><?php echo ucwords($postCategory); ?></span><!--.category-->
				</div><!--.meta-info-->
			</header>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
	</article><!--.blog-post#post-<?php the_ID(); ?> -->
</a><!--.post-link-->