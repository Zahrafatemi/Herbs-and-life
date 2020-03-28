<?php
/**
 * The template for Wholesale page
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
			
		<div class="wrapper pattern01">
			<h1><?php the_title(); ?></h1>
			<section class="wholesale-intro">
				<?php if( function_exists( 'get_field' ) ){
					$wholesale_intro = get_field( 'wholesale_description' );
				}?>
				<p><?php if($wholesale_intro){ echo $wholesale_intro; }?></p>
			</section><!--.wholesale-intro-->

			<section class="wholesale-form">
			<div class="contact-bg-img"></div>  <!--.contact-bg-img-->
				<?php echo do_shortcode ('[contact-form-7 id="365" title="Wholesale Form"]'); ?>
				
			</section><!--.wholesale-form-->


			</div><!-- .wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
