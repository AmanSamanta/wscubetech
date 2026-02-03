<?php

    // after_setup_theme Action

    add_action('after_setup_theme', 'qshop_setup');

    function qshop_setup() {

        add_theme_support('woocommerce');

        load_theme_textdomain('qshop', get_template_directory() . '/languages');

        add_theme_support( 'editor-styles' );

        add_editor_style( 'style-editor.css' );

        add_editor_style( qshop_fonts_url() );

        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'White', 'q-shop' ),
                'slug'  => 'white',
                'color' => '#FFFFFF',
            ),
            array(
                'name'  => esc_html__( 'Gray', 'q-shop' ),
                'slug'  => 'gray',
                'color' => '#F2F2F2',
            ),
            array(
                'name'  => esc_html__( 'Black', 'q-shop' ),
                'slug'  => 'black',
                'color' => '#121212',
               ),
            array(
                'name'  => esc_html__( 'Green', 'q-shop' ),
                'slug'  => 'green',
                'color' => '#818983',
               ),
        ) );
    }

	// HTML5 Support

    add_theme_support( 'html5', array('script', 'style') );

	// Title Tag Support

    add_theme_support('title-tag');

	// Declare WP Menu

    function qshop_custom_menus() {
        register_nav_menus( array (
            'main_nav' => esc_html__('Main Navigation Menu', 'q-shop')
        ) );
    }
    add_action( 'init', 'qshop_custom_menus' );

    // Adding post thumbnail support

    if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
   
    if ( function_exists( 'add_image_size' ) )
    {
        add_image_size( 'qshop-feat-thumb', 2048, 1366, true );
        add_image_size( 'qshop-product-thumb', 656, 762, true );
        add_image_size( 'qshop-single-product-thumb', 772, 881, true );
        add_image_size( 'qshop-feat-product-thumb', 1200, 983, true );
        add_image_size( 'qshop-category-thumb', 699, 1098, true );
        add_image_size( 'qshop-medium-thumb', 654, 617, true );
        add_image_size( 'qshop-small-thumb', 338, 318, true );
        add_image_size( 'qshop-single-thumb', 1080, 620, true );
    }

    // Post Formats

    add_theme_support( 'post-formats', array('gallery', 'video', 'audio') );

    // Load Google Fonts

    if ( !function_exists( 'qshop_fonts_url' ) ) :
    
        function qshop_fonts_url() {
            $fonts_url = '';
            $fonts     = array();
            $subsets   = '';

            /*
                Translators: If there are characters in your language that are not supported by these fonts, translate these to 'off'. Do not translate into your own language.
            */

            if ( 'off' !== esc_html_x( 'on', 'Inter font: on or off', 'q-shop' ) ) {
                $fonts[] = 'Inter:100,400,400i,700,700i';
            }

            if ( $fonts ) {
                $fonts_url = add_query_arg( array(
                    'family' => urlencode( implode( '|', $fonts ) ),
                    'subset' => urlencode( $subsets ),
                ), 'https://fonts.googleapis.com/css' );
            }

            return esc_url_raw( $fonts_url );
        }

    endif;

    function qshop_fonts_enqueue() {
        wp_enqueue_style( 'qshop-fonts', qshop_fonts_url(), array(), null ); // Add custom fonts.
    }
    add_action( 'wp_enqueue_scripts', 'qshop_fonts_enqueue' );

    // Load CSS files

    function qshop_styles_load ()
    {
        if ( !is_admin() )
        {
            
            wp_enqueue_style('qshop-style', get_stylesheet_directory_uri() . '/style.css', '', '1.0.4');

            wp_enqueue_style('qshop-media-queries', get_template_directory_uri() . '/css/media-queries.css', '', '1.0.1');
            
            wp_add_inline_style( 'qshop-style', qshop_get_custom_css() );
        }
    }
    add_action( 'wp_enqueue_scripts', 'qshop_styles_load', '20' );

    function qshop_admin_scripts_load ()
    {
        if ( is_admin() )
        {

            wp_enqueue_style('qshop-admin-custom', get_stylesheet_directory_uri() . '/css/customize-controls.css', '', '1.0');
            
        }
    }
    add_action('admin_enqueue_scripts', 'qshop_admin_scripts_load');

    // Load javascript files

    function qshop_scripts_load ()
   {
       if ( is_singular() ) wp_enqueue_script('comment-reply');
       
       wp_enqueue_script('jquery-masonry');
       wp_enqueue_script('imagesloaded');

       wp_enqueue_script('qshop-custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'imagesloaded'), '1.0.4', true);
       
   }
    add_action('wp_enqueue_scripts', 'qshop_scripts_load');

    // Load customizer control scripts
    function qshop_customizer_scripts() {

        wp_enqueue_style('qshop-admin-custom', get_stylesheet_directory_uri() . '/css/customize-controls.css', '', '1.0.0');
        
    }
    add_action('customize_controls_enqueue_scripts', 'qshop_customizer_scripts');



    // Content width

    if ( ! isset( $content_width ) ) $content_width = 918;

    // Theme Support

    add_theme_support('automatic-feed-links');

    add_theme_support('custom-logo');

    add_theme_support('customize-selective-refresh-widgets');

    // WooCommerce

    if ( class_exists('WooCommerce') ) {

        add_filter( 'woocommerce_gallery_image_size', function( $size ) {
            return 'qshop-single-product-thumb';
        } );

        add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
            return 'qshop-single-product-thumb';
        } );

        add_action('wp_enqueue_scripts', 'qshop_woocommerce_enqueue_scripts');
        function qshop_woocommerce_enqueue_scripts() {
            if (is_woocommerce()) {
                wp_enqueue_script('wc-cart-fragments');
            }
        }

        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        add_filter( 'body_class', function($classes){
            if(in_array("woocommerce-no-js", $classes)) {
                remove_action( 'wp_footer', 'wc_no_js' );
                $classes = array_diff($classes, array('woocommerce-no-js'));
                $classes[] = 'woocommerce-js';
            }
            return array_values($classes);
        },10, 1);

        add_filter( 'woocommerce_loop_add_to_cart_link', 'qshop_add_to_cart_icon', 10, 3 );
        function qshop_add_to_cart_icon( $button, $product, $args ) {
            // Only modify for simple products (you can adjust for other product types if needed)
            if ( $product->is_purchasable() && $product->is_in_stock() ) {
                $button = sprintf(
                    '<span class="add-cart-btn corner-btn"><a href="%s" data-quantity="%s" class="%s" %s>
                        <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 6H4.81818L7.37636 18.7524C7.46365 19.1909 7.70273 19.5847 8.05175 19.865C8.40077 20.1454 8.83748 20.2943 9.28545 20.2857H18.5636C19.0116 20.2943 19.4483 20.1454 19.7973 19.865C20.1464 19.5847 20.3854 19.1909 20.4727 18.7524L22 10.7619H5.77273M9.59091 25.0476C9.59091 25.5736 9.16354 26 8.63636 26C8.10918 26 7.68182 25.5736 7.68182 25.0476C7.68182 24.5216 8.10918 24.0952 8.63636 24.0952C9.16354 24.0952 9.59091 24.5216 9.59091 25.0476ZM20.0909 25.0476C20.0909 25.5736 19.6635 26 19.1364 26C18.6092 26 18.1818 25.5736 18.1818 25.0476C18.1818 24.5216 18.6092 24.0952 19.1364 24.0952C19.6635 24.0952 20.0909 24.5216 20.0909 25.0476Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M27 0H28V11H27V0Z" fill="currentColor"/>
                            <path d="M33 5V6L22 6L22 5L33 5Z" fill="currentColor"/>
                        </svg>
                    </a></span>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                    esc_attr( isset( $args['class'] ) ? $args['class'] : 'button add_to_cart_button ajax_add_to_cart' ),
                    isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : ''
                );
            }
            return $button;
        }

        /**
        * Show cart contents / total Ajax
        */
        
        add_filter( 'woocommerce_add_to_cart_fragments', 'qshop_woocommerce_header_add_to_cart_fragment' );

        function qshop_woocommerce_header_add_to_cart_fragment( $fragments ) {
            global $woocommerce;
    
            ob_start();
    
            ?>
            <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'q-shop' ); ?>">

                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1H4.81818L7.37636 13.7524C7.46365 14.1909 7.70273 14.5847 8.05175 14.865C8.40077 15.1454 8.83748 15.2943 9.28545 15.2857H18.5636C19.0116 15.2943 19.4483 15.1454 19.7973 14.865C20.1464 14.5847 20.3854 14.1909 20.4727 13.7524L22 5.7619H5.77273M9.59091 20.0476C9.59091 20.5736 9.16354 21 8.63636 21C8.10918 21 7.68182 20.5736 7.68182 20.0476C7.68182 19.5216 8.10918 19.0952 8.63636 19.0952C9.16354 19.0952 9.59091 19.5216 9.59091 20.0476ZM20.0909 20.0476C20.0909 20.5736 19.6635 21 19.1364 21C18.6092 21 18.1818 20.5736 18.1818 20.0476C18.1818 19.5216 18.6092 19.0952 19.1364 19.0952C19.6635 19.0952 20.0909 19.5216 20.0909 20.0476Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="cart-count-wrap"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>

            </a>
            <?php
            $fragments['a.cart-customlocation'] = ob_get_clean();
            return $fragments;
        }
    
        /**
        * Change number of related products output
        */
        
        add_filter( 'woocommerce_output_related_products_args', 'qshop_woo_related_products_args', 20 );
        function qshop_woo_related_products_args( $args ) {
            $args['posts_per_page'] = 3; // 3 related products
            $args['columns'] = 3; // arranged in 3 columns
            return $args;
        }
    
        /**
        * Change number of products that are displayed per page (shop page)
        */

        add_filter( 'loop_shop_per_page', 'qshop_new_loop_shop_per_page', 20 );
    
        function qshop_new_loop_shop_per_page( $cols ) {
            $cols = 8;
            return $cols;
        }

        /**
        * Add plus and minus buttons to the quantity input.
        */

        add_action( 'woocommerce_before_quantity_input_field', 'qshop_display_quantity_minus' );
            function qshop_display_quantity_minus() {
            echo '<div class="quantity-wrapper"><button type="button" class="minus" >-</button>';
        }

        add_action( 'woocommerce_after_quantity_input_field', 'qshop_display_quantity_plus' );
            function qshop_display_quantity_plus() {
            echo '<button type="button" class="plus" >+</button></div>';
        }

    }

    // Declare widget zones

    function qshop_widgets_init() {

        register_sidebar(array(
            'name' => esc_html__('Shop Sidebar Widgets', 'q-shop'),
            'id'   => 'shop-sidebar-widgets',
            'description'   => esc_html__('These are widgets displayed in the shop sidebar.', 'q-shop'),
            'before_widget' => '<div id="%1$s" class="widget %2$s group">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="wp-block-heading">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Blog Sidebar Widgets', 'q-shop'),
            'id'   => 'blog-sidebar-widgets',
            'description'   => esc_html__('These are widgets displayed in the blogsidebar.', 'q-shop'),
            'before_widget' => '<div id="%1$s" class="widget %2$s group">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="wp-block-heading">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Hidden Sidebar Widgets', 'q-shop'),
            'id'   => 'hidden-sidebar-widgets',
            'description'   => esc_html__('These are widgets displayed in the hidden sidebar.', 'q-shop'),
            'before_widget' => '<div id="%1$s" class="widget %2$s group">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="wp-block-heading">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Widgets', 'q-shop'),
            'id'   => 'footer-widgets',
            'description'   => esc_html__('These are widgets displayed in the footer.', 'q-shop'),
            'before_widget' => '<div id="%1$s" class="widget %2$s group">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="wp-block-heading">',
            'after_title'   => '</h4>'
        ));

    }
    add_action( 'widgets_init', 'qshop_widgets_init' );

    // Comments callback function

    function qshop_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div class="comment-body group" id="comment-<?php comment_ID(); ?>">
	
				<div class="avatar-wrap"> 
					<?php echo get_avatar($comment,$size='42',$default='' ); ?>
				</div><!-- .avatar-wrap -->
	
				<div class="comment-contents group">
					
					<ul class="comment-meta">
						<li class="comment-author"><?php printf('%s', get_comment_author_link()) ?></li>
						<li class="comment-date"><?php printf(' %1$s', get_comment_date()) ?></li>
					</ul>
	
					<div class="comment-text">
				   
						<?php comment_text() ?>
					
						<?php if ($comment->comment_approved == '0') : ?>
							 <em class="awaiting-mod-txt"><?php esc_html_e('Your comment is awaiting moderation.', 'q-shop'); ?></em>
						<?php endif; ?>
	
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				   
					</div>
	
				</div>
			 
			</div>
	<?php
		}

include( get_template_directory() . '/customizer/qshop_customizer.php' );

include( get_template_directory() . '/inc/qshop_admin_menu.php' );

include( get_template_directory() . '/inc/custom-css.php' );