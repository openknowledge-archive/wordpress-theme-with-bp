<?php
/**
 * Newsletter signup bar
 */

// Get the theme options
global $options;
foreach ($options as $value) {
	if(array_key_exists('id', $value)) {
		if (get_option( $value['id'] ) === FALSE) {
			if (array_key_exists('std', $value)) {
				$$value['id'] = $value['std'] or NULL;
			}
		} else {
			$$value['id'] = get_option( $value['id'] );
		}
	}
}

if(!empty($okfnwp_mailinglist_heading) && !empty($okfnwp_mailinglist_action)) {
?>
<div id="page-banner-signup">
	<div class="container">
		<form class="form-inline" role="form" action="<?php echo $okfnwp_mailinglist_action; ?>" method="post">
			<div class="page-banner-signup-label">
				<?php echo $okfnwp_mailinglist_heading; ?>
			</div>
			<div class="page-banner-signup-form">
				<div class="form-group">
					<label class="sr-only" for="name">Name:</label>
					<input type="text" class="form-control" name="name" placeholder="<?php echo __('name', 'okfnwp'); ?>">
				</div>
				<div class="form-group">
					<label class="sr-only" for="email">Email address:</label>
					<input type="email" class="form-control" name="email" placeholder="<?php echo __('email address', 'okfnwp'); ?>">
				</div>
				<input type="hidden" name="list" value="<?php echo $okfnwp_mailinglist_id; ?>">
				<button type="submit" class="btn btn-default">subscribe</button>
			</div>
		</form>
	</div>
</div>
<?php
}