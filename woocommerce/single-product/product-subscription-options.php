<?php
/**
 * Single-Product Subscription Options Template.
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/product-subscription-options.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 2.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wcsatt-options-wrapper" <?php echo count( $options ) === 1 ? 'style="display:none;"' : '' ?>>
	<span class="price">
		<?php foreach ( $options as $option ): ?>
			<span class="<?php echo esc_attr( $option[ 'class' ] ); ?>" id="<?php echo esc_attr( $product_id ) . '-' . esc_attr( $option[ 'value' ] ) . '-price'; ?>">
				<?php if( $option[ 'value' ] == 0 ){
					echo wc_price($product->get_price());					;
				}else{
					echo $option[ 'description' ];
				} ?>
			</span>
		<?php endforeach; ?>
	</span>

	<?php if ( $prompt ) {
		echo $prompt;
	} ?>
	
	<h3><?php _e( 'Deliver', 'woocommerce-subscribe-all-the-things' ); ?></h3>

	<ul class="wcsatt-options-product">
		<?php foreach ( $options as $option ): ?>
			<li class="<?php echo esc_attr( $option[ 'class' ] ) . ' product-option'; ?>">
				<label>
					<input 	type="radio"
							class="product-option"
							name="convert_to_sub_<?php echo absint( $product_id ); ?>"
							data-custom_data="<?php echo esc_attr( json_encode( $option[ 'data' ] ) ); ?>"
							value="<?php echo esc_attr( $option[ 'value' ] ); ?>"
							<?php checked( $option[ 'selected' ], true, true ); ?> />

					<span class="<?php echo esc_attr( $option[ 'class' ] ) ?>-details">
						<?php
							if( $option[ 'value' ] == 0 ){
								echo 'Once';
							}else{
								$valArr = explode( '_', $option[ 'value' ] );
								if( $valArr[0] == '1' ){
									echo 'Every ' . $valArr[1];
								}else{
									echo 'Every ' . $valArr[0] . $valArr[1];
								}
							}
						?>
					</span>
				</label>
			</li>
			
		<?php endforeach; ?>
	</ul>
</div>
