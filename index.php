<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner">

		<div class="content">

			<?php if ( have_posts() ) : ?>

				<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$total_post_count = wp_count_posts();
				$published_post_count = $total_post_count->publish;
				$total_pages = ceil( $published_post_count / $posts_per_page );

				if ( 1 < $paged ) : ?>

					<div class="page-title">

						<?php /* Translators: %1$s = current page, %2$s = max number of pages */ ?>
						<h4><?php printf( _x( 'Page %1$s of %2$s', 'Translators: %1$s = current page, %2$s = max number of pages', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></h4>

					</div><!-- .page-title -->

					<div class="clear"></div>

				<?php endif; ?>

				<div class="posts" id="posts">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;

				endif;
				?>

			</div><!-- .posts -->

			<?php lovecraft_archive_navigation(); ?>

		</div><!-- .content -->

		<?php get_sidebar(); ?>

		<div class="clear"></div>

	</div><!-- .section-inner -->

</div><!-- .wrapper -->

<?php get_footer(); ?>
