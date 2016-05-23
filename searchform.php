<?php
//The default template for rendering the search form in the header, widgets
//and everywhere else.
?>
<form class="navbar-form navbar-right" action="<?php echo home_url(); ?>/" method="get" role="search">
  <div class="input-group input-group-search">
    <input type="text" name="s" class="form-control" value="<?php the_search_query(); ?>">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-default">
        <span class="fa fa-lg fa-search"></span>
        <span class="sr-only">Submit</span>
      </button>
    </span>
  </div>
</form>