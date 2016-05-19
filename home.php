<?php
/** 
 * The template for displaying the latests posts or a static home page.
 * 
 * @package OKFNWP
 */
get_header();
?>

<div class="main col-md-8">
  <?php 
  if (have_posts()):
      ?>
      <div class="row">
        <?php
        // Start the Loop.
        while (have_posts()) : the_post();
            // Include the page content template.
            get_template_part('content', 'blog');
        endwhile;

        // Previous/next post navigation.
        paging_nav();
        ?>
      </div>
      <?php
  else:
      get_template_part('content', 'none');
  endif;
  ?>
</div>

<?php
get_sidebar();
get_footer();
