<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<article <?php post_class('shop-post-item group'); ?>>

	<?php if ( has_post_thumbnail() ) { ?>

		<div class="post-thumb product-thumb normal-thumb">

			<a href="<?php the_permalink(); ?>" class="thumb-link">
				<?php the_post_thumbnail( 'qshop-product-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
				<?php wc_get_template_part('loop/sale', 'flash'); ?>
			</a>

		</div><!-- .post-thumb -->

	<?php } ?>

	<div class="product-content group">

		<div class="product-info">

			<?php 

				$arikon_product_id = $product->get_id();

				$product_cats = wc_get_product_category_list( $arikon_product_id );

				$arikon_allowed_html = [
					'a'	=> [
						'href'	=> [],
						'rel'	=> [],
					],
					'del'	=> [],
					'span'	=> [],
					'ins'	=> [],
				];

			?>

			<h3 class="post-title product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<span class="product-price"><?php echo wp_kses_post( $product->get_price_html(), $arikon_allowed_html ); ?></span>

		</div><!-- .product-info -->

		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

	</div><!-- .product-content -->

</article>