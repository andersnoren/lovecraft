<?php get_header(); ?>

<div class="wrapper section">
	
	<div class="section-inner">
	
		<div class="content">
			
			<?php if ( have_posts() ) : ?>
			
				<div class="page-title">
				
					<h4><?php printf( _x( 'Search results: "%s"', 'Variable: Search query text', 'lovecraft' ), get_search_query() ); ?>
					
					<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					
					if ( 1 < $wp_query->max_num_pages ) : ?>
					
						<span><?php printf( __( '(Page %s of %s)', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></span>
						
						<div class="clear"></div>
					
					<?php endif; ?></h4>
									
				</div>
						
				<div class="posts" id="posts">
					
					<?php 
					while( have_posts() ) : the_post();
					
						get_template_part( 'content', get_post_format() );
						
					endwhile; 
					?>
								
				</div><!-- .posts -->
				
				<?php 
				lovecraft_archive_navigation();
				
			else : ?>	
							
				<div class="page-title">
			
					<h4><?php printf( _x( 'Search results: "%s"', 'Variable: Search query text', 'lovecraft' ), get_search_query() ); ?></h4>
					
				</div><!-- .page-title -->
							
				<div class="post single">
				
					<div class="post-inner">
				
						<div class="post-content">
						
							<p><?php _e( 'No results. Try again, would you kindly?', 'lovecraft' ); ?></p>
							
							<?php get_search_form(); ?>
						
						</div><!-- .post-content -->
					
					</div><!-- .post-inner -->
					
					<div class="clear"></div>
				
				</div><!-- .post -->
		
			<?php endif; ?>
	
		</div><!-- .content -->
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
	
	</div><!-- .section-inner -->
	
</div><!-- .wrapper.section -->
		
<?php get_footer(); ?>