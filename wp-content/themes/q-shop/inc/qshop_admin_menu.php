<?php

// Q Shop Admin Menu

function qshop_theme_page() {

    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('Sorry, you are not allowed to access this page.', 'q-shop'));
    }
    
    ?>

    <div class="wrap">
        <style>

            .container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
                max-width: 1200px;
                width: 100%;
            }
            
            .card {
                background-color: #fff;
                border: 1px solid #DAE3EA;
                border-radius: 8px;
                padding: 25px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .card-title {
                margin-top: 4px;
                margin-bottom: 5px;
                font-size: 18px;
                line-height: 38px;
            }

            .card-title span {
                width: 38px;
                height: 38px;
                display: inline-block;
                font-size: 38px;
                color: #C0C5CA;
            }

            .card-description p,
            .card-description ul {
                font-size: 15px;
                color: #666;
                line-height: 23px;
                margin-bottom: 24px;
                flex-grow: 1;
            }

            .card-button {
                background-color: #fff;
                border: 1px solid #DAE3EA;
                color: #555;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                display: inline-block;
                box-shadow: 0px 2px 0px #DAE3EA;
                transition: all 0.3s;
            }

            .card-button:hover {
                color: #fff;
                background-color: #0073aa;
                border-color: #fff;
                box-shadow: none;
            }

            @media (max-width: 1024px), (max-width: 900px) {
                .container {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .container {
                    grid-template-columns: 1fr;
                }
                .card {
                    padding: 20px;
                }
            }

        </style>
        <h1 style="position: relative; display: inline-block; margin-top: 20px;">
            <?php esc_html_e('Q Shop', 'q-shop'); ?>
                <?php if ( function_exists( 'qshop_enqueue_pro_addon_styles' ) ) { ?>
                    <span style="position: absolute; top: 0; left: 94%; background:#d63638;color:#fff;padding:3px 8px;border-radius:12px; font-size: 10px; font-weight: 600; margin-left: 10px;"><?php esc_html_e('PRO', 'q-shop'); ?></span>
                <?php } else { ?>
                    <span style="position: absolute; top: 0; left: 94%; background:#3582C4;color:#fff;padding:3px 8px;border-radius:12px; font-size: 10px; font-weight: 600; margin-left: 10px;"><?php esc_html_e('FREE', 'q-shop'); ?></span>
                <?php } ?>
        </h1>

        <div class="container admin-cards">

            <?php if ( function_exists( 'qshop_enqueue_pro_addon_styles' ) ) { ?>

                <div class="card upgrade-pro" style="border-left: 4px solid #0073aa;">
                    <h3 class="card-title">
                        <span class="dashicons dashicons-awards"></span>
                        <?php esc_html_e('Q Shop Pro Active', 'q-shop'); ?>
                    </h3>

                    <div class="card-description">
                        <p><?php esc_html_e('Thank you for using Q Shop Pro! You have access to all premium features, priority support, and future updates.', 'q-shop'); ?></p>
                    </div>

                    <a href="https://landing.daison.me/qshop/" class="card-button" target="_blank">
                        <?php esc_html_e('PRO Features', 'q-shop'); ?>
                    </a>
                </div>

            <?php } else { ?>

                <div class="card upgrade-pro">
                    <h3 class="card-title">
                        <span class="dashicons dashicons-megaphone"></span>
                        <?php esc_html_e('Get Q Shop Pro Add-on', 'q-shop'); ?>
                    </h3>

                    <div class="card-description">
                        <p><?php esc_html_e('Unlock the full potential of Q Shop with the Pro Add-on. Enjoy advanced features, premium support, and more customization options.', 'q-shop'); ?></p>
                    </div>

                    <a href="https://landing.daison.me/qshop/" class="card-button" target="_blank">
                        <?php esc_html_e('Upgrade Now', 'q-shop'); ?>
                    </a>
                </div>

            <?php } ?>

            <div class="card customize">

                <h3 class="card-title">
                    <span class="dashicons dashicons-art"></span>
                    <?php esc_html_e('Customize Your Shop', 'q-shop'); ?>
                </h3>

                <div class="card-description">
                    <p><?php esc_html_e('Take your shop to the next level with the customization options. Tailor your site to match your unique style and branding.', 'q-shop'); ?></p>
                </div>

                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="card-button">
                    <?php esc_html_e('Customize Theme', 'q-shop'); ?>
                </a>

            </div>

            <div class="card documentation">

                <h3 class="card-title">
                    <span class="dashicons dashicons-download"></span>
                    <?php esc_html_e('Demo Import', 'q-shop'); ?>
                </h3>

                <div class="card-description">

                    <p><?php esc_html_e('Easily import demo content to get your site up and running quickly.', 'q-shop'); ?></p>

                    <a href="http://assets.daison.me/themereadme/qshop/" class="card-button" target="_blank">
                        <?php esc_html_e('Learn More', 'q-shop'); ?>
                    </a>

                </div>
                
            </div>

            <div class="card documentation">

                <h3 class="card-title">
                    <span class="dashicons dashicons-book-alt"></span>
                    <?php esc_html_e('Theme Documentation', 'q-shop'); ?>
                </h3>

                <div class="card-description">

                    <p><?php esc_html_e('Explore the comprehensive documentation for Q Shop to learn more about its features and customization options.', 'q-shop'); ?></p>

                    <a href="http://assets.daison.me/themereadme/qshop/" class="card-button" target="_blank">
                        <?php esc_html_e('View Documentation', 'q-shop'); ?>
                    </a>

                </div>
                
            </div>

            <div class="card feedback">

                <h3 class="card-title">
                    <span class="dashicons dashicons-smiley"></span>
                    <?php esc_html_e('Feedback', 'q-shop'); ?>
                </h3>

                <div class="card-description">

                    <p><?php esc_html_e('I value your feedback! If you have suggestions or ideas for improving Q Shop, please let me know.', 'q-shop'); ?></p>

                    <a href="https://daison.me/#contact" class="card-button" target="_blank">
                        <?php esc_html_e('Send Feedback', 'q-shop'); ?>
                    </a>

                </div>
                
            </div>

            <div class="card support">

                <h3 class="card-title">
                    <span class="dashicons dashicons-sos"></span>
                    <?php esc_html_e('Need Help?', 'q-shop'); ?>
                </h3>

                <div class="card-description">

                    <p><?php esc_html_e('If you’re experiencing issues or have questions, please check out the support resources:', 'q-shop'); ?><a href="https://daison.me/#contact" target="_blank"> <?php esc_html_e('Support Page', 'q-shop'); ?></a>, <a href="https://wordpress.org/support/theme/qshop" target="_blank"><?php esc_html_e('WordPress.org Forum', 'q-shop'); ?></a></p>

                    <a href="https://daison.me/#contact" class="card-button" target="_blank">
                        <?php esc_html_e('Contact Developer', 'q-shop'); ?>
                    </a>

                </div>
                
            </div>

        </div>

    </div>
    
<?php }

add_action('admin_menu', 'qshop_theme_menu');

function qshop_theme_menu() {
    add_theme_page(
        esc_html__('Q Shop', 'q-shop'),
        esc_html__('Q Shop', 'q-shop'),
        'manage_options',
        'qshop-theme-page',
        'qshop_theme_page'
    );
}