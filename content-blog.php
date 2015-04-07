<?php
/**
 * @package OKFNWP
 */

	$categories = get_the_category();
?>

	<div class="post--blog">
    <?php
      echo '<a class="post__thumb" href="' . get_permalink() . '">' ?>
        <?php
        if(has_post_thumbnail()) { 
          echo get_the_post_thumbnail();
        }
        else { ?>
          <img class="placeholder" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/thumb-placeholder.png" alt="">
        <?php }
        
        ?>
      </a>
	
    <div class="post--excerpt">
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <p class="post__meta"><?php echo sprintf(__('Posted on %1$s'), get_the_time('jS F Y')); ?><?php if($categories) :
					echo sprintf(', in <a href="%1$s" class="post__category">%2$s</a>', get_category_link($categories[0]->term_id), $categories[0]->name);
				endif; ?> </p>
      <?php the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>" class="more"><?php _e('Read more'); ?></a>
    </div>
  </div>