<?php
/**
 * Related Posts template part.
 */
?>

<div class="related-posts-wrap group">

	<?php

		$qshop_args = array(
			'category__in' => wp_get_post_categories($post->ID),
			'post__not_in' => array($post->ID),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand'
		);

		$qshop_my_query = new WP_Query($qshop_args);
		
		if( $qshop_my_query->have_posts() ) { ?>

			<div class="section-title group shop-items-title">

				<span class="section-subtitle"><?php echo esc_html_e('From this category', 'q-shop') ?></span>

				<h2><?php echo esc_html_e('Related Posts', 'q-shop') ?></h2>

				<?php

					$qshop_categories = get_the_category();
					
					$qshop_category_link = !empty($qshop_categories) ? get_category_link($qshop_categories[0]->term_id) : get_permalink(get_option('page_for_posts'));

				?>

				<a href="<?php echo esc_url($qshop_category_link); ?>" class="view-all-link corner-btn">
					<?php esc_html_e( 'View All', 'q-shop' ); ?>
				</a>

			</div>

			<div id="related-posts" class="group">

				<?php while ($qshop_my_query->have_posts()) : $qshop_my_query->the_post(); ?>
		
					<?php get_template_part('template-parts/posts/medium', 'post'); ?>
		
				<?php endwhile; ?>
			
			</div>
		
		<?php }
			
		wp_reset_postdata();
		
	?>

</div><!-- .related-posts-wrap -->