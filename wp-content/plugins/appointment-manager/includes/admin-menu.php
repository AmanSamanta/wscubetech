<?php
add_action('admin_menu', function () {

    add_menu_page(
        'Services',
        'Services',
        'manage_options',
        'am-services',
        'am_services_page'
    );

    add_menu_page(
        'Portfolio',
        'Portfolio',
        'manage_options',
        'am-portfolio',
        'am_portfolio_page'
    );

    add_menu_page(
        'Appointments',
        'Appointments',
        'manage_options',
        'am-appointments',
        'am_appointment_table'
    );
});
