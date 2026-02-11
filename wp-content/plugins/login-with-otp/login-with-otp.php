<?php
/*
Plugin Name: Login With OTP
Description: Signup & Login with Email OTP + reCAPTCHA
Version: 1.0
*/

if (!defined('ABSPATH')) exit;

// CONSTANTS
define('LWO_PATH', plugin_dir_path(__FILE__));
define('LWO_URL', plugin_dir_url(__FILE__));

// INCLUDE FILES
require_once LWO_PATH . 'includes/recaptcha.php';
require_once LWO_PATH . 'includes/otp.php';
require_once LWO_PATH . 'includes/auth.php';
require_once LWO_PATH . 'includes/ajax.php';

add_action('wp_head', function () {
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
});

// ASSETS
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('lwo-style', LWO_URL . 'assets/css/style.css');
    wp_enqueue_script('lwo-js', LWO_URL . 'assets/js/auth.js', ['jquery'], null, true);

    wp_localize_script('lwo-js', 'lwo_ajax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
});

// SHORTCODES
add_shortcode('lwo_signup', function () {
    ob_start();
    include LWO_PATH . 'templates/signup-form.php';
    return ob_get_clean();
});

add_shortcode('lwo_login', function () {
    ob_start();
    include LWO_PATH . 'templates/login-form.php';
    return ob_get_clean();
});


