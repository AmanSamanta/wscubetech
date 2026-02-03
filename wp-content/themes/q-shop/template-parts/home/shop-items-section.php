<?php
/**
 * Shop Items Section template part.
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}
?>

<?php if ( is_active_sidebar( 'shop-sidebar-widgets' ) ) { ?>

    <div class="wrapper group 2-col-products">

        <?php if ( get_theme_mod( 'qshop_shop_items_title', __( 'Shop Items', 'q-shop' ) ) ) : ?>

            <div class="section-title group shop-items-title">

                <span class="section-subtitle"><?php echo esc_html( get_theme_mod( 'qshop_shop_items_subtitle', __( 'Wardrobe Essentials', 'q-shop' ) ) ); ?></span>

                <h2><?php echo esc_html( get_theme_mod( 'qshop_shop_items_title', __( 'Shop Items', 'q-shop' ) ) ); ?></h2>

                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="view-all-link corner-btn">
                    <?php esc_html_e( 'All Products', 'q-shop' ); ?>
                </a>

            </div>

        <?php endif; ?>
        
        <div class="products-wrap-left">

            <?php

                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

                echo do_shortcode( '[products limit="6" columns="2"]' );

                add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

            ?>

            <div class="view-all-products-link">
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="button">
                    <?php esc_html_e( 'View All Products', 'q-shop' ); ?>
                </a>
            </div>

        </div><!-- .products-wrap-left -->

        <div class="sidebar-wrap main-sidebar-wrap">

		    <aside class="main-sidebar widget-sidebar group">

		        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Shop Sidebar Widgets', 'q-shop'))) : else : ?>
		        
		        <?php endif; ?>

		    </aside>

		</div><!-- .sidebar-wrap -->

    </div><!-- .wrapper -->

<?php } else { ?>

    <div class="wrapper group full-width-products">

        <?php if ( get_theme_mod( 'qshop_shop_items_title', __( 'Shop Items', 'q-shop' ) ) ) : ?>

            <div class="section-title group shop-items-title">

                <span class="section-subtitle"><?php echo esc_html( get_theme_mod( 'qshop_shop_items_subtitle', __( 'Wardrobe Essentials', 'q-shop' ) ) ); ?></span>

                <h2><?php echo esc_html( get_theme_mod( 'qshop_shop_items_title', __( 'Shop Items', 'q-shop' ) ) ); ?></h2>

                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="view-all-link corner-btn">
                    <?php esc_html_e( 'All Products', 'q-shop' ); ?>
                </a>

            </div>

        <?php endif; ?>
        

        <?php

            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

            echo do_shortcode( '[products limit="6" columns="3"]' );

            add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
            add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

        ?>

        <div class="view-all-products-link">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="button">
                <?php esc_html_e( 'All Products', 'q-shop' ); ?>
            </a>
        </div>

    </div><!-- .wrapper -->

<?php } ?>