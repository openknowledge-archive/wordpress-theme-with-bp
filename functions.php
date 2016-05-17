<?php

/**
 * OKFNWP functions and definitions
 *
 * @package OKFNWP
 */
/**
 * Add theme support for features
 */
add_theme_support('html5');
add_theme_support('menus');
add_theme_support('post-thumbnails');


/**
 * Add theme Options page
 */
include('inc/theme-options.php');


/**
 * Post thumbnails
 */
set_post_thumbnail_size(570, 180, true);
add_image_size('small', 370, 180, true);

/**
 * Remove height and width attributes from images
 */
function remove_width_attribute($html) {
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);


/**
 * Shortcodes
 */
include('inc/latest-posts.php');


/**
 * Template tags
 */
include('inc/template-tags.php');


/**
 * Custom header image
 */
add_theme_support('custom-header', array(
    'flex-width' => true,
    'width' => 1200,
    'flex-height' => true,
    'height' => 300,
    'header-text' => false
));


/**
 * Register sidebars
 */
register_sidebar(array(
    'name' => 'Sidebar',
    'id' => 'sidebar',
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widgettitle">',
    'after_title' => '</h3>'
));


/**
 * Register menus
 */
register_nav_menus(array(
    'primary' => 'Primary',
    'footer-menu-1' => 'Footer Menu 1',
    'footer-menu-2' => 'Footer Menu 2'
));

/**
 * Enqueue stylesheets
 */
function enqueue_stylesheets() {
    wp_enqueue_style(
        'stylesheet', get_stylesheet_uri()
    );

    wp_enqueue_style(
        'lato-font', 'http://fonts.googleapis.com/css?family=Lato:400,700,900'
    );
}

add_action('wp_enqueue_scripts', 'enqueue_stylesheets');

/**
 * Enqueue scripts
 */
function enqueue_scripts() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script(
            'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', false, '1.11', false
        );
        wp_enqueue_script('jquery');
    }

    wp_register_script(
        'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), false, false
    );
    wp_enqueue_script('bootstrap');

    wp_register_script(
        'okfn-wp', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true
    );
    wp_enqueue_script('okfn-wp');
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');

/**
 * Fetch Menu object to output name
 */
function get_menu_by_location($location) {
    $menus = get_nav_menu_locations();

    if (!isset($menus[$location])) {
        return false;
    }

    $menu = get_term($menus[$location], 'nav_menu');

    return $menu;
}

/**
 * Theme color variation
 */
function okfnwp_customizer($wp_customize) {
    // Add option to Customizer
    $wp_customize->add_setting(
        'color_scheme', array(
        'default' => 'theme-default'
        )
    );
    $wp_customize->add_control(
        'color_scheme', array(
        'label' => __('Select theme color', 'okfnwp'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => array(
            'theme-default' => 'Default (Green)',
            'theme-red' => 'Red',
            'theme-white' => 'White',
            'theme-blue' => 'Blue'
        )
        )
    );
}

add_action('customize_register', 'okfnwp_customizer');

// Append css class to <body>
function theme_color($classes) {
    $classes[] = get_theme_mod('color_scheme', '');
    return $classes;
}

add_filter('body_class', 'theme_color');

// Show title on home page
add_filter('wp_title', 'wp_title_for_home', 10, 2);

function wp_title_for_home($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name', 'display');

    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
        $title = "$title $sep " . sprintf(__('Page %s', 'twentythirteen'), max($paged, $page));
    }

    return $title;
}
