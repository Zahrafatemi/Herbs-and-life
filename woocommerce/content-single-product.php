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
		?>
		<?php if(get_field('place')):?>
			<div class="event-place">
				<?php the_field('place') ?>
			</div>
		<?php endif;?>

		<?php if(get_field('address')):?>
			<div class="event-address">
				<?php the_field('address') ?>
			</div>
		<?php endif;?>

		<?php if(get_field('date')):?>
			<div class="event-date">
				<?php the_field('date') ?>
			</div>
		<?php endif;?>

		<?php if(get_field('start_time')):?>
			<div class="event-start-time">
				<?php the_field('start_time') ?>
			</div>
		<?php endif;?>

		<?php if(get_field('end_time')):?>
			<div class="event-end-time">
				<?php the_field('end_time') ?>
			</div>
		<?php endif;?>

		<?php if(get_field('note')):?>
			<div class="event-note">
				<?php the_field('note') ?>
			</div>
		<?php endif;?>

		<?php
		if(get_field('location')):
		?>
		<?php if((is_product() && has_term('events', 'product_cat', $post->ID))):?>
		<div class="acf-map" data-zoom="16" style="overflow: hidden; position: relative;">
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
		
		<?php
		endif;

				

	
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
