<?php
/**
 * The template for displaying the front page of the site.
 * 
 * @package OKFNWP
 */
global $frontpage_categories;
global $rendered_posts_ids;

get_header();
?>
<div class="main col-md-8">
  <?php
  // TO DO: Think of a way for setting this value fixed from the Theme Options
  // in the WordPress admin.
  if (!isset($featured_cat)) {
	$featured_cat = 'Featured';
  }

  // Check if the Home page is paginated and skip the featured post rendering if it is
  if (isset($paged) && $paged < 2):
	$featured = new WP_Query([
	  'category_name' => $featured_cat,
	  'posts_per_page' => 1
	]);

	if ($featured->have_posts()):
	  while ($featured->have_posts()) : $featured->the_post();
		get_template_part('content', 'featured');
	  endwhile;
	  wp_reset_postdata();
	else:
	  ?>
	  <div class="alert alert-warning"><p>
		  <?php _e("Please select a Featured posts category in the Theme Options, to see the category's most recent post here.", 'okfnwp'); ?>
		</p></div>
	<?php
	endif;
  endif;

  // Get the most recent post for each of the featured categories defined in
  // functions.php via okfn_global_vars().
  foreach ($frontpage_categories as $value):
	$args = [
	  'cat' => $value,
	  'orderby' => 'date',
	  'posts_per_page' => 1,
	  'post__not_in' => $rendered_posts_ids
	];
	$featured_posts[] = new WP_Query($args);
  endforeach;

  // Render the most recent post for each of the featured categories,
  // while checking and remembering already rendered posts.
  if ($featured_posts):
	?>
    <div class="row">
	  <?php
	  foreach ($featured_posts as $key => $fp):

		if ($fp->have_posts()):

		  while ($fp->have_posts()):

			$fp->the_post();

			// Before rendering the post check if its the last one and if its index
			// is not an even number, don't show it
			if ($key == (count($featured_posts) - 1) && ($key % 2 == 0)):
			  break 1;
			endif;

			// Check if the current post has already been rendered on the page
			if (!okfn_is_post_rendered($post)):
			  get_template_part('content', 'front');
			endif;

		  endwhile;

		  wp_reset_postdata();

		else:
		  get_template_part('content', 'none');
		endif;

	  endforeach;
	  ?>
    </div>
	<?php
  endif;
  ?>
</div>
<?php
get_sidebar();
get_footer();
