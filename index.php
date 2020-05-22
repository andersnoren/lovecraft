<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner group">

		<div class="content">

			<?php
				
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			$archive_title = '';
			$archive_subtitle = '';
			$archive_description = get_the_archive_description();

			if ( 1 < $paged || is_archive() || is_search() ) {

				if ( $wp_query->max_num_pages && $paged != $wp_query->max_num_pages ) {
					$archive_subtitle = sprintf( _x( 'Page %1$s of %2$s', 'Translators: %1$s = current page, %2$s = max number of pages', 'lovecraft' ), $paged, $wp_query->max_num_pages );
				}
				
				if ( is_archive() ) {
					$archive_title = get_the_archive_title();
				} elseif ( is_search() ) {
					$archive_title = sprintf( _x( 'Search results: "%s"', 'Translators: %s = search query text', 'lovecraft' ), get_search_query() );
				}

			}

			if ( $archive_title ) : ?>

				<div class="archive-header">

					<h1 class="archive-title">

						<?php echo $archive_title; ?>

						<?php if ( $archive_subtitle ) : ?>
							<span><?php echo $archive_subtitle; ?></span>
						<?php endif; ?>

					</h1>

					<?php if ( $archive_description ) : ?>

						<div class="archive-description">
							<?php echo wp_kses_post( wpautop( $archive_description ) ); ?>
						</div><!-- .archive-description -->

					<?php endif; ?>

				</div><!-- .archive-header -->

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

				<article class="post single">

					<div class="post-inner">

						<div class="post-content">

							<p><?php _e( 'No results. Try again, would you kindly?', 'lovecraft' ); ?></p>

							<?php get_search_form(); ?>

						</div><!-- .post-content -->

					</div><!-- .post-inner -->

				</article><!-- .post -->

			<?php endif; ?>

			<?php get_template_part( 'pagination' ); ?>

		</div><!-- .content -->

		<?php get_sidebar(); ?>

	</div><!-- .section-inner -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
