<?php get_header(); ?>

<div class="wrapper section">

	<div class="section-inner group">

		<div class="content">

			<article class="post single">

				<div class="post-inner">

					<div class="post-header">

						<h1 class="post-title"><?php _e( 'Error 404', 'lovecraft' ); ?></h1>

					</div><!-- .post-header -->

					<div class="post-content">

						<p><?php _e( "It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all. You are welcome to search for what you are looking for with the form below.", 'lovecraft' ); ?></p>

						<p><?php get_search_form(); ?></p>

					</div>

				</div><!-- .post-inner -->

			</article><!-- .post -->

		</div><!-- .content -->

		<?php get_sidebar(); ?>

	</div><!-- .section-inner -->

</div><!-- .wrapper.section -->

<?php get_footer(); ?>
