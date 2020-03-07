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
$title = preg_replace('/[^a-z0-9-]/i', '' , str_replace( ' ', '-', trim(strtolower( $banner[ 'title' ] ) ) ) );

// Get the size
$size = "col-0" . $banner[ 'size' ];

// Get the classes
$class = "{$title} {$size} {$banner[ 'style' ]} promotional-banner";

// Assign image alt
if( $banner[ 'background_image' ][ 'alt' ] ){
    $alt = $banner[ 'background_image' ][ 'alt' ];
}else{
    $alt = "Promotional banner";
}

// Format URLs
if( $banner[ 'background_image' ][ 'url' ] ){
    $imgURL = esc_url( $banner[ 'background_image' ][ 'url' ] );
}
if( $banner[ 'link' ][ 'link_url' ] ){
    $bannerURL = esc_url( $banner[ 'link' ][ 'link_url' ] );
}

?>

<li class="<?php echo $class; ?>">
    <?php if( $bannerURL && $banner[ 'link' ][ 'link_placement' ] == 'banner' ): ?>
        <a class="banner-link banner" href="<?php echo esc_url( $banner[ 'link' ][ 'link_url' ] ); ?>">
    <?php endif; ?>

            <?php if( $imgURL ): ?>
                <img class="background-image" src="<?php echo $imgURL; ?>" alt="<?php echo $alt; ?>" /><!--.background-image-->
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
                    <a class="banner-link button" href="<?php echo $bannerURL; ?>" >
                        <?php echo $banner[ 'link' ][ 'button_text' ]; ?>
                    </a><!--.banner-link.button-->
                <?php endif; ?>
            </div><!--.content-->
    <?php if( $bannerURL && $banner[ 'link' ][ 'link_placement' ] == 'banner' ): ?>
        </a><!--.banner-link.banner-->
    <?php endif; ?>


</li><!--.<?php echo str_replace( ' ', '.', $class ) ; ?>.promotional-banner"-->