<?php
function lwo_generate_otp() {
    return rand(1000, 9999);
}

function lwo_send_otp($email) {
    $otp = lwo_generate_otp();

    update_user_meta(
        get_user_by('email', $email)->ID,
        'login_otp',
        $otp
    );

    update_user_meta(
        get_user_by('email', $email)->ID,
        'otp_expiry',
        time() + 300
    );

    wp_mail($email, 'Your OTP', "Your OTP is: $otp");
}
