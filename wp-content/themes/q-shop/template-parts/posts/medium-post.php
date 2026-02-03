<?php
/**
 * Medium Post template part.
 */
?>
	
<article <?php post_class('medium-post'); ?>>

	<?php if ( has_post_thumbnail() ) { ?>

		<div class="post-thumb">

			<a href="<?php the_permalink(); ?>" class="thumb-link">
			
				<?php the_post_thumbnail( 'qshop-medium-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
		
			</a>

            <?php
				$qshop_categories = get_the_category();

				if ( !empty( $qshop_categories ) ) {
					echo '<a href="' . esc_url( get_category_link( $qshop_categories[0]->term_id ) ) . '" class="thumb-cat">' . esc_html( $qshop_categories[0]->name ) . '</a>';
				}
			?>

		</div><!-- .post-thumb -->

	<?php } ?>

    <div class="post-content group">

		<h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

		<div class="meta-wrap">
			
			<span class="post-date post-meta"><?php esc_html_e('On:', 'q-shop'); ?><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></span>

			<a href="<?php the_permalink(); ?>" class="read-more-btn corner-btn" title="<?php esc_attr_e('Read More', 'q-shop'); ?>">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.999995 10.1924H19.3848M19.3848 10.1924L10.1924 1M19.3848 10.1924L10.1924 19.3848" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>

		</div><!-- .meta-wrap -->

	</div><!-- .post-content -->
	
</article>