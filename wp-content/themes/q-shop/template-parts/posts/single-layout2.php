<?php
/**
 * Single Post Layout 2 template part.
 */
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if ( has_post_thumbnail() ) { ?>

		<div class="post-thumb single-thumb single-thumb-center">

			<?php the_post_thumbnail( 'qshop-single-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>

		</div><!-- .post-thumb -->

	<?php } ?>

	<div class="wrapper group single-wrap single-wrap-center">

		<div class="inner-single-wrap-center">

			<div class="single-header single-header-center group">

				<div class="single-categories group">
					<?php the_category(' ', ''); ?>
				</div>

				<h1 class="single-post-title"><?php the_title(); ?></h1>

				<?php 
				
					$qshop_num_comments = get_comments_number();

					if ( comments_open() ) {
				
						if ( $qshop_num_comments == 0 ) {
				
							$qshop_comments = esc_html__('0', 'q-shop');
				
						} elseif ( $qshop_num_comments > 1 ) {
				
							$qshop_comments = $qshop_num_comments;
				
						} else {
				
							$qshop_comments = esc_html__('1', 'q-shop');
						}
				
					} else {
				
						$qshop_comments =  esc_html__('Comments closed', 'q-shop');
				
					}

				?>
						
				<ul class="author-meta-single group">
					<li class="author col-1">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '36' ); ?>
						<span class="author-name"><?php echo esc_html__('By: ', 'q-shop'); ?><?php echo get_the_author(); ?>
						<svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.5 0.5L5.5 5.5L0.5 10.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						</span>
						</a>
					</li>
					<li class="date col-2">
						<a href="<?php comments_link(); ?>" class="meta-comments" title="<?php echo esc_attr( 'Comments', 'q-shop' ); ?>">
							<?php echo esc_html( $qshop_comments ); ?>
						</a>
						<?php the_time( get_option('date_format') ); ?>
					</li>
				</ul>

			</div><!-- .single-header -->

			<article id="post-<?php the_ID(); ?>" <?php post_class('single-article group'); ?>>

				<div class="entry group">

					<?php the_content(); ?>

					<?php wp_link_pages(); ?>

				</div><!-- .entry -->

				<?php
					if ( shortcode_exists( 'qshop-single-share' ) ) {
						echo qshop_single_share(); 
					}
				?>

				<?php if( has_tag() ) { ?>

					<div class="tagcloud single-tags group">
						<?php the_tags('', ''); ?>
					</div>

				<?php } ?>

			</article>

			<?php comments_template(); ?>

		</div><!-- .inner-single-wrap-center -->

	</div><!-- .wrapper -->

	<div class="related-posts-wrap wrapper group">
		
		<?php get_template_part('template-parts/related-posts'); ?>
		
	</div>

<?php endwhile; endif; ?>