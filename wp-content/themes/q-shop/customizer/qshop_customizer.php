<?php

	add_action( 'customize_register', 'qshop_customizer_settings' );
	

	function qshop_customizer_settings( $wp_customize ) {

		/*************** Hero Logo Upload ***************/
		
		$wp_customize->add_setting( 'qshop_hero_logo', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'   => 'refresh'
		) );

		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'qshop_hero_logo', array(
				'label' =>  esc_html__( 'Hero Section Logo', 'q-shop' ),
				'description' => esc_html__( 'Upload a lighter colored logo to use in the hero section.', 'q-shop' ),
				'section' => 'title_tagline',
				'settings' => 'qshop_hero_logo'
			)
		) );

		/*************** Upsell Section ***************/
		
		$qshop_upsell_url = wp_get_theme()->get('ThemeURI');

		add_action('customize_controls_enqueue_scripts', function() use ($qshop_upsell_url) {
		    wp_localize_script('customize-controls', 'qshopCustomizer', array(
		        'upsellUrl' => esc_url($qshop_upsell_url)
		    ));
		});

		// Check if pro addon is active
		$qshop_is_pro_active = (in_array('qshop-pro-addon/qshop-pro-addon.php', apply_filters('active_plugins', get_option('active_plugins')))) || (is_plugin_active_for_network('qshop-pro-addon/qshop-pro-addon.php'));
		$section_title = $qshop_is_pro_active ? esc_html__( 'PRO Active', 'q-shop' ) : esc_html__( 'PRO Features', 'q-shop' );

		$wp_customize->add_section( 'qshop_upsell_section' , array(
		    'title'      => $section_title,
		    'priority'   => 1
		) );

		$wp_customize->add_setting( 'qshop_pro_features' , array(
		    'default'     => '',
		    'capability'  => 'edit_theme_options',
			'sanitize_callback' => 'qshop_select_sanitize',
		    'transport'   => 'refresh'
		) );

		$qshop_pro_description = $qshop_is_pro_active 
			? esc_html__( 'Thank you for using Qshop Pro! Enjoy all the premium features and customization options.', 'q-shop' ) 
			: esc_html__( 'Premium support and many more features!', 'q-shop' );
		
		$pro_btn_text = esc_html__( 'Checkout All Pro Features →', 'q-shop' );

		$qshop_pro_list_items = '';
		$qshop_features = array(
			esc_html__( 'Multiple Hero Designs', 'q-shop' ),
			esc_html__( 'Typography (Google Fonts)', 'q-shop' ),
			esc_html__( 'Sticky Header', 'q-shop' ),
			esc_html__( 'Featured Products', 'q-shop' ),
			esc_html__( 'Reviews Section', 'q-shop' ),
			esc_html__( 'Newsletter Section', 'q-shop' ),
			esc_html__( 'Custom Widgets', 'q-shop' ),
			esc_html__( 'Categories Section', 'q-shop' ),
			esc_html__( 'FAQs Section', 'q-shop' ),
			esc_html__( 'Gallery / Instagram Section', 'q-shop' ),
			esc_html__( 'Payment Methods Icons', 'q-shop' ),
		);

		foreach ($qshop_features as $feature) {
			$qshop_pro_list_items .= '<li><span class="qshop-pro-label">' . esc_html__('Pro', 'q-shop') . '</span>' . $feature . '</li>';
		}

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'qshop_pro_features', array(
			'label'      => esc_html__( 'Q Shop Pro Add-on', 'q-shop' ),
			'description' => sprintf(
				'<div class="qshop-pro-features">
					
					<a href="%s" target="_blank">
						<img src="%s" alt="Q Shop Pro Image" style="display: block; margin: 12px 0;" />
					</a>
					<div class="qshop-pro-features-content">
						<ul class="qshop-pro-features-list">
							%s
						</ul>
						<p class="qshop-pro-features-p">%s</p>
						<a href="%s" class="button button-primary qshop-pro-button" target="_blank">%s</a>
					</div>
					
				</div>',
				esc_url($qshop_upsell_url),
				esc_url(get_template_directory_uri() . '/images/pro-banner.gif'),
				$qshop_pro_list_items,
				$qshop_pro_description,
				esc_url($qshop_upsell_url),
				$pro_btn_text
			),
			'section'    => 'qshop_upsell_section',
			'type'       => 'hidden'
		) ) );

	/*************** Header Panel ***************/

		$wp_customize->add_section( 'qshop_header_section' , array(
		    'title'      => esc_html__( 'Header', 'q-shop' ),
		    'priority'   => 100
		) );

		// Announcement Bar Text

		$wp_customize->add_setting( 'qshop_announcement_bar_text', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'qshop_announcement_bar_sanitize',
            'transport'         => 'refresh',
        ) );

		$wp_customize->add_control( 'qshop_announcement_bar_text', array(
		    'label'       => esc_html__( 'Announcement Bar Text', 'q-shop' ),
		    'description' => esc_html__( 'Enter the text to display in the announcement bar (Leave empty to hide the announcement bar).', 'q-shop' ),
		    'section'     => 'qshop_header_section',
		    'type'        => 'textarea',
		    'priority'    => 5,
		) );

		// Header Search Form

		$wp_customize->add_setting( 'qshop_header_search' , array(
		    'default'     => 'off',
		    'capability'  => 'edit_theme_options',
			'sanitize_callback' => 'qshop_select_sanitize',
		    'transport'   => 'refresh'
		) );

		$wp_customize->add_control( 'qshop_header_search', array(
		    'label'      => esc_html__( 'Header Search Form', 'q-shop' ),
		    'description' => esc_html__( 'Show or hide the header search form.', 'q-shop' ),
		    'section'    => 'qshop_header_section',
		    'type'       => 'radio',
		    'choices'    => array(
		        'on' => esc_html__( 'Show', 'q-shop' ),
		        'off' => esc_html__( 'Hide', 'q-shop' )
		    )
		) );

		$wp_customize->get_setting( 'qshop_header_search' )->transport = 'postMessage';
 
		$wp_customize->selective_refresh->add_partial( 'qshop_header_search', array(
			'selector' => '#header-elements'
		) );

	/*************** Basics Panel ***************/

		$wp_customize->add_panel( 'qshop_basics_panel', array(
	        'priority'       => 102,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Basics', 'q-shop' ),
	    ) );

		/*** Design ***/

		$wp_customize->add_section( 'qshop_design_section' , array(
		    'title'      => esc_html__( 'Design', 'q-shop' ),
		    'panel'     => 'qshop_basics_panel',
		    'priority'   => 1
		) );

		$wp_customize->add_setting( 'qshop_single_design' , array(
		    'default'     => 'single_one',
		    'capability'  => 'edit_theme_options',
		    'sanitize_callback' => 'qshop_select_sanitize',
		    'transport'   => 'refresh'
		) );

		$wp_customize->add_control( 'qshop_single_design', array(
		    'label'      => esc_html__( 'Post Page', 'q-shop' ),
		    'description' => esc_html__( 'Select a design layout for the post page.', 'q-shop' ),
		    'section'    => 'qshop_design_section',
		    'type'       => 'radio',
		    'choices'    => array(
		        'single_one' => esc_html__( 'Design Layout One', 'q-shop' ),
		    	'single_two' => esc_html__( 'Design Layout Two', 'q-shop' )
		    )

		) );

		/*** Color Picker ***/

		$wp_customize->add_setting('qshop_accent_color', array(
			'default'           => '#818983',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type' => 'theme_mod'
	
		));
	
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'qshop_accent_color', array(
			'label'    => esc_html__( 'Accent Color', 'q-shop' ),
			'description' => esc_html__( 'Select an accent color used by buttons and icons.', 'q-shop' ),
			'section'  => 'qshop_design_section',
			'settings' => 'qshop_accent_color'
		)));

		if ( class_exists( 'WooCommerce' ) ) {

			/*** Hero Section ***/

			$wp_customize->add_section( 'qshop_hero_section' , array(
				'title'      => esc_html__( 'Hero Section', 'q-shop' ),
				'panel'     => 'qshop_basics_panel',
				'priority'   => 2
			) );
			
			$wp_customize->add_setting( 'qshop_hero_design' , array(
			    'default'     => 'hero_one',
			    'capability'  => 'edit_theme_options',
			    'sanitize_callback' => 'qshop_select_sanitize',
			    'transport'   => 'refresh'
			) );

			// Check if pro addon is active
			$pro_choices = array(
				'hero_one' => esc_html__( 'Hero Layout One', 'q-shop' )
			);

			if (function_exists('is_plugin_active') && is_plugin_active('qshop-pro-addon/qshop-pro-addon.php')) {
				$pro_choices['hero_two'] = esc_html__( 'Hero Layout Two', 'q-shop' );
				$pro_choices['hero_three'] = esc_html__( 'Hero Layout Three', 'q-shop' );
			}

			$wp_customize->add_control( 'qshop_hero_design', array(
			    'label'      => esc_html__( 'Hero Section', 'q-shop' ),
			    'description' => esc_html__( 'Select a hero section for the homepage.', 'q-shop' ),
			    'section'    => 'qshop_hero_section',
			    'type'       => 'radio',
			    'choices'    => $pro_choices
			) );

			$wp_customize->add_setting( 'qshop_hero_bg_image', array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'qshop_hero_bg_image', array(
					'label' =>  esc_html__( 'Hero Background Image', 'q-shop' ),
					'description' => esc_html__( 'Upload a background image for the hero section.', 'q-shop' ),
					'section' => 'qshop_hero_section',
					'settings' => 'qshop_hero_bg_image'
				)
			) );

			$wp_customize->add_setting( 'qshop_hero_title', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_hero_title', array(
				'label' => esc_html__( 'Hero Title', 'q-shop' ),
				'description' => esc_html__( 'Enter a title for the hero section.', 'q-shop' ),
				'section' => 'qshop_hero_section',
				'type' => 'text'
			) );

			$wp_customize->get_setting( 'qshop_hero_title' )->transport = 'postMessage';
	 
			$wp_customize->selective_refresh->add_partial( 'qshop_hero_title', array(
				'selector' => '.hero-text'
			) );

			$wp_customize->add_setting( 'qshop_hero_paragraph', array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_hero_paragraph', array(
				'label' => esc_html__( 'Hero Paragraph', 'q-shop' ),
				'description' => esc_html__( 'Enter a short paragraph for the hero section.', 'q-shop' ),
				'section' => 'qshop_hero_section',
				'type' => 'textarea'
			) );

			$wp_customize->add_setting( 'qshop_call_to_action_text', array(
				'default' => esc_html__( 'Trend Alert', 'q-shop' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_call_to_action_text', array(
				'label' => esc_html__( 'Call To Action Text', 'q-shop' ),
				'description' => esc_html__( 'Enter call to action text for the hero section.', 'q-shop' ),
				'section' => 'qshop_hero_section',
				'type' => 'text'
			) );

			$wp_customize->add_setting( 'qshop_call_to_action_url', array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_call_to_action_url', array(
				'label' => esc_html__( 'Call To Action URL', 'q-shop' ),
				'description' => esc_html__( 'Enter a URL for the call to action button (Leave blank to link to shop page).', 'q-shop' ),
				'section' => 'qshop_hero_section',
				'type' => 'url'
			) );

			$wp_customize->add_setting( 'qshop_call_to_action_image', array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'qshop_call_to_action_image', array(
					'label' =>  esc_html__( 'Hero Layout 1 - Call To Action Image', 'q-shop' ),
					'description' => esc_html__( 'Upload an image for the call to action container.', 'q-shop' ),
					'section' => 'qshop_hero_section',
					'settings' => 'qshop_call_to_action_image'
				)
			) );

			$wp_customize->get_setting( 'qshop_call_to_action_text' )->transport = 'postMessage';
	 
			$wp_customize->selective_refresh->add_partial( 'qshop_call_to_action_text', array(
				'selector' => '.hero-call-to-action'
			) );
		
		}

		/*** Shop Items Section ***/

		// Only add shop section if WooCommerce is active
		if ( class_exists( 'WooCommerce' ) ) {
			$wp_customize->add_section( 'qshop_shop_items_section' , array(
			    'title'      => esc_html__( 'Shop Items Section', 'q-shop' ),
			    'panel'     => 'qshop_basics_panel',
			    'priority'   => 3
			) );

			$wp_customize->add_setting( 'qshop_shop_items_title', array(
				'default' => esc_html__( 'Shop The Latest', 'q-shop' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_shop_items_title', array(
				'label' => esc_html__( 'Section Title', 'q-shop' ),
				'description' => esc_html__( 'Enter a title for the shop items section.', 'q-shop' ),
				'section' => 'qshop_shop_items_section',
				'type' => 'text'
			) );

			$wp_customize->add_setting( 'qshop_shop_items_subtitle', array(
				'default' => esc_html__( 'Wardrobe Essentials', 'q-shop' ),
				'sanitize_callback' => 'sanitize_text_field',
				'transport'   => 'refresh'
			) );

			$wp_customize->add_control( 'qshop_shop_items_subtitle', array(
				'label' => esc_html__( 'Section Subtitle', 'q-shop' ),
				'description' => esc_html__( 'Enter a subtitle for the shop items section.', 'q-shop' ),
				'section' => 'qshop_shop_items_section',
				'type' => 'text'
			) );

			$wp_customize->get_setting( 'qshop_shop_items_title' )->transport = 'postMessage';
 
			$wp_customize->selective_refresh->add_partial( 'qshop_shop_items_title', array(
				'selector' => '.shop-items-title'
			) );
		}

		/*************** Footer Panel ***************/

		$wp_customize->add_panel( 'qshop_footer_panel', array(
	        'priority'       => 103,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Footer', 'q-shop' )
	    ) );

		/*** Copyright Text Section ***/

		$wp_customize->add_section( 'qshop_copyrights_section' , array(
		    'title'      => esc_html__( 'Copyrights Text', 'q-shop' ),
		    'panel'     => 'qshop_footer_panel',
		    'priority'   => 3
		) );

		$wp_customize->add_setting( 'qshop_footer_text_left', array(
			'capability' => 'edit_theme_options',
			'default'    => '© ' . date('Y') . ' Q Shop - Powered by <a href="https://wordpress.org">WordPress</a>',
        	'sanitize_callback' => 'wp_kses_post',
		) );

		$wp_customize->add_control( 'qshop_footer_text_left', array(
			'type' => 'text',
			'section' => 'qshop_copyrights_section',
			'label' => esc_html__( 'Copyrights Text Left', 'q-shop' ),
			'description' => esc_html__( 'Copyrights text displayed on the left side of the footer.', 'q-shop' ),
		) );

		$wp_customize->get_setting( 'qshop_footer_text_left' )->transport = 'postMessage';
 
		$wp_customize->selective_refresh->add_partial( 'qshop_footer_text_left', array(
			'selector' => '#copyright'
		) );

		$wp_customize->add_setting( 'qshop_footer_text_right', array(
			'capability' => 'edit_theme_options',
			'default'    => sprintf( 'Made by <a href="%1$s">%2$s</a>', esc_url( wp_get_theme()->get('AuthorURI') ), esc_html( wp_get_theme()->get('Author') ) ),
        	'sanitize_callback' => 'wp_kses_post',
		) );

		$wp_customize->add_control( 'qshop_footer_text_right', array(
			'type' => 'text',
			'section' => 'qshop_copyrights_section',
			'label' => esc_html__( 'Copyrights Text Right', 'q-shop' ),
			'description' => esc_html__( 'Copyrights text displayed on the right side of the footer.', 'q-shop' ),
		) );

	}

	/*************** Sanitizing ***************/

	//select sanitization function

	function qshop_select_sanitize($input, $setting) {

	    $input = sanitize_key($input);

	    $choices = $setting->manager->get_control( $setting->id )->choices;

	    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	function qshop_announcement_bar_sanitize( $input ) {
		$allowed_tags = array(
			'a' => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			)
		);

		return wp_kses( $input, $allowed_tags );
	}