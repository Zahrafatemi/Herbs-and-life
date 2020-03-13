<?php
/**
 * The template for displaying all pages
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

			<section class = "hero-slide slider">
				<?php if( function_exists( 'get_field' ) ): 
						if( get_field( 'hero_image_slider' ) ): ?>
					
						<?php while( has_sub_field( 'hero_image_slider' ) ): 
							$images 		= get_sub_field( 'hero_image' );
							$header 		= get_sub_field( 'hero_header' );
							$description 	= get_sub_field( 'hero_description' );
							$buttonText 	= get_sub_field( 'hero_button_label' );
							$buttonLink 	= get_sub_field( 'hero_link' );
							$size = 'full'; // (thumbnail, medium, large, full or custom size)?>
					
							<div class = "hero-banner">
								<?php echo wp_get_attachment_image( $images, $size ); ?>
								<div class="hero-banner-text-box">
									<h3><?php if( $header ) { echo $header; } ?></h3>
									<p class="description"><?php if( $description ) { echo $description; } ?></p>
									<a class="cta-banner-btn btn-text btn" href="<?php if( $buttonLink ){ echo esc_url( $buttonLink ); } ?>"><?php if( $buttonText ){ echo $buttonText; }?></a>
								</div><!--.hero-banner-text-box-->
							</div><!--.hero-banner-->
						<?php endwhile; 
						endif; ?>
				<?php endif; ?>
			</section><!--.hero-image.slider-->
 			<div class = "wrapper pattern01">
					<section class="home-intro">
						<?php if(function_exists('get_field')){
							$home_intro_title 	= get_field('home_intro_title');
							$home_intro 		= get_field('home_intro');
						} ?>

						<h1 class="home-intro-title"><?php if( $home_intro_title ) { echo $home_intro_title; }?></h1>
						<p class="home-intro-text"><?php if( $home_intro ){ echo $home_intro; } ?></p>
					</section><!--.home-intro-->

					<section class ="featured-products">
						<h2>Featured Products</h2>
						<?php if( function_exists( 'get_field' ) ):
							if( get_field( 'home_featured' ) ):
								while( has_sub_field( 'home_featured' ) ): 
									$title 		= get_sub_field( 'featured_title' );
									$text 		= get_sub_field( 'featured_text' );
									$buttonText = get_sub_field( 'featured_button_label' );
									$image 		= get_sub_field( 'featured_image' );
									$link 		= get_sub_field( 'featured_link' );
									$size 		= 'medium'; // (thumbnail, medium, large, full or custom size)?>
								<div class="featured-wrapper">
									<div class = "featured-image">
										<?php if( $image && $size ) { echo wp_get_attachment_image( $image, $size ); } ?>
									</div><!--.featured-image-->

									<div class="featured-text-box">
										<div class="border-box">
										<div class="items-box">
										<h3><?php if( $title ) { echo $title; } ?></h3>
										<p><?php if( $text ) { echo $text; } ?><p>
										<a class="cta-btn" href = "<?php if( $link ) { echo esc_url( $link ); } ?>">
										<?php if( $buttonText ):?>
										<?php { echo $buttonText; } ?>
										<?php endif;?>
										</a>
										<div class="featured-p-top"></div><!-- .featured-p-top-->
									
										<div class="featured-p-bottom"></div><!-- .featured-p-top-->
										</div><!--.items-box-->	
										</div><!--.border-box-->
									</div><!--.featured-text-box-->
									
						
									
								</div><!--.featured-wrapper-->
								<?php endwhile;
							endif;
						endif; ?>
					</section><!--.featured-products-->

					<section class="category-wrapper">
						<h2>Product Categories</h2>
						<div class="category-wrapper">
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
					
						<a class="category" href="<?php if( $term_link ) { echo esc_url( $term_link ); } ?>">
								<?php if( $thumbnail_id ) { ?>
									<figure class="category-container">
									<?php echo wp_get_attachment_image( $thumbnail_id, 'woocommerce_thumbnail' ); ?>
									</figure>
								<?php }?>
								<p class="category-name"><?php echo $term->name; ?></p><!--.category-name-->
							</a><!--.category-->
						<?php endforeach;?>
					</section><!--.category-wrapper-->
				</div><!--.wrapper-->
					<section class="why-us pattern01"> 
						<h2>Why Choose Us?</h2>
						<div class="why-us-background">
						<div class="why-us-wrapper">	
						<?php if( function_exists( 'get_field' ) ):
							if( get_field( 'why_us' ) ):
								while( has_sub_field( 'why_us' ) ): 
									$title 	= get_sub_field( 'why_us_title' );
									$images = get_sub_field( 'why_us_image' );
									$size 	= 'medium'; // (thumbnail, medium, large, full or custom size)
									$lists 	= get_sub_field( 'why_us_list' ); ?>

									<div class="why-us-list-wrapper">
											<h3><?php if( $title ) { echo $title; } ?></h3>
											<?php echo wp_get_attachment_image( $images, $size );
											if($lists): ?>
												<ul>
													<?php foreach($lists as $list):
														foreach($list as $list_item):?>
															<li><span><img class = "whyus-icon" id = "whyus-icon" src="<?php echo get_template_directory_uri(); ?>/images/assets/why-us/check-icon.svg" alt="whyus-icon"></span><?php echo $list_item ?></li>
														<?php endforeach;
													endforeach; ?>
												</ul>
											<?php endif; ?>
									</div><!--.why-us-list-wrapper-->
								<?php endwhile;
							endif;
						endif; ?>
						</div><!--.why-us-wrapper-->
						</div><!--.why-us-background-->
					</section><!--.why-us-->
				<div class = "wrapper pattern01">
				<div class="blog-events-wrapper">
					<section class="latest-blog">
						<h2>Latest News</h2>
						<div class="latest-blog-wrapper">
						<?php 
						$arg = array('posts_per_page'=> 1);
						$blog_query = new WP_Query($arg);

								if($blog_query->have_posts()):
									while($blog_query->have_posts()):
										$blog_query->the_post();
										the_post_thumbnail(); ?>
										<div class="latest-blog-text-wrapper">
										<h3><a href = "<?php the_permalink(); ?>"><?php the_title();?></a></h3>
										<div class="blog-border-img"></div>
										<?php the_excerpt();?>
									<?php endwhile;
									wp_reset_postdata();
								endif; ?>
							</div><!--.latest-blog-text-wrapper-->
						</div><!--.latest-blog-wrapper-->
					</section><!--.latest-blog-->

					<section class = "upcoming-events">
						<h2>Upcoming Events</h2>
						<ul>
							<?php 
							$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'product_cat' => 'events', 'orderby' => 'rand' );
							$loop = new WP_Query( $args );

							while ( $loop->have_posts() ) :
								$loop->the_post();
								global $product; ?>
									<li class="events">    
										<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
											<?php woocommerce_show_product_sale_flash( $post, $product );?>
											
											<?php if (has_post_thumbnail( $loop->post->ID )): 
												//echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
											else: ?>
												<!-- <img src="<?php //woocommerce_placeholder_img_src()?>" alt="Paceholder" width="300px" height="300px" />-->
											<?php endif; ?> 

											<h3><?php the_title(); ?></h3>
											<!-- <p> Farm visit | Mar 28, 2020 | 09:00 - 16:00<?php //the_content();?></p>  -->
												<?php if(get_field('date') && get_field('start_time') && get_field('end_time')):?>
														<p><?php the_field('date') ?> | <?php echo the_field('start_time')?> - <?php the_field('end_time') ?></p>
												<?php endif;?>
											
										</a>
										<?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
									</li><!--.events-->
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						</ul>
					</section><!--.upcoming-events-->
				</div><!-- .blog-events-wrapper -->
					<section class="awards">
						<h2>Awards & Certificates</h2>
						<div class="award-slider">
						<?php 
							$args = array(
								'post_type' => 'hl-award',
								'posts_per_page' => -1,   // If you want to all posts, set up -1  default minimum 10
							);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) { ?>
									<?php $query->the_post();?>
									
									<div class="ac-image"><?php the_content();?></div><!--.ac-image-->
									
							<?php	}
								wp_reset_postdata();
							} 
						?>
						</div><!--.award-slides-->
					</section><!--.awards-->

					<section class="testimonials">
						<h2>Testimonials</h2>
						<div class="tm-wrapper">
						<?php 
							$args = array(
								'post_type' => 'hl-testimonial',
								'posts_per_page' => 2,   // If you want to all posts, set up -1  default minimum 10
								'orderby'=>'rand'
							);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
							?>

									<!-- //the_content(); -->
								<div class="tm-text"><?php	the_content();?></div>
							<?php		
								}
								wp_reset_postdata();
							} 
						?>
						</div> <!--.tm-wrapper-->
					</section><!--.testimonials-->
				</div><!--.wrapper-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
