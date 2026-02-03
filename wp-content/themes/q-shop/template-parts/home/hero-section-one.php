<?php
/**
 * Hero Section One template part.
 */
?>

<?php

    $qshop_cta_button_url = get_theme_mod('qshop_call_to_action_url');

    $qshop_cta_image_url = get_theme_mod('qshop_call_to_action_image');

?>

<section id="hero-section">

    <div class="hero-content hero-section-one wrapper">

        <div class="hero-text">
            <h1><?php echo esc_html( get_theme_mod('qshop_hero_title') ); ?></h1>
            <p><?php echo esc_html( get_theme_mod('qshop_hero_paragraph') ); ?></p>
        </div>

        <?php

            if ( empty($qshop_cta_button_url) ) {
                if ( class_exists( 'WooCommerce' ) ) {
                    $qshop_cta_button_url = get_permalink( wc_get_page_id( 'shop' ) );
                } else {
                    $qshop_cta_button_url = '#';
                }
            }

        ?>

        <div class="hero-call-to-action">

            <span class="hero-call-to-action-text">

                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5 0L11.0351 9.02985L17.2493 2.45653L11.8549 9.71775L20.8405 8.67669L12.0407 10.7717L19.5933 15.75L11.5056 11.6985L14.0912 20.3668L10.5 12.0645L6.90879 20.3668L9.49436 11.6985L1.40673 15.75L8.95927 10.7717L0.159518 8.67669L9.1451 9.71775L3.75073 2.45653L9.96491 9.02985L10.5 0Z" fill="currentColor"/>
                </svg>

                <span><?php echo esc_html( get_theme_mod('qshop_call_to_action_text') ); ?></span>

            </span>
            
            <div class="hero-call-to-action-image">
                <?php

                    if ($qshop_cta_image_url) {

                        $qshop_cta_image_id = attachment_url_to_postid($qshop_cta_image_url);

                        if ($qshop_cta_image_id) {
                            echo wp_get_attachment_image($qshop_cta_image_id, 'qshop-small-thumb', false, ['alt' => esc_attr__('Call to Action Image', 'q-shop')]);
                        } else {
                            echo '<img src="' . esc_url($qshop_cta_image_url) . '" alt="' . esc_attr__('Call to Action Image', 'q-shop') . '">';
                        }

                    }
                ?>
            </div>

            <a href="<?php echo esc_url( $qshop_cta_button_url ); ?>" class="hero-cta-button"><?php echo esc_html__('Shop Now', 'q-shop'); ?></a>

        </div>
        
    </div>
	
</section>