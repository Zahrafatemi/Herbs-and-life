<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Herb_&_Life
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="404-image-wrapper">
					<img class = "404-image" id = "404-image" src="<?php echo get_template_directory_uri(); ?>/images/assets/404-page/404-800px.jpg" alt="404 image">
					</div>
				</header><!-- .page-header -->

				<div class="page-content">
					<h1 class="page-title"><?php esc_html_e( 'Oops!', 'herblife' ); ?></h1>
					<p><?php esc_html_e( "We can't find the page\nyou are looking for.", 'herblife' ); ?></p>

					<div class="btn-wrapper">
					<div class="link-btn go-home-btn">
						<a class="go-home cta-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php bloginfo( 'name' ); ?> go-to-home">
						Take me home
						</a>
					</div>
					<div class="link-btn go-shop-btn">
						<a class="go-to-shop cta-btn" href="<?php echo esc_url( home_url( '/shop' ) ); ?>" rel="shop" alt="<?php bloginfo( 'name' ); ?>go-to-shop-page">
						Take me to shop
						</a>
					</div>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
