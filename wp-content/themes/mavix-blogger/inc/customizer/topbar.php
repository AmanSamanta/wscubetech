<?php

$mavix_blogger_default = mavix_blogger_get_default_theme_options();
/**
* Header Top Panel
*/
$wp_customize->add_panel( 'mavix_blogger_header_top_panel', array(
    'title'          => __( 'Header Options', 'mavix-blogger' ),
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
) );

// Contact Details Section
$wp_customize->add_section(
    'mavix_blogger_contact_details_section',
    array(
        'title'    => __( 'Contact Details', 'mavix-blogger' ),
        'panel'    => 'mavix_blogger_header_top_panel',
    )
);

// Show Contact Details
$wp_customize->add_setting( 
    'theme_options[mavix_blogger_show_contact_details]', 
    array(
        'default'           => $mavix_blogger_default['mavix_blogger_show_contact_details'],
        'sanitize_callback' => 'mavix_blogger_sanitize_checkbox',
    ) 
);

$wp_customize->add_control(
    'theme_options[mavix_blogger_show_contact_details]',
    array(
        'label'       => __( 'Show Contact Details', 'mavix-blogger' ),
        'section'     => 'mavix_blogger_contact_details_section',
        'type'        => 'checkbox',
    )
);

// Address 1
$wp_customize->add_setting( 'theme_options[mavix_blogger_address_one]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_address_one'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_address_one]',
    array(
    'label'    => __( 'Address 1', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Address 2
$wp_customize->add_setting( 'theme_options[mavix_blogger_address_two]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_address_two'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_address_two]',
    array(
    'label'    => __( 'Address 2', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Phone Number
$wp_customize->add_setting( 'theme_options[mavix_blogger_phone_number]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_phone_number'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_phone_number]',
    array(
    'label'    => __( 'Phone Number', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Opening Time
$wp_customize->add_setting( 'theme_options[mavix_blogger_opening_time]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_opening_time'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_opening_time]',
    array(
    'label'    => __( 'Opening Time', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Email ID
$wp_customize->add_setting( 'theme_options[mavix_blogger_email_id]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_email_id'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_email_id]',
    array(
    'label'    => __( 'Email ID', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Support Text
$wp_customize->add_setting( 'theme_options[mavix_blogger_support_text]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_support_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_support_text]',
    array(
    'label'    => __( 'Support Text', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_contact_details_section',
    'type'     => 'text',
    )
);

// Menu Button Section
$wp_customize->add_section(
    'mavix_blogger_menu_button_section',
    array(
        'title'    => __( 'Get Started Button', 'mavix-blogger' ),
        'panel'    => 'mavix_blogger_header_top_panel',
    )
);

// Show Menu Button
$wp_customize->add_setting( 
    'theme_options[mavix_blogger_show_menu_button]', 
    array(
        'default'           => $mavix_blogger_default['mavix_blogger_show_menu_button'],
        'sanitize_callback' => 'mavix_blogger_sanitize_checkbox',
    ) 
);

$wp_customize->add_control(
    'theme_options[mavix_blogger_show_menu_button]',
    array(
        'label'       => __( 'Show Menu Button', 'mavix-blogger' ),
        'section'     => 'mavix_blogger_menu_button_section',
        'type'        => 'checkbox',
    )
);

// Button Text
$wp_customize->add_setting( 'theme_options[mavix_blogger_menu_button_text]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_menu_button_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_menu_button_text]',
    array(
    'label'    => __( 'Button Text', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_menu_button_section',
    'type'     => 'text',
    )
);

// Button Url
$wp_customize->add_setting( 'theme_options[mavix_blogger_menu_button_url]',
    array(
    'default'           => $mavix_blogger_default['mavix_blogger_menu_button_url'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'refresh',
    )
);

$wp_customize->add_control( 'theme_options[mavix_blogger_menu_button_url]',
    array(
    'label'    => __( 'Button Url', 'mavix-blogger' ),
    'section'  => 'mavix_blogger_menu_button_section',
    'type'     => 'url',
    )
);