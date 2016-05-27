<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package OKFNWP
 */
?>

</div><!-- / .row -->
</div></main>
<footer class="footer">
  <div class="container">
    <div class="row footer-primary">
      <div class="col-sm-3 col-md-2">
        <a class="footer-logo" href="https://okfn.org/">
          <img src="https://a.okfn.org/img/oki/landscape-white-468x122.png" alt="Open Knowledge International">
        </a>
      </div>
      <div class="col-sm-9 col-md-10">
        <?php
        $menu = get_menu_by_location('footer-menu-1');
        if (!is_wp_error($menu)) {
            wp_nav_menu(array(
                'theme_location' => 'footer-menu-1',
                'container' => 'nav',
                'container_class' => 'footer-menu',
                'items_wrap' => '<ul class="list-inline">%3$s</ul>'
            ));
        }
        ?>
      </div>
    </div>
    <div class="footer-secondary">
      <p>
        <a href='https://github.com/okfn/wordpress-theme/'
           title='Site source code'>
          <i class='fa fa-code fa-lg fa-fw'></i> Source code
        </a>
        available under the MIT license.
      </p>
      <p>
        <a class="license" rel="license" href="https://creativecommons.org/licenses/by/4.0/">
          <?php echo file_get_contents(get_stylesheet_directory() . "/assets/img/cc.svg", FILE_USE_INCLUDE_PATH); ?>
          <?php echo file_get_contents(get_stylesheet_directory() . "/assets/img/by.svg", FILE_USE_INCLUDE_PATH); ?>
        </a>
        Content on this site, made by
        <a xmlns:cc="http://creativecommons.org/ns#"
           href="https://okfn.org/"
           property="cc:attributionName"
           rel="cc:attributionURL">Open Knowledge International</a>, is licensed under a
        <a rel="license"
           href="https://creativecommons.org/licenses/by/4.0/">Creative Commons
          Attribution 4.0 International License</a>.
      </p>
      <p>
        Refer to our <a href="https://okfn.org/attribution/">attributions page</a> for
        attributions of other work on the site.
      </p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
