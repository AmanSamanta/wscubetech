<?php
/**
 * Default theme options.
 *
 * @package Mavix Blogger
 */

if ( ! function_exists( 'mavix_blogger_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function mavix_blogger_get_default_theme_options() {

	$mavix_blogger_defaults = array();

	// Contact Details
	$mavix_blogger_defaults['mavix_blogger_show_contact_details'] 		= true;
	$mavix_blogger_defaults['mavix_blogger_address_one']				= esc_html__('214 West Arnold St','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_address_two']				= esc_html__('New York, NY 10002','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_phone_number']				= esc_html__('(007) 123 456 7890','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_opening_time']				= esc_html__('Mon-Fri 10:00am-7:30pm','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_email_id']					= esc_html__('info@example.com','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_support_text']				= esc_html__('24 X 7 online support','mavix-blogger');

	// Menu
	$mavix_blogger_defaults['mavix_blogger_show_menu_button'] 			= true;
	$mavix_blogger_defaults['mavix_blogger_menu_button_text']			= esc_html__('Subscribe Now','mavix-blogger');
	$mavix_blogger_defaults['mavix_blogger_menu_button_url']			= esc_url('#','mavix-blogger');

	//General Section
	$mavix_blogger_defaults['readmore_text']					= esc_html__('Read More','mavix-blogger');
	$mavix_blogger_defaults['your_latest_posts_title']			= esc_html__('Blog','mavix-blogger');
	$mavix_blogger_defaults['excerpt_length']					= 10;
	$mavix_blogger_defaults['layout_options_blog']				= 'no-sidebar';
	$mavix_blogger_defaults['layout_options_archive']			= 'no-sidebar';
	$mavix_blogger_defaults['layout_options_page']				= 'no-sidebar';	
	$mavix_blogger_defaults['layout_options_single']			= 'right-sidebar';	

	//Footer section 		
	$mavix_blogger_defaults['copyright_text']					= esc_html__( 'Copyright &copy; All rights reserved.', 'mavix-blogger' );

	// Pass through filter.
	$mavix_blogger_defaults = apply_filters( 'mavix_blogger_filter_default_theme_options', $mavix_blogger_defaults );
	return $mavix_blogger_defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'mavix_blogger_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function mavix_blogger_get_option( $key ) {

		$mavix_blogger_default_options = mavix_blogger_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$mavix_blogger_theme_options = (array)get_theme_mod( 'theme_options' );
		$mavix_blogger_theme_options = wp_parse_args( $mavix_blogger_theme_options, $mavix_blogger_default_options );

		$value = null;

		if ( isset( $mavix_blogger_theme_options[ $key ] ) ) {
			$value = $mavix_blogger_theme_options[ $key ];
		}

		return $value;

	}

endif;