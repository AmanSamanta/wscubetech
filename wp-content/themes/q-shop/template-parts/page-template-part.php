<?php
	//Page Template Part file
?>

<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) { ?>

	<div class="wrapper clear-both group page-temp">

		<div class="single-outer-wrap page-temp-wrap single-wrap-left">

			<h1 class="main-page-heading"><?php echo single_post_title(); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div <?php post_class('page-temp-article group'); ?> >

					<?php if ( has_post_thumbnail() ) { ?>

						<div class="post-thumb single-thumb">

							<?php the_post_thumbnail( 'arikon-single-thumb-s', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>

						</div>

					<?php } ?>

					<div class="entry group">

						<?php the_content(); ?>

					</div><!-- .entry -->

				</div>

				<?php comments_template(); ?>

			<?php endwhile; endif; ?>

			<?php wp_link_pages(); ?>

		</div><!-- .page-temp-wrap -->

		<div class="sidebar-wrap main-sidebar-wrap">

			<?php get_sidebar(); ?>

		</div><!-- .sidebar-wrap -->

	</div><!-- .wrapper -->

<?php } else { ?>

	<div id="full-width-page" class="wrapper group page-temp">

		<h1 class="main-page-heading"><?php echo single_post_title(); ?></h1>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
								
				<div class="entry group">
					<?php the_content(); ?>
				</div>
			
				<?php wp_link_pages(); ?>
				
			</div>

			<?php comments_template(); ?>

		<?php endwhile; endif; ?>

	</div><!-- #full-width-page -->

<?php } ?>