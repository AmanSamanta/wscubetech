<?php
/**
 * First Home template part.
 */
?>

<?php if( !is_paged() ) { ?>

	<?php 
		
		if ( function_exists( 'qshop_enqueue_pro_addon_styles' ) ) {

			$qshop_hero_design = get_theme_mod('qshop_hero_design', 'hero_one');

			if ( $qshop_hero_design === 'hero_two' ) {

				include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/hero-section-two.php';

			} elseif ( $qshop_hero_design === 'hero_three' ) {

				include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/hero-section-three.php';

			} else {

				get_template_part('template-parts/home/hero', 'section-one');

			}

		} else {

			get_template_part('template-parts/home/hero', 'section-one');

		}

	?>

	<?php if ( class_exists( 'WooCommerce' ) && ! function_exists( 'qshop_enqueue_pro_addon_styles' ) ) { ?>

		<?php get_template_part('template-parts/home/shop-items', 'section'); ?>

	<?php } else { ?>
		
		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/featured-products.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/large-product.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/featured-categories.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/newsletter-section.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/reviews-section.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/blog-section.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/faq-section.php'; ?>

		<?php include_once WP_PLUGIN_DIR . '/qshop-pro-addon/inc/gallery-section.php'; ?>

	<?php } ?>

<?php } ?>