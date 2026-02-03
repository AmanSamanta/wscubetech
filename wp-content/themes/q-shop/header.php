<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php

        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        }

    ?>

    <!-- Skip Links for Accessibility -->
    <a href="#main-content" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to main content', 'q-shop' ); ?></a>
    <a href="#main-nav" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to navigation', 'q-shop' ); ?></a>

    <?php

        get_template_part('template-parts/header/main-header');

    ?>

    <?php if ( esc_html( $qshop_search_option = get_theme_mod('qshop_header_search') ) == 'on' ) { ?>

        <div id="modal-search">

            <div id="modal-search-inner">
            
                <?php get_search_form(); ?>

                <span class="search-info"><?php esc_html_e('Type search above and then hit Enter.', 'q-shop'); ?></span>

                <span class="m-search-close" title="<?php esc_attr_e('Close', 'q-shop'); ?>"></span>

            </div><!-- #modal-search-inner -->

        </div><!-- #modal-search -->

    <?php } ?>

    <div id="body-overlay-wrap"></div>

    <div id="main-content" class="site-main-content">