<?php if ( ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) || is_page_template( 'homepage.php' ) ) { ?>

    <form role="search" method="get" id="searchform" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="text" id="s" name="s" value="<?php esc_attr_e('Search products ...', 'q-shop'); ?>">
        <input type="submit" value="<?php esc_attr_e('Search', 'q-shop'); ?>" id="searchsubmit">
        <input type="hidden" name="post_type" value="product" />
    </form>

<?php } else { ?>

    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get">
        <input type="text" id="s" name="s" value="<?php esc_attr_e('Search blog posts ...', 'q-shop'); ?>">
        <input type="submit" value="<?php esc_attr_e('Search', 'q-shop'); ?>" id="searchsubmit">
    </form>
    
<?php } ?>