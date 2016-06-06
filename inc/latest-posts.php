<?php

/**
 * Output latest posts in a 3 column row
 */
function latest_posts($atts) {

  $atts = shortcode_atts(array(
	'title' => __('Latest posts from the blog', 'okfnwp')
	  ), $atts);

  ob_start();
  ?>
  <section class="list-posts">
    <h3><?php echo $atts['title']; ?></h3>
    <div class="row">
	  <?php
	  $posts = new WP_Query('post_type=post&posts_per_page=3&ignore_sticky_posts=true');
	  while ($posts->have_posts()) : $posts->the_post();

		// Get post category
		$categories = get_the_category();
		?>
		<div class="col-sm-4 col-xs-12">
		  <?php
		  if (has_post_thumbnail()) :
			?>
	  	  <div class="post__thumb">
			  <?php
			  echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post, 'small') . '</a>';

			  if ($categories) :
				echo sprintf('<a href="%1$s" class="post__category">%2$s</a>', get_category_link($categories[0]->term_id), $categories[0]->name);
			  endif;
			  ?>
	  	  </div>
			<?php
		  endif;
		  ?>
		  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		  <?php
		  the_excerpt();
		  okfn_read_more_btn();
		  ?>
		</div>
		<?php
	  endwhile;
	  wp_reset_query();
	  ?>
    </div>
  </section>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode('latestposts', 'latest_posts');
