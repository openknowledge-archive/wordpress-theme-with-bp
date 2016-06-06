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
          <img src="https://a.okfn.org/img/oki/landscape-white-468x122.png" alt="<?php _e('Open Knowledge International', 'okfn'); ?>">
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
        <a href='https://github.com/okfn/wordpress-theme/' title='Site source code'>
          <i class='fa fa-code fa-lg fa-fw'></i> <?php _e('Source code', 'okfnwp'); ?> </a> <?php _e('available under the MIT license', 'okfnwp'); ?>.
      </p>
      <p>
        <a class="license" rel="license" href="https://creativecommons.org/licenses/by/4.0/">
		  <?php echo file_get_contents(get_stylesheet_directory() . "/assets/img/cc.svg", FILE_USE_INCLUDE_PATH); ?>
		  <?php echo file_get_contents(get_stylesheet_directory() . "/assets/img/by.svg", FILE_USE_INCLUDE_PATH); ?>
        </a>
		<?php _e('Content on this site, made by', 'okfnwp'); ?>
        <a xmlns:cc="http://creativecommons.org/ns#"
           href="https://okfn.org/"
           property="cc:attributionName"
           rel="cc:attributionURL"><?php _e('Open Knowledge International', 'okfnwp'); ?></a>, <?php _e('is licensed under a', 'okfnwp'); ?>
        <a rel="license"
           href="https://creativecommons.org/licenses/by/4.0/">
			 <?php _e('Creative Commons Attribution 4.0 International License', 'okfnwp'); ?>
		</a>.
      </p>
      <p>
		<?php _e('Refer to our', 'okfnwp'); ?> <a href="https://okfn.org/attribution/">
		  <?php _e('attributions page', 'okfnwp'); ?></a> <?php _e('for attributions of other work on the site', 'okfnwp'); ?>.
      </p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
