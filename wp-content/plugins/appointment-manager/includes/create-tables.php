<?php

function am_create_tables() {
    global $wpdb;

    $charset = $wpdb->get_charset_collate();

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // SERVICES TABLE
    $sql1 = "CREATE TABLE {$wpdb->prefix}services (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(200),
        description TEXT,
        price VARCHAR(50),
        PRIMARY KEY (id)
    ) $charset;";

    // PORTFOLIO TABLE
    $sql2 = "CREATE TABLE {$wpdb->prefix}portfolio (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(200),
        description TEXT,
        image VARCHAR(255),
        PRIMARY KEY (id)
    ) $charset;";

    // APPOINTMENT TABLE
    $sql3 = "CREATE TABLE {$wpdb->prefix}appointments (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(200),
        email VARCHAR(200),
        service_id INT,
        portfolio_id INT,
        PRIMARY KEY (id)
    ) $charset;";

    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);

}
