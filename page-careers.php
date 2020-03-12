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
            <h1 class="screen-reader-text"><?php the_title(); ?></h1>
            <h1 class="page-title title-on-banner"><?php the_title(); ?></h1>

			<?php if( function_exists( 'get_field' ) ):?>
				<div class = "careers-banner">
					<?php 
					if(get_field('careers_image')):
						echo wp_get_attachment_image( get_field('careers_image') , 'full' );
					endif;
					?>
				</div><!--.careers-image-->
			<?php endif;  ?>

        <div class="wrapper">
            <section class="career-intro">
                <?php if(function_exists( 'get_field' )){
                    $careers_intro = get_field( 'careers_intro' );
                } ?>

                <p class="career-intro-text"><?php if( $careers_intro ){ echo $careers_intro; }?></p>
            </section><!--.career-intro-->

            <section class= "career-list">
                <?php if(function_exists('get_field')):
                    if(get_field('positions') ):
                        while(has_sub_field('positions')): 
                            $title      = get_sub_field( 'position_title' );
                            $location   = get_sub_field( 'position_location' );
                            $position   = get_sub_field( 'position_type' );
                            $summary    = get_sub_field( 'position_summary' ); ?>
                    
                        <div class="position-list">
                            <h3><?php if( $title ) { echo $title; } ?></h3>
                            <span class="location"><?php if( $location ) { echo $location; } ?></span>
                            <span class="position"><?php if( $position ) { echo $position; } ?></span>
                            <p class="summary"><?php if( $summary ) { echo $summary; } ?></p>
                        </div><!--.position-list-->

                        <?php endwhile;       
                    endif;
                endif; ?>
            </section><!--.career-list-->
            </div><!--.wrapper-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
