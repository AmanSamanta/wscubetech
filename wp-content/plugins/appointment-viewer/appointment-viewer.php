<?php
/**
 * Plugin Name: Appointment Viewer
 * Description: Admin interface to view, search, paginate, edit, and delete appointments.
 * Version: 1.0
 * Author: wscubetech
 */

// Activation / Deactivation: add/remove capability
register_activation_hook(__FILE__, 'av_activate');
register_deactivation_hook(__FILE__, 'av_deactivate');

function av_activate() {
    $roles = array('administrator', 'editor');
    foreach ($roles as $r) {
        $role = get_role($r);
        if ($role) {
            $role->add_cap('manage_appointments');
        }
    }
}

function av_deactivate() {
    $roles = array('administrator', 'editor');
    foreach ($roles as $r) {
        $role = get_role($r);
        if ($role) {
            $role->remove_cap('manage_appointments');
        }
    }
}

add_action('admin_menu', 'av_add_admin_menu');

function av_add_admin_menu() {
    add_menu_page(
        'Appointments',          // Page title
        'Appointments',          // Menu title
        'manage_options',        // Capability
        'appointment-viewer',    // Slug
        'av_show_appointments',  // Callback
        'dashicons-calendar-alt',// Icon
        25
    );
}

add_action('admin_init', 'av_update_appointment_status');

function av_update_appointment_status() {
    if (isset($_POST['appointment_id'], $_POST['appointment_status'])) {
        global $wpdb;
        $table = $wpdb->prefix . 'appointment';

        $wpdb->update(
            $table,
            ['status' => sanitize_text_field($_POST['appointment_status'])],
            ['id' => intval($_POST['appointment_id'])]
        );
    }
}

// Fetch & Display Table Data with search, pagination and actions
function av_show_appointments() {
    if (!current_user_can('manage_appointments')) {
        wp_die('You do not have permission to view this page.');
    }

    global $wpdb;
    $table = $wpdb->prefix . 'appointment';

    // Handle actions: delete, view, edit
    $action = isset($_REQUEST['action']) ? sanitize_text_field($_REQUEST['action']) : '';
    $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

    if ($action === 'delete' && $id) {
        check_admin_referer('av_delete_' . $id);
        if (current_user_can('manage_appointments')) {
            $deleted = $wpdb->delete($table, array('id' => $id), array('%d'));
            if ($deleted !== false) {
                echo '<div class="updated"><p>Appointment deleted.</p></div>';
            } else {
                echo '<div class="error"><p>Could not delete appointment.</p></div>';
            }
        }
    }

    // Update (edit) handler
    if ($action === 'update' && $id && isset($_POST['av_update'])) {
        check_admin_referer('av_edit_' . $id);
        if (current_user_can('manage_appointments')) {
            $data = array(
                'patient_name' => sanitize_text_field($_POST['patient_name']),
                'specialist_check' => sanitize_text_field($_POST['specialist_check']),
                'appointment_datetime' => sanitize_text_field($_POST['appointment_datetime']),
                'location' => sanitize_text_field($_POST['location']),
                'phone_number' => sanitize_text_field($_POST['phone_number']),
            );
            $formats = array('%s','%s','%s','%s','%s');
            $updated = $wpdb->update($table, $data, array('id' => $id), $formats, array('%d'));
            if ($updated !== false) {
                echo '<div class="updated"><p>Appointment updated.</p></div>';
            } else {
                echo '<div class="error"><p>Could not update appointment.</p></div>';
            }
        }
    }

    // If viewing single record
    if ($action === 'view' && $id) {
        $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id));
        if ($row) {
            ?>
            <div class="wrap">
                <h1>View Appointment #<?php echo esc_html($row->id); ?></h1>
                <table class="widefat fixed striped">
                    <tbody>
                        <tr><th>ID</th><td><?php echo esc_html($row->id); ?></td></tr>
                        <tr><th>Patient Name</th><td><?php echo esc_html($row->patient_name); ?></td></tr>
                        <tr><th>Specialist</th><td><?php echo esc_html($row->specialist_check); ?></td></tr>
                        <tr><th>Date & Time</th><td><?php echo esc_html($row->appointment_datetime); ?></td></tr>
                        <tr><th>Location</th><td><?php echo esc_html($row->location); ?></td></tr>
                        <tr><th>Phone</th><td><?php echo esc_html($row->phone_number); ?></td></tr>
                    </tbody>
                </table>
                <p><a href="<?php echo esc_url(admin_url('admin.php?page=appointment-viewer')); ?>" class="button">Back to list</a></p>
            </div>
            <?php
            return;
        }
    }

    // Search and pagination parameters
    $s = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';
    $per_page = 10;
    $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($paged - 1) * $per_page;

    // Build where clause
    $where_sql = '';
    $params = array();
    if ($s !== '') {
        $like = '%' . $wpdb->esc_like($s) . '%';
        $where_sql = " WHERE patient_name LIKE %s OR specialist_check LIKE %s OR phone_number LIKE %s";
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
    }

    // Get total
    if ($where_sql) {
        $count_sql = "SELECT COUNT(*) FROM $table" . $where_sql;
        $total = $wpdb->get_var($wpdb->prepare($count_sql, $params));
    } else {
        $total = $wpdb->get_var("SELECT COUNT(*) FROM $table");
    }

    // Get results
    $sql = "SELECT * FROM $table" . $where_sql . " ORDER BY id DESC LIMIT %d OFFSET %d";
    $query_args = $params;
    $query_args[] = $per_page;
    $query_args[] = $offset;
    $prepared = $wpdb->prepare($sql, $query_args);
    // Raw query line requested (kept commented for safety):
    // $results = $wpdb->get_results("SELECT * FROM $table");
    if ($prepared !== false) {
        $results = $wpdb->get_results($prepared);
    } else {
        // Prepare failed - use empty results and log a message to avoid runtime errors
        $results = array();
        error_log('[appointment-viewer] Failed to prepare SQL for appointments list.');
    }

    $base_url = admin_url('admin.php?page=appointment-viewer');
    if ($s !== '') {
        $base_url = add_query_arg('s', urlencode($s), $base_url);
    }

    ?>

    <div class="wrap">
        <h1>Appointment List</h1>

        <form method="get" action="<?php echo esc_url(admin_url('admin.php')); ?>">
            <input type="hidden" name="page" value="appointment-viewer" />
            <p class="search-box">
                <label class="screen-reader-text" for="appointment-search-input">Search Appointments:</label>
                <input type="search" id="appointment-search-input" name="s" value="<?php echo esc_attr($s); ?>">
                <input type="submit" class="button" value="Search">
            </p>
        </form>

        <table class="widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Specialist</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Actions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php if ($results) : ?>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php echo esc_html($row->id); ?></td>
                        <td><?php echo esc_html($row->patient_name); ?></td>
                        <td><?php echo esc_html($row->specialist_check); ?></td>
                        <td><?php echo esc_html($row->appointment_datetime); ?></td>
                        <td><?php echo esc_html($row->location); ?></td>
                        <td><?php echo esc_html($row->phone_number); ?></td>

                        <td>
                            <div id="av-view-<?php echo esc_attr($row->id); ?>" class="av-hidden-view" style="display:none;">
                                <h2>Appointment #<?php echo esc_html($row->id); ?></h2>
                                <table class="widefat fixed striped">
                                    <tbody>
                                        <tr><th>ID</th><td><?php echo esc_html($row->id); ?></td></tr>
                                        <tr><th>Patient Name</th><td><?php echo esc_html($row->patient_name); ?></td></tr>
                                        <tr><th>Specialist</th><td><?php echo esc_html($row->specialist_check); ?></td></tr>
                                        <tr><th>Date &amp; Time</th><td><?php echo esc_html($row->appointment_datetime); ?></td></tr>
                                        <tr><th>Location</th><td><?php echo esc_html($row->location); ?></td></tr>
                                        <tr><th>Phone</th><td><?php echo esc_html($row->phone_number); ?></td></tr>
                                        <tr><th>Status</th><td><?php echo esc_html(ucfirst($row->status)); ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="button av-view-button" data-id="<?php echo esc_attr($row->id); ?>">View</button>
                        </td>
                        <td>
                            <span style="
                            color: <?php 
                            echo ($row->status == 'approved') ? 'green' : 
                                 (($row->status == 'cancelled') ? 'red' : 'orange'); 
                            ?>">
                                <?php echo esc_html(ucfirst($row->status)); ?>
                            </span>
                        </td>
                         <td>
                            <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                                <?php wp_nonce_field( 'av_status_' . $row->id ); ?>
                                <input type="hidden" name="action" value="av_update_status">
                                <input type="hidden" name="appointment_id" value="<?php echo esc_attr($row->id); ?>">
                                <select name="appointment_status" onchange="this.form.submit()">
                                    <option value="pending" <?php selected( $row->status, 'pending' ); ?>>Pending</option>
                                    <option value="approved" <?php selected( $row->status, 'approved' ); ?>>Approved</option>
                                    <option value="cancelled" <?php selected( $row->status, 'cancelled' ); ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>


                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="9">No appointments found</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

        <div id="av-modal-overlay" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
            <div id="av-modal" style="background:#fff; padding:20px; max-width:800px; width:90%; margin:0 auto; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.3); position:relative;">
                <button type="button" id="av-modal-close" class="button" style="position:absolute; top:10px; right:10px;">Close</button>
                <div id="av-modal-content"></div>
            </div>
        </div>

        <script>
        (function(){
            document.addEventListener('DOMContentLoaded', function(){
                var buttons = document.querySelectorAll('.av-view-button');
                var overlay = document.getElementById('av-modal-overlay');
                var content = document.getElementById('av-modal-content');
                var close = document.getElementById('av-modal-close');

                buttons.forEach(function(btn){
                    btn.addEventListener('click', function(e){
                        var id = this.getAttribute('data-id');
                        var hidden = document.getElementById('av-view-' + id);
                        if(hidden){
                            content.innerHTML = hidden.innerHTML;
                            overlay.style.display = 'flex';
                        }
                    });
                });

                if (close) {
                    close.addEventListener('click', function(){
                        overlay.style.display = 'none';
                        content.innerHTML = '';
                    });
                }

                overlay.addEventListener('click', function(e){
                    if(e.target === overlay){
                        overlay.style.display = 'none';
                        content.innerHTML = '';
                    }
                });
            });
        })();
        </script>

        <?php
        // Pagination
        $total_pages = ceil($total / $per_page);
        if ($total_pages > 1) {
            $pagination_args = array(
                'base' => add_query_arg('paged','%#%', $base_url),
                'format' => '&paged=%#%',
                'current' => $paged,
                'total' => $total_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;'
            );
            echo '<div class="tablenav"><div class="tablenav-pages">' . paginate_links($pagination_args) . '</div></div>';
        }
        ?>

    </div>

    <?php
}