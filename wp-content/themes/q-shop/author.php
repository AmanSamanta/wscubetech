<?php get_header(); ?>

    <div class="recent-main-wrap wrapper clear-both group">

        <div class="author-info group">

            <div class="author-avatar">
                <?php echo get_avatar(get_the_author_meta('ID'), 120); ?>
            </div>

            <div class="author-content">
                <h2 class="author-title"><?php the_author(); ?></h2>
                <p class="author-description"><?php the_author_meta('description'); ?></p>
            </div>

            <?php if ( is_plugin_active( 'qshop-pro-addon/qshop-pro-addon.php' ) ) { ?>

                <ul class="author-icons">

                    <?php if ( esc_url( get_the_author_meta( 'x' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="x-link" title="<?php esc_attr_e('X', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'x' ) ); ?>">
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.1749 0H16.9357L10.9057 6.77737L18 16H12.4458L8.09549 10.4055L3.11737 16H0.3555L6.80511 8.75033L0 0H5.69586L9.62774 5.11228L14.1749 0ZM13.2075 14.3757H14.7375L4.86337 1.53931H3.22313L13.2075 14.3757Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( esc_url( get_the_author_meta( 'facebook' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="facebook-link" title="<?php esc_attr_e('Facebook', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>">
                                <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.40022 17.8824V9.8353H8.96394L9.38271 6.25882H6.40022V4.51687C6.40022 3.59592 6.42491 2.68235 7.77536 2.68235H9.14317V0.125299C9.14317 0.0868517 7.96826 0 6.77964 0C4.29728 0 2.74294 1.48173 2.74294 4.20252V6.25882H0V9.8353H2.74294V17.8824H6.40022Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( esc_url( get_the_author_meta( 'linkedin' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="linkedin-link" title="<?php esc_attr_e('LinkedIn', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63223 16V5.20429H0.20274V15.9999H3.63223V16ZM1.91784 3.73087C3.1134 3.73087 3.85814 2.90119 3.85814 1.86524C3.83553 0.806257 3.1134 0 1.94026 0C0.766937 3.27574e-05 0 0.806289 0 1.86527C0 2.90122 0.74433 3.7309 1.89527 3.7309L1.91784 3.73087ZM5.53031 16C5.53031 16 5.57531 6.21721 5.53031 5.20432H8.96033V6.76993H8.93757C9.38857 6.03322 10.2011 4.95081 12.0512 4.95081C14.3082 4.95081 16 6.49378 16 9.80981V16H12.5705V10.2246C12.5705 8.77343 12.0743 7.78318 10.8329 7.78318C9.88558 7.78318 9.32104 8.45077 9.07311 9.09609C8.98241 9.32579 8.96033 9.64842 8.96033 9.97108V16H5.53031Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( esc_url( get_the_author_meta( 'instagram' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="instagram-link" title="<?php esc_attr_e('Instagram', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'instagram' ) ); ?>">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1786 0.75H5.32143C2.7967 0.75 0.75 2.7967 0.75 5.32143V12.1786C0.75 14.7033 2.7967 16.75 5.32143 16.75H12.1786C14.7033 16.75 16.75 14.7033 16.75 12.1786V5.32143C16.75 2.7967 14.7033 0.75 12.1786 0.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.74998 12.1786C6.85638 12.1786 5.32141 10.6436 5.32141 8.74998C5.32141 6.85638 6.85638 5.32141 8.74998 5.32141C10.6436 5.32141 12.1786 6.85638 12.1786 8.74998C12.1786 9.65924 11.8173 10.5314 11.1743 11.1743C10.5314 11.8173 9.65924 12.1786 8.74998 12.1786Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.3214 3.0357C12.6903 3.0357 12.1786 3.54737 12.1786 4.17855C12.1786 4.80974 12.6903 5.32141 13.3214 5.32141C13.9526 5.32141 14.4643 4.80974 14.4643 4.17855C14.4643 3.54737 13.9526 3.0357 13.3214 3.0357Z" fill="currentColor"/>
                                <path d="M13.3214 3.60714C13.0058 3.60714 12.75 3.86298 12.75 4.17857C12.75 4.49416 13.0058 4.75 13.3214 4.75C13.637 4.75 13.8929 4.49416 13.8929 4.17857C13.8929 3.86298 13.637 3.60714 13.3214 3.60714Z" stroke="currentColor" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( esc_url( get_the_author_meta( 'youtube' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="youtube-link" title="<?php esc_attr_e('YouTube', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'youtube' ) ); ?>">
                                <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.12964 10.9556V4.54205C11.4064 5.6134 13.1698 6.64835 15.2554 7.76415C13.5352 8.7181 11.4064 9.78847 9.12964 10.9556ZM21.8183 1.35232C21.4255 0.834884 20.7562 0.432101 20.0435 0.298753C17.9489 -0.0990184 4.88112 -0.10015 2.7876 0.298753C2.21612 0.405884 1.70724 0.664836 1.27009 1.06717C-0.571843 2.77677 0.00533277 11.9448 0.449311 13.4299C0.636008 14.0727 0.87736 14.5363 1.18131 14.8406C1.57292 15.2429 2.1091 15.5199 2.72498 15.6442C4.44966 16.0009 13.3349 16.2004 20.0071 15.6977C20.6218 15.5906 21.166 15.3047 21.5951 14.8852C23.2982 13.1825 23.1821 3.49958 21.8183 1.35232Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( esc_url( get_the_author_meta( 'url' ) ) != '' )  { ?>	
                        <li>
                            <a target="_blank" class="author-link" title="<?php esc_attr_e('Website', 'q-shop'); ?>" href="<?php echo esc_url( get_the_author_meta( 'url' ) ); ?>">
                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.6353 9.63447L8.81764 2.79038L0 9.63447V6.84569L8.81764 0L17.6353 6.84409V9.63447ZM15.4309 9.38597V16H11.022V11.5912H6.61323V16H2.20441V9.38677L8.81764 4.42725L15.4309 9.38597Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    <?php } ?>
                
                </ul>

            <?php } ?>

        </div><!-- .author-info -->

        <div class="full-width-posts masonry-posts group">

            <?php

                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                else { $paged = 1; }

                $qshop_number_of_posts = esc_html( get_option('posts_per_page') );

                $author_id = get_queried_object_id();
                $temp = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query(array(
                    'author' => $author_id,
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

<?php get_footer(); ?>
