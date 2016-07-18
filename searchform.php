<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-field">
         <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Sök &hellip;', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
         <label for="search"><i class="fa fa-search" aria-hidden="true"></i></label>
         <button type="submit" class="btn btn-large"><span class="screen-reader-text"><?php echo _x( 'Sök', 'submit button', 'twentysixteen' ); ?></span></button>
      </div>
</form>