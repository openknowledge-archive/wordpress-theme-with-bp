<?php
/**
 * @package OKFNWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post--single'); ?>>
  <p class="post__meta"><?php the_time('jS F Y'); ?>, <?php echo sprintf('by <a href="%1$s">%2$s</a>', get_author_posts_url(get_the_author_meta('ID')), get_the_author_meta('display_name')); ?></p>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <footer class="entry-footer">
    <span class="cat-links"><?php echo __('Posted in: ', 'okfnwp') . get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'okfnwp')); ?></span>
  </footer>
</article>