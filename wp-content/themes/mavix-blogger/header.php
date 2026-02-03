<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mavix Blogger
 */
/**
* Hook - mavix_blogger_action_doctype.
*
* @hooked mavix_blogger_doctype -  10
*/
do_action( 'mavix_blogger_action_doctype' );
?>
<head>
<?php
/**
* Hook - mavix_blogger_action_head.
*
* @hooked mavix_blogger_head -  10
*/
do_action( 'mavix_blogger_action_head' );
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<?php

/**
* Hook - mavix_blogger_action_before.
*
* @hooked mavix_blogger_page_start - 10
*/
do_action( 'mavix_blogger_action_before' );

/**
*
* @hooked mavix_blogger_header_start - 10
*/
do_action( 'mavix_blogger_action_before_header' );

/**
*
*@hooked mavix_blogger_site_branding - 10
*@hooked mavix_blogger_header_end - 15 
*/
do_action('mavix_blogger_action_header');

/**
*
* @hooked mavix_blogger_content_start - 10
*/
do_action( 'mavix_blogger_action_before_content' );

/**
 * Banner start
 * 
 * @hooked mavix_blogger_banner_header - 10
*/
do_action( 'mavix_blogger_banner_header' );  
