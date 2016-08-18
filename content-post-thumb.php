<?php

/**
 * @package OKFNWP
 */
$categories = get_the_category();

if (!has_post_thumbnail()):
  $first_post_image = okfn_get_first_image_url_from_post_content();
endif;

if (has_post_thumbnail()) :

  ?>
  <div class="post__thumb">
    <?php

    echo '<a class="post__thumb-link" href="' . get_permalink() . '">' . get_the_post_thumbnail($post, 'small') . '</a>';

    if ($categories) :
      echo sprintf('<a href="%1$s" class="post__category">%2$s</a>', get_category_link($categories[0]->term_id), $categories[0]->name);
    endif;

    ?>
  </div>
<?php elseif (!empty($first_post_image)): ?>
  <div class="post__thumb">
    <a class="post__thumb-link" href="<?php the_permalink(); ?>">
      <img class="attachment-small size-small wp-post-image" src="<?php echo $first_post_image; ?>" alt="">
    </a>
  </div>
<?php else: ?>
  <div class="post__thumb post__thumb-default">
    <a class="post__thumb-link" href="<?php the_permalink(); ?>">
    </a>
  </div>
<?php endif;