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
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.ico" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <style type="text/css">
<?php if ("true" == get_option('okfnwp_admin_bar', "true")) { ?>
          #wpadminbar {display:none; }
          html {margin-top: 0px !important; }
<?php } ?>
    </style>
  </head>

  <body <?php body_class(); ?>>
    <?php do_action('okf_panel'); ?>
    <header class="header">
      <div class="container">
        <div id="header-brand">
          <a href="/">
            <h1><?php echo bloginfo('name'); ?></h1>
          </a>
        </div>
        <nav id="header-nav" role="navigation" class="hidden-xs">
          <div id="nav-social" class="social-links">
            <a class="facebook" href="https://www.facebook.com/<?php echo get_option('okfnwp_fb_id', 'OKFNetwork'); ?>"><i class="fa fa-facebook fa-lg"></i></a>
            <a class="twitter" href="https://twitter.com/<?php echo get_option('okfnwp_twitter_id', 'okfn'); ?>"><i class="fa fa-twitter fa-lg"></i></a>
          </div>
        </nav>
        <div class="okfn-wp-ribbon">
          <a href="#" data-toggle="collapse" data-target="#okf-panel" title="Part of the Open Knowledge Foundation Network">An Open Knowledge Foundation Site</a>
        </div>
      </div>
    </header>
    <nav id="navbar-main" class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-main-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand visible-xs" href="#">Menu</a>
        </div>
        <div id="navbar-main-collapse" class="collapse navbar-collapse">
          <?php
          wp_nav_menu(array(
              'theme_location' => 'primary',
              'menu_class' => 'nav navbar-nav',
              'container' => '',
              'fallback_cb' => false
          ));
          ?>
          <form class="navbar-form navbar-right" action="<?php echo home_url(); ?>/" method="get" role="search">
            <div class="input-group input-group-search">
              <input type="text" name="s" class="form-control" value="<?php the_search_query(); ?>">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                  <span class="fa fa-lg fa-search"></span>
                  <span class="sr-only">Submit</span>
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </nav>

    <?php if (get_header_image() && is_front_page()) : ?>

        <section class="carousel" style="background-image:url(<?php header_image(); ?>)">
          <img src="<?php header_image(); ?>" alt="">
        </section>

    <?php else : ?>

        <div id="page-banner">
          <div class="container">
            <h1>
              <?php
              if (is_single() || is_page()) :
                  the_title();
              elseif (is_archive() || is_category() || is_home()) :
                  echo __('Blog', 'okfnwp');
              elseif (is_404()) :
                  echo __('Page Not Found', 'okfnwp');
              elseif (is_search()) :
                  echo sprintf(__('Search Results for: %1$s', 'okfnwp'), get_search_query());
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
