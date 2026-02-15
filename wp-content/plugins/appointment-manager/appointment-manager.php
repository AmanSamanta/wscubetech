<?php
/*
Plugin Name: Appointment Manager
Description: Manage Services, Portfolio & Appointments
Version: 1.0
*/
add_shortcode('am_services', function () {
    global $wpdb;

    $services = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}services");

    ob_start();

    echo "<h2>Our Services</h2>";

    if ($services) {
        foreach ($services as $service) {
            echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ddd;'>
                    <h3>{$service->title}</h3>
                    <p>{$service->description}</p>
                  </div>";
        }
    } else {
        echo "No services found.";
    }

    return ob_get_clean();
});

add_shortcode('am_portfolio', function () {
    global $wpdb;

    $items = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}portfolio");

    ob_start();

    echo "<h2>Our Portfolio</h2>";

    if ($items) {
        foreach ($items as $item) {
            echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ddd;'>
                    <h3>{$item->title}</h3>
                    <p>{$item->description}</p>
                    <img src='{$item->image}' width='100'>
                  </div>";
        }
    } else {
        echo "No portfolio items found.";
    }

    return ob_get_clean();
});

register_activation_hook(__FILE__, 'am_create_tables');

if (!defined('ABSPATH')) exit;

define('AM_PATH', plugin_dir_path(__FILE__));


require_once AM_PATH . 'includes/create-tables.php';
require_once AM_PATH . 'includes/admin-menu.php';
require_once AM_PATH . 'includes/services-page.php';
require_once AM_PATH . 'includes/portfolio-page.php';
require_once AM_PATH . 'includes/appointment-table.php';
