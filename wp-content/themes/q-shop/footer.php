</div><!-- #main-content -->

<footer id="main-footer">

    <?php do_action( 'qshop_footer_info' ); ?>

    <?php if ( is_active_sidebar( 'footer-widgets' ) ) { ?>

        <div class="wrapper footer-widgets group">

            <?php if ( function_exists('dynamic_sidebar' ) && dynamic_sidebar( esc_html__( 'Footer Widgets', 'q-shop' ) ) ) : else : ?>
            
            <?php endif; ?>

        </div>

    <?php } ?>

    <?php do_action( 'qshop_footer_payment_methods' ); ?>

    <div id="copyright">

        <div class="wrapper">

            <?php

                $footer_text_left = get_theme_mod( 'qshop_footer_text_left' );
                $footer_text_right = get_theme_mod( 'qshop_footer_text_right' );

                if ( empty( $footer_text_left ) || empty( $footer_text_right ) ) {

                    printf(
                        '<p class="footer-copy-text copy-left">&copy; %s - %s <a href="%s">%s</a></p>',
                        esc_html( date('Y') ),
                        esc_html__( 'Q Shop - Powered by', 'q-shop' ),
                        esc_url( 'https://wordpress.org' ),
                        esc_html__( 'WordPress', 'q-shop' )
                    );

                    printf(
                        '<p class="footer-copy-text copy-right">%1$s - <a href="%2$s">%3$s</a></p>',
                        esc_html__( 'Made by', 'q-shop' ),
                        esc_url( 'https://daison.me' ),
                        esc_html__( 'Daison', 'q-shop' )
                    );

                } else {

                    echo '<p class="footer-copy-text copy-left">' . wp_kses_post( $footer_text_left ) . '</p>';

                    echo '<p class="footer-copy-text copy-right">' . wp_kses_post( $footer_text_right ) . '</p>';

                }

            ?>

        </div><!-- .wrapper -->

    </div><!-- #copyright -->

    <div id="back-to-top" class="corner-btn" title="<?php echo esc_attr__( 'Back to top', 'q-shop' ); ?>">
        <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.1464 8.85355L16.5 9.20711L17.2071 8.5L16.8536 8.14645L16.5 8.5L16.1464 8.85355ZM8.5 0.5L8.85355 0.146447C8.65829 -0.0488155 8.34171 -0.0488155 8.14645 0.146447L8.5 0.5ZM0.146447 8.14645C-0.0488155 8.34171 -0.0488155 8.65829 0.146447 8.85355C0.341709 9.04882 0.658291 9.04882 0.853553 8.85355L0.5 8.5L0.146447 8.14645ZM16.5 8.5L16.8536 8.14645L8.85355 0.146447L8.5 0.5L8.14645 0.853553L16.1464 8.85355L16.5 8.5ZM8.5 0.5L8.14645 0.146447L0.146447 8.14645L0.5 8.5L0.853553 8.85355L8.85355 0.853553L8.5 0.5Z" fill="currentColor"/>
        </svg>
    </div>

</footer>

<?php wp_footer(); ?>

</body>

</html>
