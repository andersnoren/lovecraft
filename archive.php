<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner">

		<div class="content">

			<div class="page-title">

				<div class="section-inner">

					<h4>
						<?php

						the_archive_title();

						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

						if ( 1 < $wp_query->max_num_pages ) :

							/* Translators: %1$s = current page, %2$s ? max number of pages */ ?>
							<span><?php printf( _x( '(Page %1$s of %2$s)', 'Translators: %1$s = current page, %2$s ? max number of pages', 'lovecraft' ), $paged, $wp_query->max_num_pages ); ?></span>

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
