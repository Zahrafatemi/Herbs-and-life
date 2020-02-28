<?php
/**
 * The template for Shop page
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

			<section class = "promo-banner slider">
			
                <?php 
                if(get_field('promo_banner') ):?>
                
                    <?php while(has_sub_field('promo_banner')): 
                    $images = get_sub_field('promo_image');
                    $header = get_sub_field('promo_header');
                    $description = get_sub_field('promo_description');
                    $buttonText = get_sub_field('promo_button_label');
                    $buttonLink = get_sub_field('promo_link');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    ?>
                
                    <div class="promo-banner">
                        
                        <?php echo wp_get_attachment_image( $images, $size ); ?>
                        <div class="promo-banner-text-box">
                            <h3>
                            <?php echo $header?>
                            </h3>
                            <?php if($description):?>
                            <p>
                            <?php echo $description?>
                            <p>
                            <?php endif; ?>
                            <?php if($buttonText):
                                echo '<button src=".$buttonLink.">'.$buttonText.'</button>'
                            ?>
                            <?php endif; ?>
                        </div>	
                    </div>							
                    <?php endwhile; ?>
                                            
                <?php endif; ?>
				
			</section><!-- promo-banner slider-->

			<section class="category">
				<h2>Categories</h2>
				<?php
				$prod_cat_args = array(
						'taxonomy'=>'product_cat',
						'orderby'=>'name',
                        'empty' => 0,
                        'exclude' => array(47),
						'parent'=>0  //exclude subcategory
				);
				$terms = get_categories($prod_cat_args);
				foreach($terms as $term){
                    $term_link = get_term_link($term);
                     $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                    echo wp_get_attachment_image($thumbnail_id, 'woocommerce_thumbnail');
					echo '<div><a class = "category" href="'.esc_url($term_link).'">'.$term->name . '</a></div>';
				}
				?>
			</section><!-- category-->

			<section class="we-offer"> 
				<h2>We Also Offer</h2>
				<?php if(get_field('we_offer') ):?>

					<?php while(has_sub_field('we_offer')): 
                        $title = get_sub_field('we_offer_title');
                        $images = get_sub_field('we_offer_image');
                        $size = 'medium'; // (thumbnail, medium, large, full or custom size)
                        $link = get_sub_field('we_offer_link');
                        ?>
                        <div class = "weoffer-wrapper">
                            <h3>
                                <?php echo $title?>
                            </h3>
                            <?php echo wp_get_attachment_image( $images, $size ); ?>
                            </div>	
                        </div>
					
					<?php endwhile;?>
				<?php endif;?>
			</section><!-- we-offer-->
		
            <section class="testimonials">
                <h2>Testimonials</h2>
                <?php 
                    $args = array(
                        'post_type' => 'hl-testimonial',
                        'posts_per_page' => 2,   // If you want to all posts, set up -1  default minimum 10
                    );

                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();

                            the_content();

                        }
                        wp_reset_postdata();
                    } 
                ?>
            </section><!-- testimonials-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
