<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package OKFNWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
  <?php
  if (is_front_page()) :
	?>
    <header class="post-header">
  	<h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
	<?php
  endif;
  ?>
  <div class="entry-content">
	<?php the_content(); ?>
  </div>
</article>