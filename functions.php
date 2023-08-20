<?php

add_theme_support( 'automatic-feed-links' );

// Add support for block styles.
add_theme_support('wp-block-styles');

// Add support for full and wide align images.
add_theme_support('align-wide');

// Add support for editor styles.
add_editor_style('style-editor.css');

// Add support for responsive embedded content

// Enqueue Bootstrap 5.3 CSS and JS
function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1');
    wp_enqueue_script('bootstrap-js-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

// Enqueue the main style.css from the root directory
function enqueue_theme_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// Register Navigation Menus
function register_theme_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'bootstrap-ultra')
        )
    );
}
add_action('init', 'register_theme_menus');

// Include WP_Bootstrap_Navwalker class for Bootstrap navigation
if (!class_exists('WP_Bootstrap_Navwalker')) {
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

// Add theme support features
function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style'));
}
add_action('after_setup_theme', 'theme_setup');

function bootstrap_ultra_widgets_init() {
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'bootstrap-ultra'),
        'id'            => 'main-sidebar',
        'description'   => __('Widgets in this area will be shown on all posts and pages.', 'bootstrap-ultra'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'bootstrap_ultra_widgets_init');

// Customizer Options
function bootstrap_ultra_customize_register($wp_customize) {
    $wp_customize->add_section('bootstrap_ultra_options', array(
        'title' => __('Bootstrap Ultra Options', 'bootstrap-ultra'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('body_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('body_font_size', array(
        'label' => __('Body Font Size (px)', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_options',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 24,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting('layout_style', array(
        'default' => 'full-width',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control('layout_style', array(
        'label' => __('Layout Style', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_options',
        'type' => 'select',
        'choices' => array(
            'full-width' => __('Full Width', 'bootstrap-ultra'),
            'boxed' => __('Boxed', 'bootstrap-ultra'),
        ),
    ));

    $wp_customize->add_setting('background_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
        'label' => __('Background Color', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_options',
    )));

    // Theme Style (Light/Dark Mode)
    $wp_customize->add_setting('theme_style', array(
        'default' => 'light',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    $wp_customize->add_control('theme_style', array(
        'label' => __('Theme Style', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_options',
        'type' => 'select',
        'choices' => array(
            'light' => __('Light', 'bootstrap-ultra'),
            'dark' => __('Dark', 'bootstrap-ultra'),
        ),
    ));
}
add_action('customize_register', 'bootstrap_ultra_customize_register');

function bootstrap_ultra_custom_logo_setup() {
    $defaults = array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'bootstrap_ultra_custom_logo_setup');

function default_menu() {
    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 1,
    ));
    echo '</ul>';
}

function enqueue_theme_dark_style() {
    $theme_style = get_theme_mod('theme_style', 'light');
    if ($theme_style == 'dark') {
        wp_enqueue_style('theme-dark-style', get_template_directory_uri() . '/dark-style.css', array(), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_dark_style', 20);

function bootstrap_ultra_enqueue_comment_reply_script() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bootstrap_ultra_enqueue_comment_reply_script');

?>