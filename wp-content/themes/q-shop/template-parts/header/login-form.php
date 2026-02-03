<?php
/**
 * WooCommerce Login Form
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}
?>

<div class="modal-login-form">

    <?php if ( ! is_user_logged_in() ) : ?>

        <?php
        
            wc_print_notices();
            
            $redirect = wc_get_page_permalink( 'myaccount' );
            if ( isset( $_GET['redirect_to'] ) ) {
                $redirect = esc_url( $_GET['redirect_to'] );
            }

        ?>

        <h4><?php esc_html_e( 'Login', 'q-shop' ); ?></h4>

        <form class="woocommerce-form woocommerce-form-login login" method="post">
            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username"><?php esc_html_e( 'Username or email address', 'q-shop' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password"><?php esc_html_e( 'Password', 'q-shop' ); ?>&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
            </p>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <p class="form-row">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span><?php esc_html_e( 'Remember me', 'q-shop' ); ?></span>
                </label>
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'q-shop' ); ?>"><?php esc_html_e( 'Log in', 'q-shop' ); ?></button>
                <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>">
            </p>

            <p class="woocommerce-LostPassword lost_password">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'q-shop' ); ?></a>
            </p>

            <?php do_action( 'woocommerce_login_form_end' ); ?>
        </form>

        <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

            <div class="woocommerce-customer-register-link">
                <p><?php esc_html_e( 'New customer?', 'q-shop' ); ?> 
                    <a href="<?php echo esc_url( add_query_arg( 'action', 'register', wc_get_page_permalink( 'myaccount' ) ) ); ?>">
                        <?php esc_html_e( 'Create an account', 'q-shop' ); ?>
                    </a>
                </p>
            </div>

        <?php endif; ?>

    <?php else : ?>

        <div class="woocommerce-MyAccount-user">

            <?php
            $current_user = wp_get_current_user();
            $name         = $current_user->display_name;
            $logout_url   = wc_logout_url( wc_get_page_permalink( 'myaccount' ) );
            $account_url  = wc_get_page_permalink( 'myaccount' );
            ?>
            <p class="welcome-user">
                <?php
                printf(
                    wp_kses( __( 'Hello %1$s', 'q-shop' ), array( 'strong' => array() ) ) . ' ', 
                    '<strong>' . esc_html( $name ) . '</strong>'
                );
                ?>
            </p>
            <p class="account-links">
                <a href="<?php echo esc_url( $account_url ); ?>" class="woocommerce-Button button">
                    <?php esc_html_e( 'My Account', 'q-shop' ); ?>
                </a>
                <a href="<?php echo esc_url( $logout_url ); ?>" class="woocommerce-Button button">
                    <?php esc_html_e( 'Logout', 'q-shop' ); ?>
                </a>
            </p>

        </div><!-- .woocommerce-MyAccount-user -->

    <?php endif; ?>

</div><!-- .modal-login-form -->