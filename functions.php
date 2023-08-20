<?php

add_theme_support( 'automatic-feed-links' );
add_theme_support('wp-block-styles');
add_theme_support('align-wide');
add_theme_support( 'responsive-embeds');
add_theme_support( "custom-header", $args);
add_theme_support( "custom-background", $args);

add_editor_style('style-editor.css');

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

function bootstrap_ultra_register_block_styles() {
    // Check if function exists
    if( function_exists( 'register_block_style' ) ) {
        // Register block style for paragraph
        register_block_style(
            'core/paragraph',
            array(
                'name'         => 'bootstrap-ultra-special',
                'label'        => __( 'Bootstrap Ultra Special', 'bootstrap-ultra' ),
                'inline_style' => '.is-style-bootstrap-ultra-special { font-weight: bold; color: red; }',
            )
        );
    }
}
add_action( 'init', 'bootstrap_ultra_register_block_styles' );

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
	
    // Add a section for the links
    $wp_customize->add_section('bootstrap_ultra_footer_links', array(
        'title' => __('Footer Links', 'bootstrap-ultra'),
        'priority' => 30,
    ));

    // Setting for the theme creator link
    $wp_customize->add_setting('bootstrap_ultra_theme_creator_link', array(
        'default' => 'https://www.gm-seo-services.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bootstrap_ultra_theme_creator_link', array(
        'label' => __('Theme Creator Link', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_footer_links',
        'type' => 'url',
    ));

    // Setting for the license link
    $wp_customize->add_setting('bootstrap_ultra_license_link', array(
        'default' => 'http://www.gnu.org/licenses/gpl-2.0.html',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bootstrap_ultra_license_link', array(
        'label' => __('License Link', 'bootstrap-ultra'),
        'section' => 'bootstrap_ultra_footer_links',
        'type' => 'url',
    ));	
}
add_action('customize_register', 'bootstrap_ultra_customize_register');

function bootstrap_ultra_register_block_patterns() {
    // Check if function exists
    if( function_exists( 'register_block_pattern' ) ) {
        // Register block pattern
        register_block_pattern(
            'bootstrap-ultra/my-pattern',
            array(
                'title'       => __( 'Bootstrap Ultra Pattern', 'bootstrap-ultra' ),
                'description' => _x( 'A custom pattern for Bootstrap Ultra theme.', 'Block pattern description', 'bootstrap-ultra' ),
                'content'     => '<!-- Your block markup here -->',
            )
        );
    }
}
add_action( 'init', 'bootstrap_ultra_register_block_patterns' );

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

function bootstrap_ultra_default_menu() {
    wp_page_menu(array(
        'show_home' => true,
        'menu_class' => 'navbar-nav mx-auto', // This class is to match your theme's styling
        'before' => '',
        'after' => ''
    ));
}

function default_menu() {
    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 1,
    ));
    echo '</ul>';
}

function bootstrap_ultra_enqueue_styles() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'bootstrap_ultra_enqueue_styles');

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

function bootstrap_ultra_breadcrumbs() {
    $output = '<a href="' . home_url() . '"><i class="fas fa-home"></i></a>';

    if (!is_home() && !is_front_page()) { // Check for front page and home

        if (is_single()) {
            $categories = get_the_category();
            if ($categories && $categories[0]->name != 'Uncategorised') {
                $output .= ' » ';
                $output .= '<a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a>';
            }
            $output .= " » ";
            $output .= get_the_title();
        } elseif (is_page()) {
            $output .= ' » ';
            $output .= get_the_title();
        } elseif (is_category()) {
            $output .= ' » ';
            $output .= single_cat_title('', false);
        } elseif (is_search()) {
            $output .= ' » ';
            $output .= 'Search Results for: ' . get_search_query();
        } elseif (is_404()) {
            $output .= ' » ';
            $output .= '404 Not Found';
        }
    }

    echo $output;
}

?>