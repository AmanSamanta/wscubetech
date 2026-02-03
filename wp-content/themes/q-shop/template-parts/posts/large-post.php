<?php
/**
 * Large Post template part.
 */
?>
	
<article <?php post_class('large-post'); ?>>

	<div class="post-content group">

		<h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

		<ul class="post-meta">

			<?php
				$qshop_categories = get_the_category();

				if ( !empty( $qshop_categories ) ) {
					echo '<li class="post-cat"><span class="meta-span">' . esc_html__('In:', 'q-shop') . '</span> <a href="' . esc_url( get_category_link( $qshop_categories[0]->term_id ) ) . '">' . esc_html( $qshop_categories[0]->name ) . '</a></li>';
				}
			?>
			
			<li class="post-date post-meta"><span class="meta-span"><?php esc_html_e('On:', 'q-shop'); ?></span> <a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></li>

		</ul>

	</div><!-- .post-content -->

	<?php if ( has_post_thumbnail() ) { ?>

		<div class="post-thumb">

			<a href="<?php the_permalink(); ?>" class="thumb-link">
			
				<?php the_post_thumbnail( 'qshop-single-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
		
			</a>

		</div><!-- .post-thumb -->

	<?php } ?>

	<?php if ( !has_excerpt() ) { ?>

		<?php $qshop_content = get_the_content(); ?>

		<p class="excerpt"><?php echo wp_trim_words( $qshop_content, 12, ' ...' ); ?></p>

	<?php } else { ?>

		<p class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 12, ' ...' ); ?></p>

	<?php } ?>

	<a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e('Read More', 'q-shop'); ?><span class="btn-arrow"></span></a>
	
</article>