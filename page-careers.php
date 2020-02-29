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
		<section class= "career-list">
		<?php 
                if(get_field('positions') ):?>
                
                    <?php while(has_sub_field('positions')): 
                    $title = get_sub_field('position_title');
                    $location = get_sub_field('position_location');
                    $position = get_sub_field('position_type');
                    $summary = get_sub_field('position_summary');
                    ?>
                
                    <div class="position-list">
                        
                            <h3><?php echo $title?></h3>
                            <?php if($location):?>
                                <p><?php echo $location?><p>
							<?php endif; ?>
							<?php if($position):?>
                                <p><?php echo $position?><p>
                            <?php endif; ?>
                            <?php if($summary):?>
                                <p><?php echo $summary?><p>
                            <?php endif; ?>
                           
                    </div>							
                    <?php endwhile; ?>
                                            
                <?php endif; ?>
		</section>




		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
