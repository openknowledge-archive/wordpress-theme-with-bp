<?php
/**
 * Display the author's name and bio within blog posts
 * 
 * @package OKFNWP
 */

$avatar = get_avatar(get_the_author(), 100);

if(get_the_author_meta('description')) :
?>

<aside class="author-info clearfix">
	<span class="thumbnail"><?php echo $avatar; ?></span>
	<h4><?php echo sprintf(__('About the author: %1$s'), get_the_author_meta('user_nicename')); ?></h4>
	<?php echo get_the_author_meta('description'); ?>
</aside>

<?php
endif;