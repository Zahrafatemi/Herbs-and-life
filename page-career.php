<?php
/**
 * The template for Career page
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


		<?php the_title( '<h1 class="contact-title">', '</h1>' ); ?>

		
		<section class="contact-intro">
				<?php if(get_field('careers_intro') ):?>	
				<h3><?php the_field('careers_intro')?></h3>
				<?php endif;?>
				
		</section>
		<section class= "contact-form">
	
		</section>




		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
