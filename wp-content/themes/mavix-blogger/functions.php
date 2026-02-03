<?php
/**
 * Mavix Blogger functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mavix Blogger
 */

if ( ! function_exists( 'mavix_blogger_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mavix_blogger_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mavix Blogger, use a find and replace
	 * to change 'mavix-blogger' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mavix-blogger', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mavix-blogger' ),
	) );

	// Enable support for custom logo.
	add_theme_support( 'custom-logo' , array(
		'height'		=>45,	
		'width'			=>45,	
		'flex-height'	=>true,	
		'flex-width'	=>true,
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mavix_blogger_custom_background_args', array(
		'default-color' => 'fff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	$mavix_blogger_min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	add_editor_style( array( '/assets/css/editor-style' . $mavix_blogger_min . '.css', mavix_blogger_fonts_url() ) );

	// Gutenberg support
	add_theme_support( 'editor-color-palette', array(
       	array(
			'name' => esc_html__( 'Tan', 'mavix-blogger' ),
			'slug' => 'tan',
			'color' => '#E6DBAD',
       	),
       	array(
           	'name' => esc_html__( 'Yellow', 'mavix-blogger' ),
           	'slug' => 'yellow',
           	'color' => '#FDE64B',
       	),
       	array(
           	'name' => esc_html__( 'Orange', 'mavix-blogger' ),
           	'slug' => 'orange',
           	'color' => '#ED7014',
       	),
       	array(
           	'name' => esc_html__( 'Red', 'mavix-blogger' ),
           	'slug' => 'red',
           	'color' => '#D0312D',
       	),
       	array(
           	'name' => esc_html__( 'Pink', 'mavix-blogger' ),
           	'slug' => 'pink',
           	'color' => '#b565a7',
       	),
       	array(
           	'name' => esc_html__( 'Purple', 'mavix-blogger' ),
           	'slug' => 'purple',
           	'color' => '#A32CC4',
       	),
       	array(
           	'name' => esc_html__( 'Blue', 'mavix-blogger' ),
           	'slug' => 'blue',
           	'color' => '#3A43BA',
       	),
       	array(
           	'name' => esc_html__( 'Green', 'mavix-blogger' ),
           	'slug' => 'green',
           	'color' => '#3BB143',
       	),
       	array(
           	'name' => esc_html__( 'Brown', 'mavix-blogger' ),
           	'slug' => 'brown',
           	'color' => '#231709',
       	),
       	array(
           	'name' => esc_html__( 'Grey', 'mavix-blogger' ),
           	'slug' => 'grey',
           	'color' => '#6C626D',
       	),
       	array(
           	'name' => esc_html__( 'Black', 'mavix-blogger' ),
           	'slug' => 'black',
           	'color' => '#000000',
       	),
   	));

	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-font-sizes', array(
	   	array(
	       	'name' => esc_html__( 'small', 'mavix-blogger' ),
	       	'shortName' => esc_html__( 'S', 'mavix-blogger' ),
	       	'size' => 12,
	       	'slug' => 'small'
	   	),
	   	array(
	       	'name' => esc_html__( 'regular', 'mavix-blogger' ),
	       	'shortName' => esc_html__( 'M', 'mavix-blogger' ),
	       	'size' => 16,
	       	'slug' => 'regular'
	   	),
	   	array(
	       	'name' => esc_html__( 'larger', 'mavix-blogger' ),
	       	'shortName' => esc_html__( 'L', 'mavix-blogger' ),
	       	'size' => 36,
	       	'slug' => 'larger'
	   	),
	   	array(
	       	'name' => esc_html__( 'huge', 'mavix-blogger' ),
	       	'shortName' => esc_html__( 'XL', 'mavix-blogger' ),
	       	'size' => 48,
	       	'slug' => 'huge'
	   	)
	));
	add_theme_support('editor-styles');
	add_theme_support( 'wp-block-styles' );
}
endif;
add_action( 'after_setup_theme', 'mavix_blogger_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mavix_blogger_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mavix_blogger_content_width', 640 );
}
add_action( 'after_setup_theme', 'mavix_blogger_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mavix_blogger_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mavix-blogger' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mavix-blogger' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'mavix-blogger' ), 1 ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'mavix-blogger' ), 2 ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'mavix-blogger' ), 3 ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'mavix-blogger' ), 4 ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mavix_blogger_widgets_init' );

/**
 * Register custom fonts.
 */
function mavix_blogger_fonts_url() {
	$mavix_blogger_fonts_url = '';
	$mavix_blogger_fonts     = array();
	$mavix_blogger_subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins: on or off', 'mavix-blogger' ) ) {
		$mavix_blogger_fonts[] = 'Poppins:300,400,500,600,700,800,900';
	}

	if ( $mavix_blogger_fonts ) {
		$mavix_blogger_fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $mavix_blogger_fonts ) ),
			'subset' => urlencode( $mavix_blogger_subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $mavix_blogger_fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function mavix_blogger_scripts() {
	$mavix_blogger_min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$mavix_blogger_fonts_url = mavix_blogger_fonts_url();
	if ( ! empty( $mavix_blogger_fonts_url ) ) {
		wp_enqueue_style( 'mavix-blogger-google-fonts', $mavix_blogger_fonts_url, array(), null );
	}	

	wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/assets/css/all' . $mavix_blogger_min . '.css', '', '6.5.2' );

	wp_enqueue_style( 'mavix-blogger-blocks', get_template_directory_uri() . '/assets/css/blocks' . $mavix_blogger_min . '.css' );
	
	wp_enqueue_style( 'mavix-blogger-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'mavix-blogger-navigation', get_template_directory_uri() . '/assets/js/navigation' . $mavix_blogger_min . '.js', array(), '20151215', true );

	wp_enqueue_script( 'mavix-blogger-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $mavix_blogger_min . '.js', array(), '20151215', true );

	wp_enqueue_script( 'mavix-blogger-custom-js', get_template_directory_uri() . '/assets/js/custom' . $mavix_blogger_min . '.js', array('jquery'), '20151215', true );  

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mavix_blogger_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Mavix Blogger 1.0.0
 */
function mavix_blogger_block_editor_styles() {
	$mavix_blogger_min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Block styles.
	wp_enqueue_style( 'mavix-blogger-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . $mavix_blogger_min . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'mavix-blogger-fonts', mavix_blogger_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'mavix_blogger_block_editor_styles' );

function mavix_blogger_category_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'mavix_blogger_category_title' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';

/**
 * Getting Started.
 */
require get_template_directory() . '/inc/getting-started/getting-started.php';