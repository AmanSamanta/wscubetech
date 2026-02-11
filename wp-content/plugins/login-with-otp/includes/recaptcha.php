<?php
function debtech_verify_recaptcha($token) {
    $secret = 'YOUR_SECRET_KEY';

    $response = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',
        [
            'body' => [
                'secret' => $secret,
                'response' => $token
            ]
        ]
    );

    $result = json_decode(wp_remote_retrieve_body($response), true);
    return isset($result['success']) && $result['success'];
}
