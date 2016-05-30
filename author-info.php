<?php
/**
 * Display the author's name and bio within blog posts
 * 
 * @package OKFNWP
 */
$avatar = get_avatar(get_the_author_meta('ID'), 100);
$avatar_url = 'https://www.gravatar.com/' . md5(get_the_author_meta('user_email'));
$author_description = get_the_author_meta('description');

if ($author_description) :
    ?>
    <aside class="author-info clearfix">
      <a href="<?php echo $avatar_url; ?>"><span class="thumbnail"><?php echo $avatar; ?></span></a>
      <h4><?php echo sprintf(__('About the author: %1$s'), get_the_author_meta('display_name')); ?></h4>
      <?php echo $author_description; ?>
    </aside>
    <?php
endif;