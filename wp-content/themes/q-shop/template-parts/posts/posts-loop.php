<?php
/**
 * Posts Loop template part.
 */
?>

<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) { ?>

    <div class="recent-main-wrap wrapper group">

        <div class="recent-posts-wrap group">

            <div class="recent-posts recent-posts-medium masonry-posts group">

                <?php

                    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                    else { $paged = 1; }

                    $qshop_number_of_posts = esc_html( get_option('posts_per_page') );

                    $temp = $wp_query;
                    $wp_query= null;
                    $wp_query = new WP_Query();
                    $wp_query->query('posts_per_page='.$qshop_number_of_posts.'&paged='.$paged);

                    while ($wp_query->have_posts()) : $wp_query->the_post();

                        get_template_part('template-parts/posts/medium', 'post');

                    endwhile;

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

        <div class="full-width-posts masonry-posts group">

            <?php

                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                else { $paged = 1; }

                $qshop_number_of_posts = esc_html( get_option('posts_per_page') );

                $temp = $wp_query;
                $wp_query= null;
                $wp_query = new WP_Query();
                $wp_query->query('posts_per_page='.$qshop_number_of_posts.'&paged='.$paged);

                while ($wp_query->have_posts()) : $wp_query->the_post();

                    get_template_part('template-parts/posts/medium', 'post');

                endwhile;

            ?>

        </div><!-- .full-width-posts -->

        <?php get_template_part('template-parts/pagination'); ?>

    </div><!-- .wrapper -->

<?php } ?>