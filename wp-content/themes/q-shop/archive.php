<?php get_header(); ?>

    <?php if ( is_active_sidebar( 'sidebar-widgets' ) ) { ?>

        <div class="recent-main-wrap wrapper group">

            <div class="recent-posts-wrap group">

				<?php if ( have_posts() ) : ?>

                <div class="recent-posts recent-posts-medium masonry-posts group">

					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('template-parts/posts/medium', 'post'); ?>

					<?php endwhile; ?>

                </div><!-- .recent-posts -->

				<?php else : ?>

					<?php get_template_part('template-parts/nothing', 'found'); ?>

				<?php endif; ?>

                <?php get_template_part('template-parts/pagination'); ?>

            </div><!-- .recent-posts-wrap -->

            <div class="sidebar-wrap main-sidebar-wrap">

                <?php get_sidebar(); ?>

            </div><!-- .sidebar-wrap -->

        </div><!-- .wrapper -->

    <?php } else { ?>

        <div class="recent-main-wrap wrapper clear-both group">

			<?php if ( have_posts() ) : ?>

				<div class="full-width-posts masonry-posts group">

					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('template-parts/posts/medium', 'post'); ?>

					<?php endwhile; ?>

				</div><!-- .full-width-posts -->

			<?php else : ?>

				<?php get_template_part('template-parts/nothing', 'found'); ?>

			<?php endif; ?>

            <?php get_template_part('template-parts/pagination'); ?>

        </div><!-- .wrapper -->

    <?php } ?>

<?php get_footer(); ?>