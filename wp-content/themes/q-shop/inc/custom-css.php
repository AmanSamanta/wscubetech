<?php
/**
 * Custom CSS generated from the Customizer options.
 */

function qshop_get_custom_css() {

	$css = '';

	$qshop_accent_color = sanitize_hex_color( get_theme_mod( 'qshop_accent_color' ) );
	$qshop_sticky_header_option = esc_html( get_theme_mod( 'qshop_sticky_header', 'off' ) );
	$qshop_hero_bg_image = esc_url( get_theme_mod( 'qshop_hero_bg_image' ) );

	if ( $qshop_sticky_header_option == 'off' ) {
		$css .= '
			#main-header.stick-it {
				position: relative;
			}
			.main-sidebar-wrap {
				top: 40px;
			}
		';
	}

	if ( !empty( $qshop_accent_color ) ) {
		$css .= '
			:root {
				--accent-color: ' . $qshop_accent_color . ';
			}
		';
	}

	if ( !empty( $qshop_hero_bg_image ) ) {
		$css .= '
			#hero-section {
				background-image: url(' . $qshop_hero_bg_image . ');
			}
		';
	}

	$qshop_header_class = "default-header";

	if ( class_exists( 'WooCommerce' ) ) {

		// Check if the pro addon function exists (better than is_plugin_active on frontend)
		if ( function_exists( 'qshop_enqueue_pro_addon_styles' ) ) { 
			$qshop_hero_option = get_theme_mod( 'qshop_hero_design', 'hero_one' );

			if ( is_page_template( 'homepage.php' ) && !is_paged() && 'hero_one' === $qshop_hero_option ) {
				$qshop_header_class = "hero-header";
			}

		} elseif ( is_page_template( 'homepage.php' ) && !is_paged() ) {

			$qshop_header_class = "hero-header";

		}

		if ( $qshop_header_class == "hero-header" ) {
			
			$css .= '
				#hidden-sidebar-icon::before,
				#hidden-sidebar-icon::after {
					background-color: #fff;
				}

				.site-text-logo a, #main-nav a {
					color: #fff;
				}

				.main-header-inner-wrap {
					border-bottom-color: rgba(255, 255, 255, 0.25);
				}

				#main-nav .current-menu-item {
					border-bottom-color: #fff;
				}

				.hero-header #header-elements svg {
					color: #fff;
				}

				.hero-header .stick-it #header-elements svg {
					color: #121212;
				}

				.cart-count-wrap {
					color: #121212;
					background-color: #fff;
				}

				.stick-it .cart-count-wrap {
					color: #fff;
					background-color: #121212;
				}

				.cart-customlocation:hover .cart-count-wrap {
					color: #fff;
				}

				/*** Modal Login Form ***/

				.modal-login-form {
					color: #fff;
					background: rgba(255, 255, 255, 0.05);
					border: 1px solid rgba(255, 255, 255, 0.09);
					backdrop-filter: blur(13.2px);
				}

				.modal-login-form h4,
				.modal-login-form label {
					color: #fff;
				}

				.stick-it .modal-login-form h4,
				.stick-it .modal-login-form label {
					color: #333;
				}

				.stick-it .modal-login-form {
					color: #121212;
					background: #fff;
					border: 1px solid #EAEAEA;
				}

				.modal-login-form input[type="text"],
				.modal-login-form input[type="password"] {
					border: 1px solid rgb(255 255 255 / 18%);
					background-color: rgb(255 255 255 / 12%);
					color: #fff;
				}

				.stick-it .modal-login-form input[type="text"], 
				.stick-it .modal-login-form input[type="password"] {
					color: #333;
					border: 1px solid #EAEAEA;
				}

				.modal-login-form input[type="text"]:focus, 
				.modal-login-form input[type="password"]:focus {
					border: 1px solid rgb(255 255 255 / 60%);
				}

				.stick-it .modal-login-form input[type="text"]:focus, 
				.stick-it .modal-login-form input[type="password"]:focus {
					border-color: var(--theme-black);
				}

				#header-elements .modal-login-form a.button,
				.modal-login-form .woocommerce-form-login__submit {
					color: #121212;
					background-color: #fff;
				}

				.stick-it #header-elements .modal-login-form a.button,
				.stick-it .modal-login-form .woocommerce-form-login__submit {
					color: #fff;
					background-color: var(--theme-black);
				}

				#header-elements .modal-login-form a.button:hover,
				.modal-login-form .woocommerce-form-login__submit:hover {
					color: #121212;
					background-color: rgba(255, 255, 255, 0.7);
				}

				.stick-it #header-elements .modal-login-form a.button:hover,
				.stick-it .modal-login-form .woocommerce-form-login__submit:hover {
					color: #fff;
					background-color: #333;
				}

				#header-elements .modal-login-form a {
					color: #fff;
					text-decoration: underline;
					text-decoration-style: dotted;
				}

				.stick-it #header-elements .modal-login-form a {
					color: var(--accent-color);
					text-decoration: none;
				}

				#header-elements .modal-login-form a:hover {
					text-decoration-style: solid;
				}

				.stick-it #header-elements .modal-login-form a:hover {
					color: var(--theme-black);
					text-decoration: underline;
				}
			';

		}

	}

	return $css;
}
