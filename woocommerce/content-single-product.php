<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		if((has_term('events', 'product_cat', $post->ID))):
			?>
		<div class="event-details">
			<div class="details location">

				<!-- Adding the location Icon -->
				<div class="icon location">
				<!-- <?php //echo (get_field('location_icon'))? wp_get_attachment_image( get_field('location_icon') , 'full' ) : wp_get_attachment_image(578, 'full'); ?> -->
					<?php if(get_field('location_icon')):?>
						<!-- <div class="location-icon"> -->
							<?php echo wp_get_attachment_image( get_field('location_icon') , 'full' ); ?>
						<!-- </div> -->
					<?php else:?>
							<?php echo wp_get_attachment_image(578, 'full'); ?>
					<?php endif;?>
				</div>

				<!-- Adding the place name and address -->
				<div class="location-details">
					<?php if(get_field('place')):?>
						<!-- <div class="event-place"> -->
							<p><?php the_field('place') ?></p>
						<!-- </div> -->
					<?php endif;?>

					<?php if(get_field('address')):?>
						<!-- <div class="event-address"> -->
							<p><?php the_field('address') ?></p>
						<!-- </div> -->
					<?php endif;?>
				</div>
			</div>

			<div class="details time">
				<!-- Adding the time Icon -->
				<div class="icon time">
					<?php if(get_field('time_icon')):?>
						<!-- <div class="time-icon"> -->
							<?php echo wp_get_attachment_image( get_field('time_icon') , 'full' ); ?>
						<!-- </div> -->
					<?php else:?>
							<?php echo wp_get_attachment_image(579, 'full'); ?>
					<?php endif;?>
				</div>

				<div class="date-details">
					<div class="time-details">
						<?php if(get_field('date')):?>
							<!-- <div class="event-date"> -->
								<p><?php the_field('date') ?></p>
							<!-- </div> -->
						<?php endif;?>

						<?php if(get_field('start_time') && get_field('end_time')):?>
							<!-- <div class="event-time"> -->
								<p><?php echo the_field('start_time')?> to <?php the_field('end_time') ?></p>
							<!-- </div> -->
						<?php endif;?>
					</div>
					<?php if(get_field('note')):?>
						<div class="event-note">
							<p><?php the_field('note'); ?></p>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div><!--end of event-details-->
		<!-- <?php //endif; ?> -->
		<?php if((has_term('events', 'product_cat', $post->ID))): ?>
			<h2 class="description-title">Description</h2>
			<div class="event-description">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<div class="event-map">
			<div class="acf-map-border">
				<?php if(get_field('location')):?>
					<?php if((is_product() && has_term('events', 'product_cat', $post->ID))):?>
						<div class="acf-map" data-zoom="10" style="overflow: hidden; position: relative;">
					<?php endif;?>
			
					<?php 
					$address = get_field('location');
					$icon = get_template_directory_uri().'/images/markers/map-marker.png';
					?>
						<div class="marker" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>" data-img="<?php echo $icon; ?>">
							<div class="inside-marker">
								<h5><?php echo esc_html( $address['address'] ); ?></h5>
							</div>
						</div>
						</div><!--end of acf-map-->
			</div>
		</div>
		<?php endif; ?>
		<?php endif;?>	

		<?php
			// Get the ID of a given category
			//$category_id = get_cat_ID( 'Events' );
		
			// Get the URL of this category
			$category_link = get_category_link( 47 );
		?>
		
		<?php if((has_term('events', 'product_cat', $post->ID))): ?>
			<div class="button-events-list">
				<button class="woo-btn">
					<a href="<?php echo esc_url( $category_link ); ?>" title="all events">Back to All Events</a>
				</button>	
			</div>
		<?php endif; ?>
</div>
<?php
	if((!has_term('events', 'product_cat', $post->ID))):
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	endif;
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
