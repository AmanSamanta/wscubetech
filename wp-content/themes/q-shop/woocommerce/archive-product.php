<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>

<div class="wrapper clear-both group">

	<?php

		do_action( 'woocommerce_before_main_content' );

		/**
		* Hook: woocommerce_before_shop_loop.
		*
		* @hooked woocommerce_output_all_notices - 10
		* @hooked woocommerce_result_count - 20
		* @hooked woocommerce_catalog_ordering - 30
		*/
		do_action( 'woocommerce_before_shop_loop' );

	?>

	<?php if ( is_active_sidebar( 'shop-sidebar-widgets' ) ) { ?>

		<div class="products-wrap-left shop-with-sidebar clear-both group">

			<?php if ( woocommerce_product_loop() ) {

				woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) { ?>


						<?php
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						?>

						<?php

					}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );

			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );

			} ?>

		</div><!-- .shop-with-sidebar -->

		<div class="sidebar-wrap main-sidebar-wrap">

		    <aside class="main-sidebar widget-sidebar group">

		        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Shop Sidebar Widgets', 'q-shop'))) : else : ?>
		        
		        <?php endif; ?>

		    </aside>

		</div><!-- .sidebar-wrap -->

	<?php } else { ?>

		<div class="full-width-products clear-both group">

			<?php

			if ( woocommerce_product_loop() ) {

				woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) { ?>


						<?php
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						?>

						<?php

					}

				woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );

			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );

			} ?>

		</div><!-- .full-width-shop -->

	<?php } ?>

	<?php

		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		*/
		do_action( 'woocommerce_after_main_content' );

	?>

</div><!-- .wrapper -->

<?php get_footer( 'shop' ); ?>