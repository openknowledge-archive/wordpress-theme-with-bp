<?php
/**
 * Newsletter signup bar
 */

// Get the theme options
$mailinglist_heading = get_option('okfnwp_mailinglist_heading');
$mailinglist_action = get_option('okfnwp_mailinglist_action');
$mailinglist_id = get_option('okfnwp_mailinglist_id');

if(!empty($mailinglist_heading) && !empty($mailinglist_action)) {
?>
<div id="page-banner-signup">
  <div class="container">
    <form class="form-inline" role="form" action="<?php echo $mailinglist_action; ?>" method="post">
      <div class="page-banner-signup-label">
        <?php echo $mailinglist_heading; ?>
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
        <input type="hidden" name="list" value="<?php echo $mailinglist_id; ?>">
        <button type="submit" class="btn btn-default">subscribe</button>
      </div>
    </form>
  </div>
</div>
<?php
}
