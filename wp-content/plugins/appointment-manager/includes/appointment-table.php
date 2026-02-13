<?php
function am_appointment_table() {
    global $wpdb;

    $appointments = $wpdb->get_results("
        SELECT a.*, s.title as service_title, p.title as portfolio_title
        FROM {$wpdb->prefix}appointments a
        LEFT JOIN {$wpdb->prefix}services s ON a.service_id = s.id
        LEFT JOIN {$wpdb->prefix}portfolio p ON a.portfolio_id = p.id
    ");

    echo "<h1>Appointments</h1>";

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Portfolio</th>
                <th>Action</th>
            </tr>";

    foreach ($appointments as $row) {
        echo "<tr>
                <td>{$row->id}</td>
                <td>{$row->name}</td>
                <td>{$row->email}</td>
                <td>{$row->service_title}</td>
                <td>{$row->portfolio_title}</td>
                <td>
                    <a href='#'>View</a>
                </td>
              </tr>";
    }

    echo "</table>";
}
