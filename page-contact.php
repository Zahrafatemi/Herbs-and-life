<?php
/**
 * The template for Contact page
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
			<section class="contact-intro">
				<?php if( function_exists( 'get_field' ) ){
					$contact_intro = get_field( 'contact_intro' );
				}?>
				<p><?php if($contact_intro){ echo $contact_intro; }?></p>
			</section><!--.contact-intro-->

			<section class="contact-form">
			<div class="contact-bg-img"></div>  <!--.contact-bg-img-->
				<?php echo do_shortcode ('[contact-form-7 id="10" title="Contact form 1"]'); ?>
				
			</section><!--.contact-form-->

			<section class = "store-locator">
				<h2>Locations</h2>
				<div class = "locator-map">
				<?php echo do_shortcode ("[wpsl]"); ?>  
				</div> 
			</section><!--.contact-form-->
			</div><!-- .wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
