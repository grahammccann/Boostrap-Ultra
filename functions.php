<?php

// Enqueue Bootstrap 5.3 CSS and JS
function enqueue_bootstrap() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1');

    // Bootstrap JS Bundle (includes Popper.js)
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
    // Add post thumbnails support
    add_theme_support('post-thumbnails');

    // Add title tag theme support
    add_theme_support('title-tag');

    // Add HTML5 support
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
    // Add a section for theme options
    $wp_customize->add_section('bootstrap_ultra_options', array(
        'title' => __('Bootstrap Ultra Options', 'bootstrap-ultra'),
        'priority' => 30,
    ));

    // Add setting for body font size
    $wp_customize->add_setting('body_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
    ));

    // Add control for body font size
    $wp_customize->add_control('body_font_size', array(
        'label'    => __('Body Font Size (px)', 'bootstrap-ultra'),
        'section'  => 'bootstrap_ultra_options',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 24,
            'step' => 1,
        ),
    ));

    // Add setting for layout style
    $wp_customize->add_setting('layout_style', array(
        'default'           => 'full-width',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));

    // Add control for layout style
    $wp_customize->add_control('layout_style', array(
        'label'    => __('Layout Style', 'bootstrap-ultra'),
        'section'  => 'bootstrap_ultra_options',
        'type'     => 'select',
        'choices'  => array(
            'full-width' => __('Full Width', 'bootstrap-ultra'),
            'boxed'      => __('Boxed', 'bootstrap-ultra'),
        ),
    ));

    // Add setting for background color
    $wp_customize->add_setting('background_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add control for background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
        'label'    => __('Background Color', 'bootstrap-ultra'),
        'section'  => 'bootstrap_ultra_options',
    )));
}
add_action('customize_register', 'bootstrap_ultra_customize_register');

?>