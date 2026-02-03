<?php if ( is_active_sidebar( 'blog-sidebar-widgets' ) ) { ?>

    <div class="sidebar-wrap main-sidebar-wrap">

        <aside class="main-sidebar widget-sidebar group">

            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(esc_html__('Blog Sidebar Widgets', 'q-shop'))) : else : ?>
            
            <?php endif; ?>

        </aside>

    </div><!-- .sidebar-wrap -->

<?php } ?>