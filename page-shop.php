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
            <section class = "promo-slide slider">
                <?php if( function_exists( 'get_field' ) ):
                    if( get_field( 'promo_banner' ) ):
                        while( has_sub_field( 'promo_banner' ) ): 
                            $images         = get_sub_field('promo_image');
                            $header         = get_sub_field('promo_header');
                            $description    = get_sub_field('promo_description');
                            $buttonText     = get_sub_field('promo_button_label');
                            $buttonLink     = get_sub_field('promo_link');
                            $size           = 'full'; // (thumbnail, medium, large, full or custom size) ?>

                        <div class="promo-banner">
                            <div class="banner-wrapper">
                                <?php the_title( '<h1 class="title-on-banner">', '</h1>' ); ?>
                                <?php if( $images && $size ) { echo wp_get_attachment_image( $images, $size ); } ?>
                            </div><!--.banner-wrapper-->
                            <div class="promo-banner-text-box">
                                <h3><?php if( $header ) { echo $header; }?></h3>
                                <p class="promo-description"><?php if( $description ) { echo $description; }?></p>
                                <a class="promo-btn btn" href="<?php if( $buttonLink ) { echo esc_url( $buttonLink ); }?>"><?php if( $buttonText ){ echo $buttonText; }?></a>
                            </div><!--.promo-banner-text-box-->
                        </div><!--.promo-banner-->		          
                        <?php endwhile;
                    endif;
                endif; ?>
            </section><!--.promo-banner slider-->
           
        <div class="wrapper pattern02">
            <section class="shop_intro">
                <?php if(function_exists('get_field')){
                    $shop_intro_title 	= get_field('shop_intro_title');
                    $shop_intro 		= get_field('shop_intro');
                } ?>

                <h1 class="shop-intro-title"><?php if( $shop_intro_title ) { echo $shop_intro_title; }?></h1>
                <p class="shop-intro-text"><?php if( $shop_intro ){ echo $shop_intro; } ?></p>
            </section><!--.shop-intro-->
			<section class="category-wrapper">
				<h2>Product Categories</h2>
                <?php
				$prod_cat_args = array(
						'taxonomy'=>'product_cat',
						'orderby'=>'name',
                        'empty' => 0,
                        'exclude' => array(47, 56, 69), //exclude events, subscription, gift card category
						'parent'=>0  //exclude subcategory
				);
                $terms = get_categories($prod_cat_args);
                
				foreach($terms as $term):
                     $term_link = get_term_link($term);
					 $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );?>

                    <a class="category" href="<?php echo esc_url($term_link)?>">
                    <?php if( $thumbnail_id ) { ?>
                        <figure class="category-container">
                        <?php echo wp_get_attachment_image( $thumbnail_id, 'woocommerce_thumbnail' ); ?>
                        </figure>
                    <?php }?>
                    <p class="category-name"><?php echo $term->name; ?></p><!--.category-name-->
					</a>

				<?php endforeach;?>
			</section><!--..category-wrapper-->

			<section class="we-offer"> 
				<h2>We Also Offer</h2>
                <?php if( function_exists( 'get_field' ) ):
                    if( get_field( 'we_offer' ) ):
                        while( has_sub_field( 'we_offer' ) ): 
                            $title  = get_sub_field( 'we_offer_title' );
                            $images = get_sub_field( 'we_offer_image' );
                            $size   = 'medium'; // (thumbnail, medium, large, full or custom size)
                            $link   = get_sub_field( 'we_offer_link' ); ?>

                            <div class = "we-offer-wrapper">
                                <h3><?php if( $title ) { echo $title; } ?></h3>
                                <?php if( $images && $size ) { echo wp_get_attachment_image( $images, $size ); } ?>
                            </div><!--.we-offer-wrapper-->

                        <?php endwhile;
                    endif;
                endif; ?>
			</section><!--.we-offer-->
		
            <section class="testimonials">
                <h2>Testimonials</h2>
                <?php 
                    $args = array(
                        'post_type' => 'hl-testimonial',
                        'posts_per_page' => 2, // If you want to all posts, set up -1  default minimum 10
                        'orderby'=>'rand'  
                    );

                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();

                            // output customer images
                            if( function_exists( 'get_field' ) ):
                                if( get_field( 'customer_image' ) ): ?>

                                    <figure class="customer-image">
                                        <?php echo wp_get_attachment_image( get_field('customer_image'), 'medium' ); ?>
                                    </figure>
                                <?php endif;
                            endif; 

                            // output testimonials
                            the_content();

                        }
                        wp_reset_postdata(); 
                    } 
                ?>
            </section><!--.testimonials-->

            <section class = "store-locator">
                <h2>Store Finder</h2>
                <div class = "locator-map">
                <?php echo do_shortcode ("[wpsl]"); ?>
                </div>    
            </section><!--.store-locator-->
            </div><!--.wrapper-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();