<?php
/**
 * Revista-politica functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Revista-politica
 */

if ( ! function_exists( 'rev_politica_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rev_politica_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Revista-politica, use a find and replace
		 * to change 'rev_politica' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rev_politica', get_template_directory() . '/languages' );

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
		add_image_size( 'full-bleed', 800, 400, true );
		add_image_size( 'index', 340, 200, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'rev_politica' ),
			'social' => esc_html__( 'Social', 'rev_politica' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rev_politica_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/**
		 * Enable features from Soil when plugin is activated
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support('soil-clean-up');
		//add_theme_support('soil-disable-rest-api');
		//add_theme_support('soil-disable-asset-versioning');
		add_theme_support('soil-disable-trackbacks');
		add_theme_support('soil-google-analytics', 'UA-138863205-1');
		add_theme_support('soil-jquery-cdn');
		add_theme_support('soil-js-to-footer');
		add_theme_support('soil-nav-walker');
		add_theme_support('soil-nice-search');
		add_theme_support('soil-relative-urls');
	}
endif;
add_action( 'after_setup_theme', 'rev_politica_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rev_politica_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rev_politica_content_width', 640 );
}
add_action( 'after_setup_theme', 'rev_politica_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rev_politica_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rev_politica' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rev_politica' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rev_politica_widgets_init' );

/**
 * Register custom fonts.
 */
function rev_politica_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro and Bitter, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sourceSansPro = _x( 'on', 'Source Sans Pro font: on or off', 'rev_politica' );
	$bitter = _x( 'on', 'Bitter font: on or off', 'rev_politica' );

	$font_families = array();

	if ( 'off' !== $sourceSansPro ) {
		$font_families[] = 'Source Sans Pro:400,400i,700,700i';
	}

	if ( 'off' !== $bitter ) {
		$font_families[] = 'Bitter:400,400i,700';
	}


	if ( in_array( 'on', array($sourceSansPro, $bitter) ) ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function rev_politica_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'rev_politica-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'rev_politica_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function rev_politica_scripts() {
	// Enqueue Google Fonts: Source Sans Pro and Bitter
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'rev_politica-fonts', rev_politica_fonts_url() );

	// Fontawesome
	//wp_enqueue_style( 'rev_politica-fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), null );

	wp_enqueue_style( 'rev_politica-style', get_stylesheet_uri(), array(), '20190417', 'all' );

	wp_enqueue_script( 'rev_politica-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'rev_politica-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20161201', true );

	wp_enqueue_script( 'rev_politica-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rev_politica_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/icons.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
