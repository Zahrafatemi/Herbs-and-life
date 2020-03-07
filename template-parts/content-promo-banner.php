<?php
/**
 * Template part for displaying promotional banners
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

?>

<?php
// Get the ACF field data
$banner = get_query_var( 'promotionalBanner' );

// Format the title
$title = preg_replace('/[^a-z0-9-]/i', '' , str_replace(' ', '-', strtolower( $banner[ 'title' ] ) ));

// Assign default image alt value
if( !$banner[ 'background_image' ][ 'alt' ] ){
    $banner[ 'background_image' ][ 'alt' ] = "Promotional banner";
}

?>

<li class="<?php echo $title . ' ' . $banner[ 'size' ]; ?> promotional-banner" style="background-color:<?php echo $banner[ 'background_colour' ]; ?>;">
    <?php if( $banner[ 'link' ][ 'link_url' ] && $banner[ 'link' ][ 'link_placement' ] == 'banner' ): ?>
        <a class="banner-link banner" href="<?php echo esc_url( $banner[ 'link' ][ 'link_url' ] ); ?>">
    <?php endif; ?>

            <?php if( $banner[ 'background_image' ][ 'url' ] ): ?>
                <img class="background-image" src="<?php echo $banner[ 'background_image' ][ 'url' ]; ?>" alt="<?php echo $banner[ 'background_image' ][ 'alt' ]; ?>" /><!--.background-image-->
            <?php endif; ?>

            <div class="content">
                <div class="text">
                    <?php if( $banner[ 'heading_text' ] ): ?>
                        <h2 class="heading"><?php echo $banner[ 'heading_text' ]; ?></h2><!--.heading.text-->
                    <?php endif; ?>

                    <?php if( $banner[ 'subheading_text' ] ): ?>
                        <p class="subheading"><?php echo $banner[ 'subheading_text' ]; ?></p><!--.subheading.text-->
                    <?php endif; ?>
                </div><!--.text-->

                <?php if( $banner[ 'link' ][ 'link_placement' ] == 'button' ): ?>
                    <a class="banner-link button" href="<?php echo esc_url( $banner[ 'link' ][ 'link_url' ] ); ?>" style="background-color: <?php echo $banner[ 'link' ][ 'button_colour' ]?>; color: <?php echo $banner[ 'link' ][ 'button_text_colour' ]?>;">
                        <?php echo $banner[ 'link' ][ 'button_text' ]; ?>
                    </a><!--.banner-link.button-->
                <?php endif; ?>
            </div><!--.content-->
    <?php if( $banner[ 'link' ][ 'link_url' ] && $banner[ 'link' ][ 'link_placement' ] == 'banner' ): ?>
        </a><!--.banner-link.banner-->
    <?php endif; ?>


</li><!--.<?php echo $banner[ 'title' ] . ' ' . $banner[ 'size' ]; ?>.promotional-banner"-->