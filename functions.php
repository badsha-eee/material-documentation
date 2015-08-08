<?php
/**
 * sbmd functions and definitions
 *
 * @package sbmd
 */

if ( ! function_exists( 'sbmd_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sbmd_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sbmd, use a find and replace
	 * to change 'sbmd' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sbmd', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'sbmd' ),
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

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sbmd_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sbmd_setup
add_action( 'after_setup_theme', 'sbmd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sbmd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sbmd_content_width', 640 );
}
add_action( 'after_setup_theme', 'sbmd_content_width', 0 );

if ( ! isset( $content_width ) ) $content_width = 900;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sbmd_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sbmd' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'sbmd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sbmd_scripts() {
	wp_enqueue_style( 'sbmd-style', get_stylesheet_uri() );

	wp_enqueue_script( 'sbmd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'sbmd-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sbmd_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//options for home page texts
function material_doc_home_page_text() {
	add_settings_section(
		'home_page_text',
		'Add To Cart Button Text For Single Page',
		'settings_desc',
		'reading'
	);

	add_settings_field(
		'home_page_title',
		'Title Text',
		'for_title',
		'reading',
		'home_page_text'
	);

	add_settings_field(
		'home_page_desc',
		'Slogan',
		'for_description',
		'reading',
		'home_page_text'
	);

	register_setting( 'reading', 'home_page_title' );
	register_setting( 'reading', 'home_page_desc');
}
 
add_action( 'admin_init', 'material_doc_home_page_text' );
 
function settings_desc() {
	echo '<p>The static home page has a feature to show a title and slogan. Please enter some text to show them. Else you can leave them blank.</p>';
}

function for_title() {
	$title = esc_attr( get_option( 'home_page_title' ) );
	echo "<input type='text' name='home_page_title' value='$title' />";
}

function for_description() {
	$desc = esc_attr( get_option( 'home_page_desc' ) );
	echo "<input type='text' name='home_page_desc' value='$desc' />";
}

// Grunt watch livereload in the browser.
// wp_enqueue_script( 'livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );