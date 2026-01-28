<?php
/**
 * Plugin Name: My First Plugin
 * Description: A simple beginner-friendly WordPress plugin that demonstrates plugin development
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: my-first-plugin
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'MY_FIRST_PLUGIN_VERSION', '1.0.0' );
define( 'MY_FIRST_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MY_FIRST_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Create custom database table
 */
function my_first_plugin_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'myplugin_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

/**
 * Insert data into custom table
 */
function my_first_plugin_insert_data( $name, $email ) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'myplugin_data';

    $wpdb->insert(
        $table_name,
        array(
            'name'  => sanitize_text_field( $name ),
            'email' => sanitize_email( $email )
        ),
        array(
            '%s',
            '%s'
        )
    );

    return $wpdb->insert_id;
}

/**
 * Activation hook
 */
function my_first_plugin_activate() {
    // Create database table on activation
    my_first_plugin_create_table();
    error_log( 'My First Plugin activated' );
}
register_activation_hook( __FILE__, 'my_first_plugin_activate' );

/**
 * Deactivation hook
 */
function my_first_plugin_deactivate() {
    // Code to run on plugin deactivation
    error_log( 'My First Plugin deactivated' );
}
register_deactivation_hook( __FILE__, 'my_first_plugin_deactivate' );

/**
 * Load frontend styles
 */
function my_first_plugin_enqueue_styles() {
    wp_enqueue_style(
        'my-first-plugin-style',
        MY_FIRST_PLUGIN_URL . 'assets/style.css',
        array(),
        MY_FIRST_PLUGIN_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'my_first_plugin_enqueue_styles' );

/**
 * Process form submission
 */
function my_first_plugin_process_form() {
    // Check if form is submitted
    if ( isset( $_POST['my_submit'] ) ) {
        // Verify nonce
        if ( ! isset( $_POST['my_plugin_nonce'] ) || ! wp_verify_nonce( $_POST['my_plugin_nonce'], 'my_plugin_form_nonce' ) ) {
            wp_die( esc_html__( 'Security check failed', 'my-first-plugin' ) );
        }

        // Get and sanitize form data
        $name  = isset( $_POST['my_name'] ) ? sanitize_text_field( $_POST['my_name'] ) : '';
        $email = isset( $_POST['my_email'] ) ? sanitize_email( $_POST['my_email'] ) : '';

        // Validate inputs
        if ( empty( $name ) || empty( $email ) ) {
            set_transient( 'my_plugin_error', esc_html__( 'Please fill in all fields', 'my-first-plugin' ), 30 );
        } elseif ( ! is_email( $email ) ) {
            set_transient( 'my_plugin_error', esc_html__( 'Please enter a valid email', 'my-first-plugin' ), 30 );
        } else {
            // Insert data
            my_first_plugin_insert_data( $name, $email );
            set_transient( 'my_plugin_success', esc_html__( 'Data saved successfully!', 'my-first-plugin' ), 30 );
        }
    }
}
add_action( 'wp_loaded', 'my_first_plugin_process_form' );

/**
 * Display form shortcode with modern styling
 */
function my_first_plugin_form_shortcode() {
    ob_start();
    
    $error   = get_transient( 'my_plugin_error' );
    $success = get_transient( 'my_plugin_success' );
    
    if ( $error ) {
        delete_transient( 'my_plugin_error' );
        echo '<div class="myplugin-alert myplugin-alert-error">' . wp_kses_post( $error ) . '</div>';
    }
    
    if ( $success ) {
        delete_transient( 'my_plugin_success' );
        echo '<div class="myplugin-alert myplugin-alert-success">' . wp_kses_post( $success ) . '</div>';
    }
    ?>
    
    <div class="myplugin-form-container">
        <div class="myplugin-form-wrapper">
            <h2 class="myplugin-form-title"><?php esc_html_e( 'Submit Your Information', 'Contact' ); ?></h2>
            
            <form method="post" class="myplugin-form">
                <?php wp_nonce_field( 'my_plugin_form_nonce', 'my_plugin_nonce' ); ?>
                
                <div class="myplugin-form-group">
                    <label for="my_name" class="myplugin-label">
                        <?php esc_html_e( 'Full Name', 'my-first-plugin' ); ?>
                        <span class="myplugin-required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="my_name"
                        name="my_name" 
                        class="myplugin-input" 
                        placeholder="<?php esc_attr_e( 'Enter your full name', 'my-first-plugin' ); ?>" 
                        required
                    >
                </div>

                <div class="myplugin-form-group">
                    <label for="my_email" class="myplugin-label">
                        <?php esc_html_e( 'Email Address', 'my-first-plugin' ); ?>
                        <span class="myplugin-required">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="my_email"
                        name="my_email" 
                        class="myplugin-input" 
                        placeholder="<?php esc_attr_e( 'Enter your email address', 'my-first-plugin' ); ?>" 
                        required
                    >
                </div>

                <div class="myplugin-form-group">
                    <button type="submit" name="my_submit" class="myplugin-submit-btn">
                        <?php esc_html_e( 'Save Data', 'my-first-plugin' ); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode( 'myplugin_form', 'my_first_plugin_form_shortcode' );

/**
 * Main plugin function
 */
function my_first_plugin_init() {
    // Load plugin text domain for translations
    load_plugin_textdomain( 'my-first-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    
    // Your plugin code here
    error_log( 'My First Plugin initialized' );
}
add_action( 'plugins_loaded', 'my_first_plugin_init' );

/**
 * Add admin notice
 */
function my_first_plugin_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e( 'My First Plugin is now active!', 'my-first-plugin' ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'my_first_plugin_admin_notice' );
