<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner">

		<div class="content">

			<?php
				
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			$archive_title = '';
			$archive_subtitle = '';

			if ( 1 < $paged || is_archive() || is_search() ) {

				$page_number = '';

				if ( $paged != $wp_query->max_num_pages ) {
					$page_number = sprintf( _x( 'Page %1$s of %2$s', 'Translators: %1$s = current page, %2$s = max number of pages', 'lovecraft' ), $paged, $wp_query->max_num_pages );
				}
				
				if ( is_archive() ) {
					$archive_title = get_the_archive_title();
					$archive_subtitle = $page_number;
				} elseif ( is_search() ) {
					$archive_title = sprintf( _x( 'Search results: "%s"', 'Translators: %s = search query text', 'lovecraft' ), get_search_query() );
					$archive_subtitle = $page_number;
				} else {
					$archive_title = $page_number;
				}

			}

			if ( $archive_title ) : ?>

				<div class="page-title">

					<h4>

						<?php echo $archive_title; ?>

						<?php if ( $archive_subtitle ) : ?>
							<span><?php echo $archive_subtitle; ?></span>
						<?php endif; ?>

					</h4>

				</div><!-- .page-title -->

			<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<div class="posts" id="posts">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;
					?>

				</div><!-- .posts -->

				<?php 
			elseif ( is_search() ) : 
				?>

				<div class="post single">

					<div class="post-inner">

						<div class="post-content">

							<p><?php _e( 'No results. Try again, would you kindly?', 'lovecraft' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .post-content -->

					</div><!-- .post-inner -->

				</div><!-- .post -->

			<?php endif; ?>

			<?php lovecraft_archive_navigation(); ?>

		</div><!-- .content -->

		<?php get_sidebar(); ?>

		<div class="clear"></div>

	</div><!-- .section-inner -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
