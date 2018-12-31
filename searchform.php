<form method="get" class="search-form" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php _e( 'Search form', 'lovecraft' ); ?>" name="s" id="s" />
	<button type="submit" class="search-button"><div class="genericon genericon-search"></div><span class="screen-reader-text"><?php _e( 'Search', 'lovecraft' ); ?></span></button>
</form>
