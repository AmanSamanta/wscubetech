<?php
/**
 * Cart Sidebar template part.
 */
if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}
?>

<div id="cart-sidebar" class="widget-sidebar group">

   <?php the_widget('WC_Widget_Cart'); ?>

</div><!-- #cart-sidebar -->

