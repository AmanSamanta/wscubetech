<?php
	/*
		Main Header Template Part
	*/
?>

<?php

	$qshop_header_class = "default-header";

	if ( class_exists( 'WooCommerce' ) ) {

		if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'qshop-pro-addon/qshop-pro-addon.php' ) ) {
			$qshop_hero_option = get_theme_mod( 'qshop_hero_design', 'hero_one' );

			if ( is_page_template( 'homepage.php' ) && !is_paged() && 'hero_one' === $qshop_hero_option ) {
				$qshop_header_class = "hero-header";
			}

		} elseif ( is_page_template( 'homepage.php' ) && !is_paged() ) {

			$qshop_header_class = "hero-header";

		}

	}

	$qshop_sticky_header_option = esc_html( get_theme_mod( 'qshop_sticky_header', 'off' ) );

	if ( $qshop_sticky_header_option == 'on' ) {
		
		$qshop_header_class .= " sticky-header";

	}

?>

<div id="main-header-wrap" class="<?php echo esc_attr( $qshop_header_class ); ?>">

	<?php if ( get_theme_mod( 'qshop_announcement_bar_text' ) ) { ?>

		<div id="announcement-bar">
			<?php echo qshop_announcement_bar_sanitize( get_theme_mod( 'qshop_announcement_bar_text' ) ); ?>
		</div>
	
	<?php } ?>

	<div id="sticky-wrapper">
	
		<header id="main-header" class="group">

			<div class="main-header-inner-wrap header-col-wrap wrapper group">

				<?php if ( is_active_sidebar( 'hidden-sidebar-widgets' ) ) { ?>

					<span id="hidden-sidebar-icon" title="<?php esc_attr_e( 'Sidebar', 'q-shop' ) ?>"></span>

				<?php } ?>

				<div id="logo-wrap" class="header-col header-col-1">

					<?php if ( has_custom_logo() ) { ?>
						
						<div class="site-logo hero-logo">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_html( get_theme_mod( 'qshop_hero_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ></a>

						</div>

						<div class="site-logo main-logo">

							<?php the_custom_logo(); ?>

						</div>

					<?php } else { ?>

						<div class="site-text-logo">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo(); ?></a></h1>
							<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('description'); ?></a></p>
						</div>

					<?php } ?>

				</div><!-- #logo-wrap -->

				<?php if ( has_nav_menu( 'main_nav' ) ) { ?>

					<nav id="main-nav" class="group header-col header-col-2">
						
						<?php wp_nav_menu(array('menu' => esc_html__('Main Navigation Menu', 'q-shop'), 'theme_location' => 'main_nav')); ?>

					</nav>

				<?php } ?>

				<div id="header-elements" class="header-col header-col-3">

					<?php get_template_part( 'template-parts/header/login-form' ); ?>

					<ul>

						<?php if ( class_exists( 'WooCommerce' ) ) { ?>

							<li class="sign-in-li form-closed">
								<span title="<?php esc_attr_e( 'Sign In', 'q-shop' ); ?>" class="open-form-icon">
									<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M19 21V18.7778C19 17.599 18.5259 16.4686 17.682 15.6351C16.8381 14.8016 15.6935 14.3333 14.5 14.3333H5.5C4.30653 14.3333 3.16193 14.8016 2.31802 15.6351C1.47411 16.4686 1 17.599 1 18.7778V21M14.5 5.44444C14.5 7.89904 12.4853 9.88889 10 9.88889C7.51472 9.88889 5.5 7.89904 5.5 5.44444C5.5 2.98985 7.51472 1 10 1C12.4853 1 14.5 2.98985 14.5 5.44444Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>

								<span title="<?php esc_attr_e( 'Close Form', 'q-shop' ); ?>" class="close-form-icon">
									<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12.5 14.3333H5.5C4.30653 14.3333 3.16193 14.8016 2.31802 15.6351C1.47411 16.4686 1 17.599 1 18.7778V21M14.5 5.44444C14.5 7.89904 12.4853 9.88889 10 9.88889C7.51472 9.88889 5.5 7.89904 5.5 5.44444C5.5 2.98985 7.51472 1 10 1C12.4853 1 14.5 2.98985 14.5 5.44444Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
										<rect x="14" y="16" width="1" height="7" transform="rotate(-45 14 16)" fill="currentColor"/>
										<rect x="18.95" y="15.2929" width="1" height="7" transform="rotate(45 18.95 15.2929)" fill="currentColor"/>
									</svg>
								</span>
							</li>

						<?php } ?>

						<?php if ( class_exists( 'WooCommerce' ) ) { ?>

							<li id="shopping-cart-li">

								<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" 
								aria-label="<?php 
									printf(
										esc_attr( _n( '%d item in cart', '%d items in cart', WC()->cart->get_cart_contents_count(), 'q-shop' ) ),
										WC()->cart->get_cart_contents_count()
									); 
								?>" title="<?php esc_attr_e( 'View your shopping cart', 'q-shop' ); ?>">
									<svg aria-hidden="true" focusable="false" width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 1H4.81818L7.37636 13.7524C7.46365 14.1909 7.70273 14.5847 8.05175 14.865C8.40077 15.1454 8.83748 15.2943 9.28545 15.2857H18.5636C19.0116 15.2943 19.4483 15.1454 19.7973 14.865C20.1464 14.5847 20.3854 14.1909 20.4727 13.7524L22 5.7619H5.77273M9.59091 20.0476C9.59091 20.5736 9.16354 21 8.63636 21C8.10918 21 7.68182 20.5736 7.68182 20.0476C7.68182 19.5216 8.10918 19.0952 8.63636 19.0952C9.16354 19.0952 9.59091 19.5216 9.59091 20.0476ZM20.0909 20.0476C20.0909 20.5736 19.6635 21 19.1364 21C18.6092 21 18.1818 20.5736 18.1818 20.0476C18.1818 19.5216 18.6092 19.0952 19.1364 19.0952C19.6635 19.0952 20.0909 19.5216 20.0909 20.0476Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<span class="cart-count-wrap" aria-hidden="true"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
									<span class="screen-reader-text">
										<?php 
										printf(
											_n( '%d item in cart', '%d items in cart', WC()->cart->get_cart_contents_count(), 'q-shop' ), 
											WC()->cart->get_cart_contents_count() 
										); 
										?>
									</span>
								</a>
								
							</li>

						<?php } ?>

						<?php if ( esc_html( $qshop_search_option = get_theme_mod('qshop_header_search') ) == 'on' ) { ?>

							<li>

								<button id="header-search-icon" 
									class="header-elements-icon" 
									aria-expanded="false" 
									aria-controls="modal-search"
									aria-label="<?php esc_attr_e( 'Open search', 'q-shop' ) ?>" title="<?php esc_attr_e( 'Search', 'q-shop' ) ?>">
									<svg aria-hidden="true" focusable="false" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M21 21L16.1667 16.1667M18.7778 9.88889C18.7778 14.7981 14.7981 18.7778 9.88889 18.7778C4.97969 18.7778 1 14.7981 1 9.88889C1 4.97969 4.97969 1 9.88889 1C14.7981 1 18.7778 4.97969 18.7778 9.88889Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<span class="screen-reader-text"><?php esc_html_e( 'Search', 'q-shop' ); ?></span>
								</button>

							</li>

						<?php } ?>

					</ul>

					<?php if ( has_nav_menu( 'main_nav' ) ) { ?>

						<div class="mobile-menu-icon-wrap">
						
							<button class="mobile-menu-icon header-elements-icon corner-btn" 
								aria-expanded="false" 
								aria-controls="mobile-menu"
								aria-label="<?php esc_attr_e( 'Toggle menu', 'q-shop' ); ?>">
								<?php esc_html_e( 'Menu', 'q-shop' ); ?>
							</button>

						</div>

					<?php } ?>

					<?php if ( has_nav_menu( 'main_nav' ) ) { ?>

						<nav id="mobile-menu" class="mobile-menu" aria-labelledby="mobile-menu-title">

							<h2 id="mobile-menu-title" class="screen-reader-text"><?php esc_html_e( 'Main Menu', 'q-shop' ); ?></h2>

							<?php 
								wp_nav_menu(array(
									'menu' => esc_html__('Main Navigation Menu', 'q-shop'), 
									'theme_location' => 'main_nav',
									'menu_class' => 'mobile-menu-list',
									'container' => false
								)); 
							?>

							<button class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'q-shop' ); ?>">
								<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'q-shop' ); ?></span>
							</button>
							
						</nav>
						
						<span class="mobile-menu-overlay"></span>

					<?php } ?>

				</div><!-- #header-elements -->

			</div><!-- .main-header-inner-wrap -->

		</header>

	</div><!-- #sticky-wrapper -->

</div><!-- #main-header-wrap -->

<?php get_template_part('template-parts/cart', 'sidebar'); ?>

<?php get_template_part('template-parts/header/hidden-sidebar'); ?>