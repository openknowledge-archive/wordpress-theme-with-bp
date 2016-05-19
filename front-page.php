<?php
/**
 * The template for displaying the front page of the site.
 * 
 * @package OKFNWP
 */
get_header();
?>

<div class="main col-md-8">
  <?php
  if (!empty($okfn_home_featured)) {
      $featured_cat = $okfn_home_featured;
  } else {
      $featured_cat = 'Featured';
  }

  // Check if the Home page is paginated and skip the featured post for any
  // page after the first one. 
  if (isset($paged) && $paged < 2):
      $featured = new WP_Query([
          'category_name' => 'Featured',
          'posts_per_page' => 1
      ]);

      while ($featured->have_posts()) : $featured->the_post();
          get_template_part('content', 'featured');
      endwhile;
  endif;

  query_posts('posts_per_page=10');
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
  wp_reset_query();
  ?>
</div>

<?php
get_sidebar();
get_footer();
