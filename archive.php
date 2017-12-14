<?php get_header(); ?>

<div class="wrapper section">
	
	<div class="section-inner">

		<div class="content">
		
			<div class="page-title">
					
				<div class="section-inner">
		
					<h4>
						<?php if ( is_day() ) :
							printf( __( 'Date: %s', 'lovecraft' ), get_the_date( get_option( 'date_format' ) ) ); 
						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'lovecraft' ), '' . get_the_date( 'F Y' ) . '' ); 
						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'lovecraft' ), '' . get_the_date( 'Y' ) . '' ); 
						elseif ( is_category() ) :
							printf( __( 'Category: %s', 'lovecraft' ), '' . single_cat_title( '', false ) . '' ); 
						elseif ( is_tag() ) :
							printf( __( 'Tag: %s', 'lovecraft' ), '' . single_tag_title( '', false ) . '' ); 
						elseif ( is_author() ) :
							$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name) : get_userdata( intval( $author ) );
							printf( __( 'Author: %s', 'lovecraft' ), $curauth->display_name );
						else :
							_e( 'Archive', 'lovecraft' ); 
						endif; 
						
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						
						if ( 1 < $wp_query->max_num_pages ) : ?>
						
							<span><?php printf( __( '(Page %s of %s)', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></span>
							
							<div class="clear"></div>
						
						<?php endif; ?>
					
					</h4>
							
				</div><!-- .section-inner -->
				
			</div><!-- .page-title -->
			
			<?php if ( have_posts() ) : ?>
					
				<div class="posts" id="posts">
					
					<?php 
					while ( have_posts() ) : the_post();
					
						get_template_part( 'content', get_post_format() ); 
						
					endwhile; 
					?>
									
				</div><!-- .posts -->
				
				<?php lovecraft_archive_navigation();
			
			endif; ?>
		
		</div><!-- .content -->
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>

	</div><!-- .section-inner -->
	
</div><!-- .wrapper.section -->

<?php get_footer(); ?>