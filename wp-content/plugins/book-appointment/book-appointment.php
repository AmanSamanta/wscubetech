<?php
/**
 * Plugin Name: Book Appointment
 * Description: Simple front-end appointment booking form with DB table creation.
 * Version: 1.0.0
 * Author: Auto-generated
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Activation hook: create DB table
register_activation_hook( __FILE__, 'ba_create_appointment_table' );
function ba_create_appointment_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'appointment';
    $charset_collate = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        patient_name varchar(255) NOT NULL,
        specialist_check varchar(255) NOT NULL,
        appointment_datetime datetime NOT NULL,
        location varchar(255) NOT NULL,
        phone_number varchar(50) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    dbDelta( $sql );
}

// Enqueue assets
add_action( 'wp_enqueue_scripts', 'ba_enqueue_assets' );
function ba_enqueue_assets() {
    wp_register_style( 'ba-style', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'ba-style' );
}

// Shortcode to display the form
add_shortcode( 'book_appointment_form', 'ba_render_form_shortcode' );
function ba_render_form_shortcode() {
    ob_start();

    // Handle submission
    if ( isset( $_POST['ba_submit'] ) ) {
        if ( ! isset( $_POST['ba_nonce'] ) || ! wp_verify_nonce( $_POST['ba_nonce'], 'ba_nonce_action' ) ) {
            echo '<div class="ba-message error">Security check failed.</div>';
        } else {
            global $wpdb;
            $table_name = $wpdb->prefix . 'appointment';

            $patient_name = sanitize_text_field( wp_unslash( $_POST['patient_name'] ?? '' ) );
            $specialist_check = sanitize_text_field( wp_unslash( $_POST['specialist_check'] ?? '' ) );
            $appointment_datetime_raw = sanitize_text_field( wp_unslash( $_POST['appointment_datetime'] ?? '' ) );
            $location = sanitize_text_field( wp_unslash( $_POST['location'] ?? '' ) );
            $phone_number = sanitize_text_field( wp_unslash( $_POST['phone_number'] ?? '' ) );

            $appointment_datetime = null;
            if ( ! empty( $appointment_datetime_raw ) ) {
                $ts = strtotime( str_replace( 'T', ' ', $appointment_datetime_raw ) );
                if ( $ts ) {
                    $appointment_datetime = date( 'Y-m-d H:i:s', $ts );
                }
            }

            if ( empty( $patient_name ) || empty( $specialist_check ) || empty( $appointment_datetime ) ) {
                echo '<div class="ba-message error">Please fill required fields.</div>';
            } else {
                $inserted = $wpdb->insert(
                    $table_name,
                    array(
                        'patient_name' => $patient_name,
                        'specialist_check' => $specialist_check,
                        'appointment_datetime' => $appointment_datetime,
                        'location' => $location,
                        'phone_number' => $phone_number,
                    ),
                    array('%s','%s','%s','%s','%s')
                );

                if ( $inserted ) {
                    echo '<div class="ba-message success">Appointment booked successfully.</div>';
                } else {
                    echo '<div class="ba-message error">Failed to book appointment. Try again.</div>';
                }
            }
        }
    }

    // Form + hero HTML
    ?>
    <div class="ba-appointment-page">

        <section class="ba-hero" role="banner" aria-label="Appointment banner">
            <div class="ba-hero-overlay"></div>
            <div class="ba-hero-inner">
                <div class="ba-hero-text">
                    <h1>Book Appointment</h1>
                    <p>Schedule a visit with our experienced specialists — quick and easy.</p>
                </div>
                <div class="ba-hero-image" aria-hidden="true"></div>
            </div>
        </section>

        <div class="ba-form-card">
            <form method="post" class="ba-form">
                <?php wp_nonce_field( 'ba_nonce_action', 'ba_nonce' ); ?>

                <p>
                    <label>Patient Name (required)
                        <input type="text" name="patient_name" required>
                    </label>
                </p>

                <p>
                    <label>Specialist Check (required)
                        <select name="specialist_check" required>
                            <option value="">-- Select a Specialist --</option>
                            <option value="Cardiologists (heart)">Cardiologists (heart)</option>
                            <option value="Dermatologists (skin)">Dermatologists (skin)</option>
                            <option value="Neurologists (brain)">Neurologists (brain)</option>
                            <option value="Oncologists (cancer)">Oncologists (cancer)</option>
                            <option value="Pediatricians (children)">Pediatricians (children)</option>
                            <option value="Orthopedic surgeons (bones)">Orthopedic surgeons (bones)</option>
                        </select>
                    </label>
                </p>

                <p>
                    <label>Date &amp; Time (required)
                        <input type="datetime-local" name="appointment_datetime" required>
                    </label>
                </p>

                                    <label>Phone Number (10 digits only)
                                        <input type="tel" name="phone_number" maxlength="10" pattern="[0-9]{10}" placeholder="1234567890" style="border: 2px solid #ddd; transition: border-color 0.3s;" oninput="this.style.borderColor = this.value.length > 10 ? '#e74c3c' : (this.value.length === 10 && /^[0-9]{10}$/.test(this.value) ? '#27ae60' : '#ddd');">
                        <input type="text" name="location">
                    </label>
                </p>

                <p>
                    <label>Phone Number
                        <input type="tel" name="phone_number">
                    </label>
                </p>

                <p>
                    <input type="submit" name="ba_submit" value="Book Appointment">
                </p>
            </form>
        </div>

    </div>
    <?php

    return ob_get_clean();
}

// Short helper to show raw DB table name
function ba_get_table_name() {
    global $wpdb;
    return $wpdb->prefix . 'appointment';
}
