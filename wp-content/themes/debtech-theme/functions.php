<?php
function debtech_theme_assets() {
    wp_enqueue_style(
        'debtech-style',
        get_stylesheet_uri()
    );
}
add_action('wp_enqueue_scripts', 'debtech_theme_assets');

function debtech_theme_setup() {
    add_theme_support( 'menus' );
    add_theme_support( 'custom-logo' );
    register_nav_menus( array(
        'main_menu' => 'Main Menu',
    ) );
}
add_action( 'after_setup_theme', 'debtech_theme_setup' );