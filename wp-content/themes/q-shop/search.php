<?php get_header(); ?>

<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) { ?>

    <div class="recent-main-wrap wrapper group">

		<div class="section-title group shop-items-title">

			<h2><?php esc_html_e( 'Results for: ', 'q-shop' ); ?><?php echo esc_html( get_search_query() ); ?></h2>

		</div>

        <div class="recent-posts-wrap group">

            <div class="recent-posts recent-posts-medium masonry-posts group">

                <?php

                    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                    else { $paged = 1; }

                    $qshop_number_of_posts = esc_html( get_option('posts_per_page') );

                    $qshop_search_query = get_search_query();
                    $qshop_temp = $wp_query;
                    $wp_query = null;
                    $wp_query = new WP_Query(array(
                        's' => $qshop_search_query,
                        'posts_per_page' => $qshop_number_of_posts,
                        'paged' => $paged
                    ));

                    while ($wp_query->have_posts()) : $wp_query->the_post();

                        get_template_part('template-parts/posts/medium', 'post');

                    endwhile;
                    wp_reset_postdata();

                ?>

            </div><!-- .recent-posts -->

            <?php get_template_part('template-parts/pagination'); ?>

        </div><!-- .recent-posts-wrap -->

        <div class="sidebar-wrap main-sidebar-wrap">

            <?php get_sidebar(); ?>

        </div><!-- .sidebar-wrap -->

    </div><!-- .wrapper -->

<?php } else { ?>

    <div class="recent-main-wrap wrapper clear-both group">

        <div class="section-title group shop-items-title">

			<h2><?php esc_html_e( 'Results for: ', 'q-shop' ); ?><?php echo esc_html( get_search_query() ); ?></h2>

		</div>

        <div class="full-width-posts masonry-posts group">

            <?php

                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                else { $paged = 1; }

                $qshop_number_of_posts = esc_html( get_option('posts_per_page') );

                $qshop_search_query = get_search_query();
                $qshop_temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query(array(
                    's' => $qshop_search_query,
                    'posts_per_page' => $qshop_number_of_posts,
                    'paged' => $paged
                ));

                while ($wp_query->have_posts()) : $wp_query->the_post();

                    get_template_part('template-parts/posts/medium', 'post');

                endwhile;
                wp_reset_postdata();

            ?>

        </div><!-- .full-width-posts -->

        <?php get_template_part('template-parts/pagination'); ?>

    </div><!-- .wrapper -->

<?php } ?>

<?php get_footer(); ?>