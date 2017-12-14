<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	
		<a class="post-image" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">	
			
			<?php the_post_thumbnail( 'post-image' ); ?>
			
		</a><!-- .featured-media -->
			
	<?php endif; ?>
	
	<div class="post-inner">
				
		<div class="post-header">

			<?php if ( get_the_title() ) : ?>
				
			    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			    
			<?php endif; ?>
		    
		    <?php if ( is_sticky() ) : ?>
		    
		    	<a href="<?php the_permalink(); ?>" title="<?php _e( 'Sticky post', 'lovecraft' ) ?>" class="sticky-post">
			    	<div class="genericon genericon-star"></div>
			    </a>
		    
		    <?php endif; ?>
		    
		    <div class="post-meta">
			    
			    <p class="post-author"><span><?php _e( 'By', 'lovecraft' ); ?> </span><?php the_author_posts_link(); ?></p>

				<p class="post-date"><span><?php _e( 'On', 'lovecraft' ); ?> </span><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></p>

				<?php if (has_category()) : ?>
					<p class="post-categories"><span><?php _e( 'In', 'lovecraft' ); ?> </span><?php the_category( ', ' ); ?></p>
				<?php endif; ?>
				
				<?php edit_post_link( 'Edit', '<p>', '</p>' ); ?>
			    
		    </div>
		    	    
		</div><!-- .post-header -->
		
		<?php if ( get_the_content() ) : ?>
		
			<div class="post-content">
			
				<?php the_content(); ?>
			
			</div>
			
			<div class="clear"></div>
		
		<?php endif; ?>
	
	</div><!-- .post-inner -->
	
</div><!-- .post -->