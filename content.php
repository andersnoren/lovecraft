<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php 
	$post_format = get_post_format() ? get_post_format() : 'standard'; 
	$post_type = get_post_type();
	?>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

		<a class="post-image" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'post-image' ); ?>
		</a><!-- .featured-media -->

	<?php endif; ?>

	<div class="post-inner">

		<?php if ( $post_format !== 'aside' ) : ?>

			<div class="post-header">

				<?php if ( get_the_title() ) : ?>

					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php 
				endif;
				
				if ( is_sticky() ) : ?>

					<a href="<?php the_permalink(); ?>" title="<?php _e( 'Sticky post', 'lovecraft' ) ?>" class="sticky-post">
						<div class="genericon genericon-star"></div>
					</a>

					<?php 
				endif;
				
				if ( $post_type === 'post' ) {
					lovecraft_post_meta(); 
				}
				
				?>

			</div><!-- .post-header -->

		<?php endif; ?>

		<?php if ( get_the_content() ) : ?>

			<div class="post-content">
				<?php the_content(); ?>
			</div>

			<div class="clear"></div>

			<?php
		endif;
		
		if ( $post_type === 'post' && $post_format === 'aside' ) { 
			lovecraft_post_meta(); 
		}

		?>

	</div><!-- .post-inner -->

</div><!-- .post -->
