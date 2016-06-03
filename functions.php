<?php
/**
 * OKFNWP functions and definitions
 *
 * @package OKFNWP
 */
// Set a fixed, maximum allowed width for any content in the theme
if (!isset($content_width)) {
  $content_width = 600;
}

/**
 * Add theme Options page
 */
require_once ('inc/theme-options.php');

/*
 * Initialize the OKFN WordPress theme and set up several required options
 */

function okfn_theme_setup() {

  // Load translated strings for the theme, placed in /languages in
  // https://codex.wordpress.org/I18n_for_WordPress_Developers
  load_theme_textdomain('okfnwp', get_template_directory() . '/languages');

  /**
   * Add theme support for features
   */
  add_theme_support('html5');
  add_theme_support('menus');
  add_theme_support('custom-logo', ['height' => 50, 'flex-width' => true, 'header-text' => array('site-title', 'site-description')]);
  add_theme_support('post-thumbnails');

  /**
   * Post thumbnails
   */
  set_post_thumbnail_size(570, 180, true);
  add_image_size('small', 370, 180, true);

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support('title-tag');

  /**
   * Backwards compatible Custom Header images
   */
  global $wp_version;

  if (version_compare($wp_version, '3.4', '>=')) :
	add_theme_support('custom-header', array(
	  'width' => 1200,
	  'height' => 300,
	  'flex-height' => true,
	  'flex-width' => true,
	  'header-text' => false
	));
  else :
	add_custom_image_header($wp_head_callback, $admin_head_callback);
  endif;

  /**
   * Register menus
   */
  register_nav_menus(array(
	'primary' => 'Primary',
	'footer-menu-1' => 'Footer Menu 1',
//        'footer-menu-2' => 'Footer Menu 2'
  ));
}

add_action('after_setup_theme', 'okfn_theme_setup');

function okfn_widgets_init() {
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
}

add_action('widgets_init', 'okfn_widgets_init');

// Backwards compatibility function for Title Tag theme support
if (!function_exists('_wp_render_title_tag')) :

  function okfn_render_title() {
	?>
	<title><?php wp_title('|', true, 'right'); ?></title>
	<?php
  }

  add_action('wp_head', 'okfn_render_title');
endif;

/**
 * Shortcodes
 */
require_once ('inc/latest-posts.php');


/**
 * Template tags
 */
require_once ('inc/template-tags.php');

/**
 * Enqueue stylesheets
 */
function enqueue_stylesheets() {
  wp_enqueue_style(
	  'lato-font', '//fonts.googleapis.com/css?family=Lato:400,700,900'
  );

  wp_enqueue_style('stylesheet', get_stylesheet_uri());
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

  wp_enqueue_script('ok-ribbon', '//a.okfn.org/html/oki/panel/assets/js/frontend.js', [], [], true);
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
	  'theme-blue' => 'Blue',
	  'theme-black' => 'Black'
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

/*
 * Remove the content editor for the page which is set as a Front page to make it
 * obvious that the page content shouldn't be editted. 
 */

add_action('edit_form_after_title', 'okfn_front_page_editor_notice');

function okfn_front_page_editor_notice() {
  $page_on_front = get_option('page_on_front');
  global $post;

  if (isset($page_on_front) && $page_on_front === $post->ID) {
	remove_post_type_support('page', 'editor');
	?>
	<div class="notice notice-warning inline">
	  <p><?php _e('You are currently editing the page that shows your front page content.', 'okfnwp'); ?></p>
	</div>
	<?php
  }
}

/* Define some global variables */

function okfn_global_vars() {
  global $rendered_posts_ids;
  $rendered_posts_ids = [];
}

add_action('wp', 'okfn_global_vars');

// Get the post categories which will be featured on the Home page from the
// most recently updated 20 posts. Once the categories are extracted 
function okfn_get_featured_cats() {
  global $frontpage_categories;

  if (!isset($frontpage_categories)):
	$frontpage_categories = [];
  endif;

  // Get 20 latest posts ordered by date of modification
  $okfn_recent_posts = get_posts(['posts_per_page' => 20, 'post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'orderby' => 'date_modified']);

  // Extract the IDs of the largest unique categories assigned
  // to the 20 latest posts
  foreach ($okfn_recent_posts as $value):
	// Must use wp_get_post_terms() here as we need the categories ordered by the
	// total number of posts they contain
	$frontpage_categories = array_unique(array_merge($frontpage_categories, wp_get_post_terms($value, 'category', ['orderby' => 'count', 'fields' => 'ids'])));
  endforeach;
}

add_action('wp', 'okfn_get_featured_cats');

// When a post is rendered in a template, remember its ID, so that no duplicate
// post appear in the listings.
function okfn_save_rendered_post_id($post) {
  global $rendered_posts_ids;

  if (isset($post) && !in_array($post->ID, $rendered_posts_ids)):
	array_push($rendered_posts_ids, $post->ID);
  endif;
}

// Check if a post has not already been rendered in the loop
function okfn_is_post_rendered($post) {
  global $rendered_posts_ids;
  global $post; //Required!

  if (isset($post) && in_array($post->ID, $rendered_posts_ids)):
	return true;
  else:
	return false;
  endif;
}