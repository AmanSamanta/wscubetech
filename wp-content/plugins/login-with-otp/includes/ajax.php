<?php

add_action('wp_ajax_lwo_signup', 'lwo_signup');
add_action('wp_ajax_nopriv_lwo_signup', 'lwo_signup');

function lwo_signup() {

    if (!debtech_verify_recaptcha($_POST['g-recaptcha-response'])) {
        wp_send_json_error('Captcha failed');
    }

    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    if (email_exists($email)) {
        wp_send_json_error('Email already exists');
    }

    wp_create_user($email, $password, $email);
    wp_send_json_success('Signup successful');
}
