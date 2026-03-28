<?php
/**
 * WendyNevins Theme Functions
 *
 * @package WendyNevins
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme version for cache busting
if (!defined('WENDYNEVINS_VERSION')) {
    define('WENDYNEVINS_VERSION', '1.0.0');
}

/**
 * Theme Setup
 */
function wendynevins_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style'));
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'wendynevins'),
        'footer'  => __('Footer Menu', 'wendynevins'),
    ));
    
    // Set content width
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1280;
    }
    
    // Load text domain
    load_theme_textdomain('wendynevins', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'wendynevins_setup');

/**
 * Enqueue Scripts and Styles
 */
function wendynevins_scripts() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'wendynevins-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Main stylesheet
    wp_enqueue_style(
        'wendynevins-style',
        get_stylesheet_uri(),
        array(),
        WENDYNEVINS_VERSION
    );
    
    // Blog/Content stylesheet
    wp_enqueue_style(
        'wendynevins-blog',
        get_template_directory_uri() . '/assets/css/blog.css',
        array('wendynevins-style'),
        WENDYNEVINS_VERSION
    );
    
    // Theme JavaScript
    wp_enqueue_script(
        'wendynevins-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        WENDYNEVINS_VERSION,
        true
    );
    
    // Pass AJAX URL to JavaScript
    wp_localize_script('wendynevins-main', 'wendynevins', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'themeUrl' => get_template_directory_uri(),
    ));
    
    // Comment reply script on single posts
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wendynevins_scripts');

/**
 * Register Widget Areas
 */
function wendynevins_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name'          => __('Sidebar', 'wendynevins'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'wendynevins'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Footer widgets
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'wendynevins'),
        'id'            => 'footer-1',
        'description'   => __('First footer widget area.', 'wendynevins'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="wn-footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 2', 'wendynevins'),
        'id'            => 'footer-2',
        'description'   => __('Second footer widget area.', 'wendynevins'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="wn-footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 3', 'wendynevins'),
        'id'            => 'footer-3',
        'description'   => __('Third footer widget area.', 'wendynevins'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="wn-footer-widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Column 4', 'wendynevins'),
        'id'            => 'footer-4',
        'description'   => __('Fourth footer widget area.', 'wendynevins'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="wn-footer-widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'wendynevins_widgets_init');

/**
 * Add custom classes to nav menu items
 */
function wendynevins_nav_menu_css_class($classes, $item) {
    $classes[] = 'wn-nav-item';
    return $classes;
}
add_filter('nav_menu_css_class', 'wendynevins_nav_menu_css_class', 10, 2);

function wendynevins_nav_menu_link_attributes($atts) {
    $atts['class'] = 'wn-nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'wendynevins_nav_menu_link_attributes');

/**
 * Custom excerpt length
 */
function wendynevins_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'wendynevins_excerpt_length', 999);

function wendynevins_excerpt_more($more) {
    return sprintf(
        '... <a href="%s" class="read-more">%s</a>',
        get_permalink(),
        __('Read More', 'wendynevins')
    );
}
add_filter('excerpt_more', 'wendynevins_excerpt_more');

/**
 * Add body classes
 */
function wendynevins_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for mobile detection
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }
    
    return $classes;
}
add_filter('body_class', 'wendynevins_body_classes');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Clean up WordPress head
 */
function wendynevins_head_cleanup() {
    // Remove feed links
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove WLW manifest
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'wendynevins_head_cleanup');

/**
 * Disable WordPress emoji scripts
 */
function wendynevins_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'wendynevins_disable_emojis');

/**
 * Custom login logo
 */
function wendynevins_login_logo() {
    echo '<style type="text/css">
        #login h1 a {
            background-image: none;
            text-indent: 0;
            width: auto;
            height: auto;
            font-size: 24px;
            font-weight: bold;
            color: #0d8f4f;
            text-decoration: none;
        }
    </style>';
}
add_action('login_enqueue_scripts', 'wendynevins_login_logo');

function wendynevins_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'wendynevins_login_logo_url');

function wendynevins_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'wendynevins_login_logo_url_title');

/**
 * Add editor styles
 */
function wendynevins_editor_styles() {
    add_editor_style('assets/css/editor-style.css');
}
add_action('admin_init', 'wendynevins_editor_styles');

/**
 * Helper function to get upcoming CPD events
 */
if (!function_exists('wendynevins_get_upcoming_cpd')) {
    function wendynevins_get_upcoming_cpd($count = 3) {
        $args = array(
            'post_type'      => 'cpd_event',
            'posts_per_page' => $count,
            'orderby'        => 'meta_value',
            'meta_key'       => '_cpd_start_date',
            'order'          => 'ASC',
            'meta_query'     => array(
                array(
                    'key'     => '_cpd_start_date',
                    'value'   => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ),
            ),
        );
        
        return new WP_Query($args);
    }
}

/**
 * Helper function to get free CPD events
 */
if (!function_exists('wendynevins_get_free_cpd')) {
    function wendynevins_get_free_cpd($count = 5) {
        $args = array(
            'post_type'      => 'cpd_event',
            'posts_per_page' => $count,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'cpd_tag',
                    'field'    => 'slug',
                    'terms'    => 'free',
                ),
            ),
        );
        
        return new WP_Query($args);
    }
}
