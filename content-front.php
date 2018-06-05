<?php

/**
 * @package OKFNWP
 */

?>
<div class="col-md-6 post--blog post--excerpt">

	<?php get_template_part( 'content-post-thumb' ); ?>

	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<p class="post__meta"><i class="fa fa-calendar"></i> 
	<?php

		// translators: %1$s stands for the post publish date
		echo sprintf( esc_html__( 'Posted %1$s', 'okfnwp' ), get_the_date() );

		?>
		</p>

	<?php

	the_excerpt();
	okfn_read_more_btn();

	?>

</div>
<?php

okfn_save_rendered_post_id( $post );
