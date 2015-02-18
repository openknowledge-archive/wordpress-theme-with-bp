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
<?php get_template_part('inc/mailing-bar'); ?>
<footer class="footer"><div class="container">
  <div class="row">
    <div class="col-md-4 copyright">
      <p><a href="https://github.com/okfn/wordpress-theme/" title="Site source code"><i class="fa fa-code fa-lg fa-fw"></i> Source code</a> available under the MIT license.</p>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cc-by-sa.png" alt="Creative Commons Licence">
    </div>
    <div class="col-md-offset-2 col-md-3">
      <?php
        $menu = get_menu_by_location('footer-menu-1');
        wp_nav_menu(array(
          'theme_location' => 'footer-menu-1',
          'items_wrap'     => '<h4>' . esc_html($menu->name) . '</h4><nav><ul>%3$s</ul></nav>'
        ));
      ?>
    </div>
    <div class="col-md-3">
      <?php
        $menu = get_menu_by_location('footer-menu-2');
        wp_nav_menu(array(
          'theme_location' => 'footer-menu-2',
          'items_wrap'     => '<h4>' . esc_html($menu->name) . '</h4><nav><ul>%3$s</ul></nav>'
        ));
      ?>
    </div>
    <div class="col-md-3"></div>
  </div>
</div></footer>
<?php wp_footer(); ?>
</body>
</html>
