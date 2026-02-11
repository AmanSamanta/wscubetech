<?php
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<header>
    <div class="site-branding">
       
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/01/aman4.jpg' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
            </a>
            <?php
        
        ?>
    </div>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'main_menu',
        'container'      => 'nav',
        'container_class'=> 'main-navigation',
    ) );
    ?>
</header>
