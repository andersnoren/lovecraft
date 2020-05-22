<?php

global $wp_query;
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

if ( $wp_query->max_num_pages > 1 ) : 

	?>

	<div class="archive-navigation group">

		<div class="fleft">
			
			<?php /* Translators: %1$s = current page, %2$s = max number of pages */ ?>
			<p><?php printf( _x( 'Page %1$s of %2$s', 'Translators: %1$s = current page, %2$s = max number of pages', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></p>

		</div>

		<div class="fright">

			<?php if ( get_previous_posts_link() ) : ?>
				<p><?php echo get_previous_posts_link( __( 'Previous', 'lovecraft' ) ); ?></p>
			<?php endif; ?>

			<?php if ( get_next_posts_link() ) : ?>
				<p><?php echo get_next_posts_link( __( 'Next', 'lovecraft' ) ); ?></p>
			<?php endif; ?>

		</div>

	</div><!-- .archive-navigation -->

	<?php 
endif;