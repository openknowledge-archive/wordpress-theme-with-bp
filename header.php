<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package OKFNWP
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.ico" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="ok-panel" class="closed"><div class="container"><iframe src="//a.okfn.org/html/oki/panel/panel.html" scrolling="no"></iframe></div></div>
    <header class="header">
      <div class="container">
        <div class="col-sm-7 col-md-8">
          <div id="header-brand">
            <?php okfn_theme_logo(); ?>
            <h1><a rel="home" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
          </div>
        </div>
        <div class="col-sm-5 col-md-4">
          <nav id="header-nav" role="navigation" class="hidden-xs">
            <div id="nav-social" class="social-links">
              <?php
              $theme_options = get_option('theme_options_option_name');
              ?>
              <a class="discuss" href="https://discuss.okfn.org/<?php echo isset($theme_options['okfnwp_discuss_id']) ? $theme_options['okfnwp_discuss_id'] : ''; ?>"><i class="fa fa-comment-o fa-lg"></i></a> 
              <a class="facebook" href="https://www.facebook.com/<?php echo isset($theme_options['okfnwp_fb_id']) ? $theme_options['okfnwp_fb_id'] : 'OKFNetwork'; ?>"><i class="fa fa-facebook fa-lg"></i></a>
              <a class="twitter" href="https://twitter.com/<?php echo isset($theme_options['okfnwp_twitter_id']) ? $theme_options['okfnwp_twitter_id'] : 'okfn'; ?>"><i class="fa fa-twitter fa-lg"></i></a>
            </div>
          </nav>
        </div>
        <?php do_action('okf_panel'); ?>
        <div class="hidden-xs" id="ok-panel-wrapper"><a class="ok-ribbon" href="//okfn.org/"><img src="//a.okfn.org/html/oki/panel/assets/images/oki-ribbon.png" alt="Open Knowledge"></a></div>
      </div>
    </header>
    <nav id="navbar-main" class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main-collapse">
            <span class="sr-only"><?php _e('Toggle navigation', 'okfnwp'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand visible-xs" href="#"><?php _e('Menu', 'okfnwp'); ?></a>
        </div>
        <div id="navbar-main-collapse" class="collapse navbar-collapse">
          <?php
// Check if the required menu location exists and show any menu if it doesn't.
          if (has_nav_menu('primary')):

            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav navbar-nav',
                'container' => '',
                'fallback_cb' => false
            ));

          else:

            wp_nav_menu(array(
                'menu_class' => 'nav navbar-nav',
                'container' => '',
                'fallback_cb' => false
            ));

          endif;

          get_search_form();
          ?>
        </div>
      </div>
    </nav>

    <?php
    // If a Custom Header image is selected, show it just on the front page
    if (get_header_image() && is_front_page()) :
      ?>
      <div class="carousel"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></div>
      <?php
    // Do not show the page title on the Front page
    elseif (!is_front_page()) :
      ?>
      <div id="page-banner">
        <div class="container">
          <h1>
            <?php
            $blog_title = __('Blog', 'okfnwp');

            if (is_single() || is_page()) :
              the_title();
            elseif (is_archive() || is_category()) :
              echo $blog_title;

            // When loading the latest posts page or a static home page
            // load the title dynamically from the page title, if set.
            elseif (is_home()) :
              $dynamic_title = get_the_title(get_option('page_for_posts'));
              if (isset($dynamic_title)) :
                echo $dynamic_title;
              else :
                echo $blog_title;
              endif;
            elseif (is_404()) :
              $error_404_title = __('Page Not Found', 'okfnwp');
              echo $error_404_title;
            elseif (is_search()) :
              $search_title = sprintf(__('Search Results for: %1$s', 'okfnwp'), get_search_query());
              echo $search_title;
            endif;
            ?>
          </h1>
        </div>
      </div>
      <div id="breadcrumb" role="navigation">
        <div class="container">
          <?php breadcrumbs(); ?>
        </div>
      </div>
    <?php endif; ?>
    <main class="content"><div class="container">
        <div class="row">
